<?php
/**
 * ----/login start ----
 * @SWG\POST(
 *    path="/login",
 *    tags={"login"}, 
 *    summary="登录",
 *    description="登录",
 *    consumes={"application/x-www-form-urlencoded"},
 *    produces={"application/json", "application/xml"},
 *    security={{"api_key":{}}},
 *    
 *    @SWG\Parameter(
 *        name = "account",
 *        description = "账号",
 *        in = "formData",
 *        type = "string",
 *        required = true,
 *        default = "root"
 *    ),
 *    
 *    @SWG\Parameter(
 *        name = "password",
 *        description = "密码",
 *        in = "formData",
 *        type = "string",
 *        required = true,
 *        default = "123456"
 *    ),
 *    
 *    @SWG\Response(
 *        response = "200",
 *        description = "success",
 *        @SWG\Schema(ref="#/definitions/LoginInfoSuccess")
 *    ),
 *    
 *    @SWG\Response(
 *        response = "default",
 *        description = "请求失败， http status 强行转为200, 通过code判断",
 *        @SWG\Schema(ref="#/definitions/ErrorDefault")
 *    )
 * )
 * ----/login end ----
 */