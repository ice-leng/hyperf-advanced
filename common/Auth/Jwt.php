<?php

declare(strict_types=1);

namespace Common\Auth;

use Common\Helper\ObjectHelper;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Claim\Factory as ClaimFactory;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Parsing\Decoder;
use Lcobucci\JWT\Parsing\Encoder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use Psr\SimpleCache\CacheInterface;
use Yiisoft\Arrays\ArrayHelper;

/**
 * jwt helper
 *
 * Class JwtHelper
 *
 * tx  lcobucci/jwt
 * @package Common\helper
 *
 *   $config = [];
 *   $jwt = new Jwt($config)
 *
 *   // make
 *   $jwt->makeToken(["a" => '1', "b" => '2'], 1);
 *   $jwt->makeRefreshToken();
 *
 *   // validate
 *   $token = '';
 *   $jwt->verify($token);
 *   // get params
 *   $jwt->claimsAsArray();
 *
 *   // refreshToken
 *   $jwt->refreshToken($refreshToken);
 *
 */
class Jwt extends ObjectHelper implements OauthInterface
{
    /**
     * builder
     * @var null
     */
    private $_builder;

    /**
     * @var null|Token
     */
    private $_token;

    /**
     * 支持加密
     * @var array $supportedAlgs
     */
    protected $supportedAlgs = [
        'HS256' => 'Lcobucci\JWT\Signer\Hmac\Sha256',
        'HS384' => 'Lcobucci\JWT\Signer\Hmac\Sha384',
        'HS512' => 'Lcobucci\JWT\Signer\Hmac\Sha512',
        'ES256' => 'Lcobucci\JWT\Signer\Ecdsa\Sha256',
        'ES384' => 'Lcobucci\JWT\Signer\Ecdsa\Sha384',
        'ES512' => 'Lcobucci\JWT\Signer\Ecdsa\Sha512',
        'RS256' => 'Lcobucci\JWT\Signer\Rsa\Sha256',
        'RS384' => 'Lcobucci\JWT\Signer\Rsa\Sha384',
        'RS512' => 'Lcobucci\JWT\Signer\Rsa\Sha512',
    ];

    /**
     * 加密类型
     * @var string|int
     */
    public $alg = 256;

    /**
     * aes key
     * @var string $key
     */
    public $key;

    /**
     * ras 私钥，内容或者文件
     *
     * @var string $privateKey
     */
    public $privateKey;

    /**
     * ras 私钥，内容或者文件
     * @var string $publicKey
     */
    public $publicKey;

    /**
     * 发行人
     * @var string $iss
     */
    public $iss;

    /**
     * 接受者
     * @var string $aud
     */
    public $aud;

    /**
     * 在多少秒之前不可使用
     * @var int $nbf
     */
    public $nbf = 0;

    /**
     * 过期时间
     * 默认 2小时
     * @var int $exp
     */
    public $exp = 7200;

    /**
     * @var CacheInterface
     */
    public $cache;

    /**
     * blacklist class
     * @var Blacklist $cache
     */
    protected $blacklist;

    /**
     * 配置
     * @var array [
     *            'key', // aes key
     *            'privateKey', // ras 私钥，内容或者文件
     *            'publicKey', //ras 公钥，内容或者文件
     *            'iss', //发行人
     *            'aud', //接受者
     *            'nbf', //在多少秒之前不可使用,
     *            'exp', // 过期时间
     * ],
     */
    private $_config;

    public function __construct(array $config = [])
    {
        $this->_builder = null;
        $this->_token = null;
        $this->configure($this, $config);
        $this->blacklist = new Blacklist(new $this->cache);
    }

    /**
     * 获得 生成器
     *
     * @param Encoder|null      $encoder
     * @param ClaimFactory|null $claimFactory
     *
     * @return Builder
     */
    public function getBuilder(Encoder $encoder = null, ClaimFactory $claimFactory = null): Builder
    {
        if ($this->_builder === null) {
            $this->_builder = new Builder($encoder, $claimFactory);
        }
        return $this->_builder;
    }

    /**
     * 获得解析
     *
     * @param Decoder|null      $decoder
     * @param ClaimFactory|null $claimFactory
     *
     * @return Parser
     */
    public function getParser(Decoder $decoder = null, ClaimFactory $claimFactory = null): Parser
    {
        return new Parser($decoder, $claimFactory);
    }

    /**
     * 获得加密对象
     * @return object
     * @throws \Exception
     */
    protected function getAlgClass()
    {
        if (empty($this->supportedAlgs[$this->alg])) {
            throw new \RuntimeException("{$this->alg} Algorithm not supported");
        }

        return new $this->supportedAlgs[$this->alg];
    }

    /**
     * 获得加密规制
     * @return array
     * @throws \Exception
     */
    protected function getSigner()
    {
        if (!empty($this->privateKey) && !empty($this->publicKey)) {
            // 如果是 文件 转换格式
            if (is_file($this->privateKey)) {
                $this->privateKey = 'file://' . $this->privateKey;
            }
            if (is_file($this->publicKey)) {
                $this->publicKey = 'file://' . $this->publicKey;
            }
            if (is_int($this->alg)) {
                $this->alg = 'RS' . $this->alg;
            }
            $signer = $this->getAlgClass();
            $privateKey = new Key($this->privateKey);
            $publicKey = new Key($this->publicKey);
        } elseif (!empty($this->key)) {
            if (is_int($this->alg)) {
                $this->alg = 'HS' . $this->alg;
            }
            $signer = $this->getAlgClass();
            $privateKey = new Key($this->key);
            $publicKey = $this->key;
        } else {
            $signer = $privateKey = $publicKey = null;
        }
        return [$signer, $privateKey, $publicKey];
    }

