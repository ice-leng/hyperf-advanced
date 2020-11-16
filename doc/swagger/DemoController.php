<?php

namespace App\Controller\V1;

use App\Controller\Controller;
use Hyperf\Apidog\Annotation\ApiController;
use Hyperf\Apidog\Annotation\ApiDefinition;
use Hyperf\Apidog\Annotation\ApiDefinitions;
use Hyperf\Apidog\Annotation\ApiResponse;
use Hyperf\Apidog\Annotation\ApiVersion;
use Hyperf\Apidog\Annotation\Body;
use Hyperf\Apidog\Annotation\DeleteApi;
use Hyperf\Apidog\Annotation\FormData;
use Hyperf\Apidog\Annotation\GetApi;
use Hyperf\Apidog\Annotation\Header;
use Hyperf\Apidog\Annotation\PostApi;
use Hyperf\Apidog\Annotation\Query;
use Lengbin\Hyperf\Auth\RouterAuthAnnotation;

/**
 * @ApiVersion(version="v1")
 * @ApiController(tag="demo管理", description="demo的新增/修改/删除接口")
 * @ApiDefinitions({
 *  @ApiDefinition(name="DemoOkResponse", properties={
 *     "code|响应码": 200,
 *     "msg|响应信息": "ok",
 *     "data|响应数据": {"$ref": "DemoInfoData"}
 *  }),
 *  @ApiDefinition(name="DemoInfoData", properties={
 *     "userInfo|用户数据": {"$ref": "DemoInfoDetail"}
 *  }),
 *  @ApiDefinition(name="DemoInfoDetail", properties={
 *     "id|用户ID": 1,
 *     "mobile|用户手机号": { "default": "13545321231", "type": "string" },
 *     "nickname|用户昵称": "nickname",
 *     "avatar": { "default": "avatar", "type": "string", "description": "用户头像" },
 *  })
 * })
 *
 * @RouterAuthAnnotation(isPublic=true)
 */
class DemoController extends Controller
{

    /**
     * @PostApi(path="/demo", description="添加一个用户")
     * @Header(key="token|接口访问凭证", rule="required")
     * @FormData(key="a.name|名称", rule="required|max:10|cb_checkName")
     * @FormData(key="a.sex|年龄", rule="integer|in:0,1")
     * @FormData(key="aa|aa", rule="required|array")
     * @FormData(key="file|文件", rule="file")
     * @ApiResponse(code="-1", description="参数错误", template="page")
     * @ApiResponse(code="0", description="请求成功", schema={"id":"1"})
     *
     */
    public function add()
    {
        return [
            'code'   => 0,
            'id'     => 1,
            'params' => $this->request->post(),
        ];
    }

    // 自定义的校验方法 rule 中 cb_*** 方式调用
    public function checkName($attribute, $value)
    {
        if ($value === 'a') {
            return "拒绝添加 " . $value;
        }

        return true;
    }

    /**
     * 请注意 body 类型 rules 为数组类型
     * @DeleteApi(path="/demo", description="删除用户")
     * @Body(rules={
     *     "id|用户id":"required|integer|max:10",
     *     "deepAssoc|深层关联":{
     *        "name_1|名称": "required|integer|max:20"
     *     },
     *     "deepUassoc|深层索引":{{
     *         "name_2|名称": "required|integer|max:20"
     *     }},
     *     "a.b.c.*.e|aa":"required|integer|max:10",
     * })
     * @ApiResponse(code="-1", description="参数错误")
     * @ApiResponse(code="0", description="删除成功", schema={"id":1})
     */
    public function delete()
    {
        $body = $this->request->getBody()->getContents();
        return [
            'code'  => 0,
            'query' => $this->request->getQueryParams(),
            'body'  => json_decode($body, true),
        ];
    }

    /**
     * @GetApi(path="/demo", description="获取用户详情")
     * @Query(key="id", rule="required|integer|max:10")
     * @ApiResponse(code="-1", description="参数错误")
     * @ApiResponse(code="0", schema={"id":1,"name":"张三","age":1}, template="success")
     * @RouterAuthAnnotation(isWhitelist=true)
     */
    public function get()
    {
        return [
            'code'    => 0,
            'id'      => 1,
            'name'    => '张三',
            'age'     => 1,
            'data'    => $this->getValidateData(),
            'user_id' => $this->getAuth()->getId(),
        ];
    }

    /**
     * schema中可以指定$ref属性引用定义好的definition
     * @GetApi(path="/demo/info", description="获取用户详情")
     * @Query(key="id", rule="required|integer|max:0")
     * @ApiResponse(code="-1", description="参数错误")
     * @ApiResponse(code="0", schema={"$ref": "DemoOkResponse"})
     */
    public function info()
    {
        return [
            'code' => 0,
            'id'   => 1,
            'name' => '张三',
            'age'  => 1,
        ];
    }

    /**
     * @GetApi(path="/demos", summary="用户列表")
     * @ApiResponse(code="200", description="ok", schema={{
     *     "a|aa": {{
     *          "a|aaa":"b","c|ccc":5.2
     *      }},
     *     "b|ids": {1,2,3},
     *     "c|strings": {"a","b","c"},
     *     "d|dd": {"a":"b","c":"d"},
     *     "e|ee": "f"
     * }})
     */
    public function list()
    {
        return [
            [
                "a" => [
                    ["a" => "b", "c" => "d"],
                ],
                "b" => [1, 2, 3],
                "c" => ["a", "b", "c"],
                "d" => [
                    "a" => "b",
                    "c" => "d",
                ],
                "e" => "f",
            ],
        ];
    }

}
