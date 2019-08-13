<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:27 AM
 */

namespace ApolloConfig;

use ApolloConfig\Configs\ApolloConfigConfigFactory;
use ApolloConfig\Configs\ApolloConfigConfigInterface;
use ApolloConfig\Exceptions\ConfigNotSettedException;
use SebastianBergmann\FileIterator\Facade;
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
    public static function get($key, $namespace = null)
    {
        $config_setting = self::$config_setting;

        if ($namespace) {
            $config_setting = ApolloConfigConfigFactory::getByNamespace($namespace);
        }

        return ApolloConfigService::get($key, $config_setting);
    }

    public static function getAllOfCertainNamespace($namespace = null)
    {
        $config_setting = self::$config_setting;

        if($namespace){
            $config_setting = ApolloConfigConfigFactory::getByNamespace($namespace);
        }

        return ApolloConfigService::getAll($config_setting);
    }

    /**
     * @param $key
     * @return array|null|string
     * @throws FailRequestException
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

    public static function getAll()
    {
        $namespace = null;

        return self::getAllOfCertainNamespace($namespace);
    }
}