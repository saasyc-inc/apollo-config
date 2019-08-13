<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/11/19
 * Time: 9:28 PM
 */

namespace ApolloConfig\Configs;

use ApolloConfig\LaravelBridge\Functions;

class ApolloConfigConfigFactory
{
    /**
     * @return ApolloConfigConfig
     */
    public static function getDefaultConfig()
    {
        return new ApolloConfigConfig();
    }

    /**
     * @return ApolloConfigConfig
     */
    public static function getEnvConfig()
    {
        return new ApolloConfigConfig(
            Functions::config('default_env_related_namespace')
        );
    }


    /**
     * @return ApolloConfigConfig
     */
    public static function getByNamespace($namespace)
    {
        return new ApolloConfigConfig(
            $namespace
        );
    }


}