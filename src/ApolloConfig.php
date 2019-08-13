<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:27 AM
 */

namespace ApolloConfig;

use ApolloConfig\Configs\ApolloConfigConfigFactory;
use ApolloConfig\Exceptions\ConfigNotSettedException;
use ApolloConfig\Interfaces\ApolloConfigConfigInterface;
use SimpleRequest\Exceptions\FailRequestException;

class ApolloConfig
{
    private static $config_setting;

    /**
     * @param $key
     * @return array|null|string
     * @throws Exceptions\ConfigNotSettedException
     * @throws FailRequestException
     * @throws \RedisException
     */
    public static function get($key, $namespace = null)
    {
        $config_setting = self::$config_setting;

        if ($namespace) {
            $config_setting = ApolloConfigConfigFactory::getByNamespace($namespace);
        }

        return ApolloConfigService::get($key, $config_setting);
    }

    /**
     * @param null $namespace
     * @return array
     * @throws FailRequestException
     */
    public static function getAllOfCertainNamespace($namespace = null)
    {
        $config_setting = self::$config_setting;

        if($namespace || empty($config_setting)){
            $config_setting = ApolloConfigConfigFactory::getByNamespace($namespace);
        }

        return ApolloConfigService::getAll($config_setting);
    }

    /**
     * @param $key
     * @return array|null|string
     * @throws FailRequestException
     * @throws \RedisException
     */
    public static function getSilent($key,$namespace = null)
    {
        try {
            return self::get($key,$namespace);
        } catch (ConfigNotSettedException $exception) {
            return null;
        }
    }

    public static function setConfig(ApolloConfigConfigInterface $config)
    {
        self::$config_setting = $config;
    }

    /**
     * @return array
     * @throws FailRequestException
     */
    public static function getAll()
    {
        return self::getAllOfCertainNamespace();
    }
}