    /**
     * 生成token
     *
     * @param array $claims 自定义信息
     * @param mixed $jti    uid
     *
     * @return string
     * @throws \Exception
     */
    public function makeToken(array $claims = [], $jti = null): string
    {
        $builder = $this->getBuilder();

        // 发行人
        if (!empty($this->iss)) {
            $builder->issuedBy($this->iss);
        }
        // 接受者
        if (!empty($this->aud)) {
            $builder->permittedFor($this->aud);
        }
        if ($jti === null) {
            $jti = uniqid();
        }

        $builder->identifiedBy($jti);

        $time = time();
        $builder->issuedAt($time)->canOnlyBeUsedAfter($time + $this->nbf)->expiresAt($time + $this->exp);

        // 载体
        foreach ($claims as $name => $value) {
            $builder->withClaim($name, $value);
        }

        list($signer, $privateKey, $publicKey) = $this->getSigner();
        $token = $builder->getToken($signer, $privateKey);

        $this->_token = $token;
        $this->blacklist->add($this->claimsAsArray());

        return $token->__toString();
    }

    /**
     * 自定义参数 转为数组
     * @return array
     */
    public function claimsAsArray()
    {
        $data = [];
        if ($this->_token === null) {
            return $data;
        }
        $claims = $this->_token->getClaims();
        foreach ($claims as $name => $claim) {
            $data[$name] = $claim->getValue();
        }
        return $data;
    }

    /**
     * jwt 验证
     *
     * @param string $token
     *
     * @return bool
     * @throws \Exception
     */
    public function verify(string $token)
    {
        try {
            $token = $this->getParser()->parse($token);
        } catch (\Throwable $exception) {
            $token = null;
        }

        if (!$this->validateToken($token)) {
            $token = null;
        }

        if (!$this->verifyToken($token)) {
            $token = null;
        }

        $this->_token = $token;

        if ($token !== null && $this->blacklist->has($token->getClaim('jti', ''), $this->claimsAsArray())) {
            $token = null;
            $this->_token = $token;
        }

        return $token !== null;
    }

    /**
     * 验证 jwt
     *
     * @param Token $token
     * @param null  $currentTime
     *
     * @return bool
     */
    public function validateToken(?Token $token, $currentTime = null): bool
    {
        if ($token === null) {
            return false;
        }
        $data = new ValidationData($currentTime);
        return $token->validate($data);
    }

    /**
     * 验证 token
     *
     * @param Token $token
     *
     * @return bool
     * @throws \Exception
     */
    public function verifyToken(?Token $token)
    {
        if ($token === null) {
            return false;
        }
        list($signer, $privateKey, $publicKey) = $this->getSigner();
        if ($signer === null) {
            return true;
        }
        return $token->verify($signer, $publicKey);
    }

    /**
     * 刷新token
     *
     * @param string $refreshToken
     * @param int    $exp
     *
     * @return mixed
     * @throws \Exception
     */
    public function refreshToken(string $refreshToken, $exp = 604800)
    {
        $data = $this->blacklist->get($refreshToken);
        if (empty($data)) {
            return null;
        }
        $claims = $data['claims'];
        $jti = ArrayHelper::remove($claims, 'jti');
        $this->_logout($refreshToken, $jti);
        $token = $this->makeToken($claims, $jti);
        $newRefreshToken = $this->makeRefreshToken($exp);
        return [$token, $newRefreshToken];
    }

    /**
     * 生成 刷新token
     * @return string
     * @throws \Exception
     */
    protected function generateRefreshToken()
    {
        if (empty($this->_token)) {
            throw new \Exception('Please make token first');
        }
        return sha1($this->_token->__toString());
    }

    /**
     * 生成刷新token
     *
     * @param int $exp 过期时间 默认 7天
     *
     * @return string
     * @throws \Exception
     */
    public function makeRefreshToken($exp = 604800)
    {
        $jti = $this->generateRefreshToken();
        $claims = $this->claimsAsArray();
        $unsetLists = [
            'iat',
            'nbf',
            'exp',
        ];
        foreach ($unsetLists as $unsetList) {
            ArrayHelper::remove($claims, $unsetList);
        }

        $this->blacklist->add([
            'jti'    => $jti,
            'iat'    => time(),
            'exp'    => time() + $exp,
            'claims' => $claims,
        ]);
        return $jti;
    }

    /**
     * 注销
     *
     * @param string $refreshToken
     * @param string $jti
     *
     * @return bool
     */
    private function _logout($refreshToken, $jti)
    {
        $this->blacklist->remove($refreshToken);
        return $this->blacklist->join($jti);
    }

    /**
     * 注销
     * @return mixed
     * @throws \Exception
     */
    public function logout()
    {
        if (!empty($this->_token)) {
            return $this->_logout($this->generateRefreshToken(), $this->_token->getClaim('jti', ''));
        }
        return false;
    }
}