<?php
/**
 * ----LoginInfo start ----
 * @SWG\Definition(
 *    definition = "LoginInfo",
 *                
 *    @SWG\Property(
 *        property = "token",
 *        description = "token",
 *        example = "giojovx",
 *        type = "string"
 *    ),
 *                
 *    @SWG\Property(
 *        property = "time",
 *        description = "时间",
 *        example = 48,
 *        type = "integer"
 *    )
 * )
 * ----LoginInfo end ----
 */
/**
 * ----LoginInfoSuccess start ----
 * @SWG\Definition(
 *    definition = "LoginInfoSuccess",
 *                
 *    @SWG\Property(
 *        property = "code",
 *        description = "code",
 *        example = 0,
 *        type = "integer"
 *    ),
 *                
 *    @SWG\Property(
 *        property = "message",
 *        description = "message",
 *        example = "Success",
 *        type = "string"
 *    ),
 *                
 *    @SWG\Property(
 *        property = "data",
 *        description = "data",
 *        type = "object",
 *        ref="#/definitions/LoginInfo"
 *    )
 * )
 * ----LoginInfoSuccess end ----
 */