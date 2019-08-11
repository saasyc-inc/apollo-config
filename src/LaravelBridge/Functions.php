<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/11/19
 * Time: 10:50 PM
 */

namespace ApolloConfig\LaravelBridge;

class Functions
{
    public static function config($key)
    {
        return config(
            sprintf('apollo.apollo.%s', $key)
        );
    }
}