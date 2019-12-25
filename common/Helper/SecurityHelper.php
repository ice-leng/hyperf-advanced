<?php

declare(strict_types=1);

namespace Common\Helper;

use Common\Auth\Jwt;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use Yiisoft\Security\Crypt;
use Yiisoft\Security\PasswordHasher;
use Yiisoft\Security\Random;

class SecurityHelper
{
    /**
     * 生成 公钥，秘钥
     *
     * @param string $path
     *
     * @return array
     */
    public function generateRSAKey(?string $path = null): array
    {
        $privateKey = openssl_pkey_new();
        openssl_pkey_export($privateKey, $out);
        $detail = openssl_pkey_get_details($privateKey);
        if ($path === null) {
            return [
                'privateKey' => $out,
                'publicKey'  => $detail['key'],
            ];
        }
    }

    /**
     * 验证 秘钥
     *
     * @param string $privateKey
     *
     * @return false|string
     */
    protected static function checkPrivateKey($privateKey): string
    {
        if (empty($privateKey)) {
            throw new \RuntimeException('Private key can not empty.', CodeHelper::SYS_EXCEPTION_ERROR);
        }
        if (is_file($privateKey)) {
            $privateKey = file_get_contents($privateKey);
        }
        return $privateKey;
    }

    /**
     * 验证 公钥
     *
     * @param $publicKey
     *
     * @return string
     */
    protected static function checkPublicKey($publicKey): string
    {
        if (empty($publicKey)) {
            throw new \RuntimeException('Public key can not empty.', CodeHelper::SYS_EXCEPTION_ERROR);
        }
        if (is_file($publicKey)) {
            $publicKey = file_get_contents($publicKey);
        }
        return $publicKey;
    }

    /**
     * 公钥 加密
     *
     * @param string $publicKey
     * @param string $string
     *
     * @return string
     */
    public static function publicKeyEncryption(string $publicKey, string $string): string
    {
        $publicKey = self::checkPublicKey($publicKey);
        $publicKeyData = openssl_pkey_get_public($publicKey);
        openssl_public_encrypt($string, $encrypted, $publicKeyData, OPENSSL_PKCS1_OAEP_PADDING);
        return $encrypted;
    }

    /**
     * 公钥 解密
     *
     * @param string $privateKey
     * @param string $string
     *
     * @return mixed
     */
    public function publicKeyDecrypt(string $privateKey, string $string): string
    {
        $privateKey = self::checkPrivateKey($privateKey);
        $privateKeyData = openssl_pkey_get_private($privateKey);
        openssl_private_decrypt($string, $decrypted, $privateKeyData, OPENSSL_PKCS1_OAEP_PADDING);
        return $decrypted;
    }

    /**
     * 私钥 加密 - 签名验证
     *
     * @param string $privateKey
     * @param string $string
     *
     * @return mixed
     */
    public function privateKeyEncryption(string $privateKey, string $string): string
    {
        $privateKey = self::checkPrivateKey($privateKey);
        $privateKeyData = openssl_pkey_get_private($privateKey);
        openssl_private_encrypt($string, $encrypted, $privateKeyData);
        return $encrypted;
    }

    /**
     * 私钥 解密  -  签名验证
     *
     * @param string $publicKey
     * @param string $string
     *
     * @return mixed
     */
    public function privateKeyDecrypt(string $publicKey, string $string): string
    {
        $publicKey = self::checkPublicKey($publicKey);
        $publicKeyData = openssl_pkey_get_public($publicKey);
        openssl_public_decrypt($string, $decrypted, $publicKeyData);
        return $decrypted;
    }

    /**
     * 随机字符串
     *
     * @param int $length
     *
     * @return string
     * @throws \Exception
     */
    public static function randomString(int $length = 16): string
    {
        return Random::string($length);
    }

    /**
     * 随机数字
     *
     * @param int $length
     *
     * @return int
     * @throws \Exception
     */
    public static function randomInt(int $length = 6): int
    {
        if ($length < 1) {
            throw new \RuntimeException('Length must be greater than 0', CodeHelper::SYS_EXCEPTION_ERROR);
        }
        $min = (int)str_pad("1", $length, "0");
        $max = (int)str_pad("9", $length, "9");
        return random_int($min, $max);
    }

    /**
     * 生成密码 hash
     *
     * @param $password
     *
     * @return string
     */
    public static function generatePasswordHash($password): string
    {
        return (new PasswordHasher())->hash($password);
    }

    /**
     * 验证密码hash
     *
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public static function validatePassword($password, $hash): bool
    {
        return (new PasswordHasher())->validate($password, $hash);
    }

    /**
     * 通过密码加密数据
     *
     * @param string $data
     * @param string $password
     *
     * @return string
     * @throws \Exception
     */
    public static function encryptByPassword(string $data, string $password): string
    {
        return (new Crypt())->encryptByPassword($data, $password);
    }

    /**
     * 通过密码解密数据
     *
     * @param $encryptData
     * @param $password
     *
     * @return string
     * @throws \Exception
     */
    public static function decryptByPassword(string $encryptData, string $password): string
    {
        return (new Crypt())->decryptByPassword($encryptData, $password);
    }

    /**
     * 通过key加密数据
     *
     * @param string $data
     * @param string $key
     *
     * @return string
     * @throws \Exception
     */
    public static function encryptByKey(string $data, string $key): string
    {
        return (new Crypt())->encryptByKey($data, $key);
    }

    /**
     * 通过key解密数据
     *
     * @param string $encryptData
     * @param string $key
     *
     * @return string
     * @throws \Exception
     */
    public static function decryptByKey(string $encryptData, string $key): string
    {
        return (new Crypt())->decryptByKey($encryptData, $key);
    }

    /**
     * jwt
     * @return Jwt
     */
    public static function jwt(): Jwt
    {
        $config = ApplicationContext::getContainer()->get(ConfigInterface::class);
        $jwt = $config->get('auth.jwt', []);
        return make(Jwt::class, [$jwt]);
    }

}