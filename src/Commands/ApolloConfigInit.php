<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 7/31/19
 * Time: 8:47 PM
 */

namespace ApolloConfig\Init;


use ApolloConfig\ApolloConfig;
use ApolloConfig\Configs\ApolloConfigConfigFactory;

/**
 * when init
 * 0. check had init
 * 1. read and save apollo config (url app_id app_key)
 * 2. read env priviority
 * (if apollo and env have same configs in order to not influence old env  u can give a higer priviority to env still think about this)
 * 3. read config from apollo and write to config files
 * 4. override env
 * done
 */
class ApolloConfigInit
{
    public static function main()
    {
        $config = ApolloConfigConfigFactory::getEnvConfig();

        ApolloConfig::setConfig($config);

        $configs = ApolloConfig::getAll();

        array_map(function ($config) {


        }, $configs);
    }

    public static function init()
    {

    }

    public static function getAllEnvFileVariables()
    {
        $env_path = app()->environmentFilePath();

    }


}