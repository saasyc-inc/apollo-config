<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/5/19
 * Time: 10:39 AM
 */

namespace ApolloConfig\Exceptions;

class SetValForbiddenException extends ApolloException
{
    public function __construct()
    {
        $message = '禁止设置配置';

        $code = 10066;

        parent::__construct($message, $code);
    }
}