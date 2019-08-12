<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:27 AM
 */

namespace ApolloConfig;

use ApolloConfig\Configs\ApolloConfigConfigInterface;
use ApolloConfig\Exceptions\ConfigNotSettedException;
use SimpleRequest\Exceptions\FailRequestException;
use Throwable;

class ApolloConfig
{
    private static $config_setting;

    /**
     * @param $key
     * @return array|null|string
     * @throws Exceptions\ConfigNotSettedException
     * @throws FailRequestException
     */
    public static function get($key)
    {
        $config_setting = self::$config_setting;

        return ApolloConfigService::get($key, $config_setting);
    }

    /**
     * @param $key
     * @return array|null|string
     * @throws FailRequestException
     */
    public static function getSilent($key)
    {
        try {
            return self::get($key);
        } catch (ConfigNotSettedException $exception) {
            return null;
        }
    }

    public static function setConfig(ApolloConfigConfigInterface $config)
    {
        self::$config_setting = $config;
    }

    public static function getAll()
    {
        $config_setting = self::$config_setting;

        return ApolloConfigService::getAll($config_setting);
    }
}