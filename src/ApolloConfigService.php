<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/11/19
 * Time: 9:25 PM
 */

namespace ApolloConfig;


use ApolloConfig\Configs\ApolloConfigConfigFactory;
use ApolloConfig\Configs\ApolloConfigConfigInterface;
use ApolloConfig\Exceptions\ConfigNotSettedException;
use ApolloConfig\LaravelBridge\Functions;
use SimpleRequest\Exceptions\FailRequestException;
use SimpleRequest\SimpleRequest;
use UnifyRedis\UnifyRedis;

class ApolloConfigService
{
    /**
     * @param $key
     * @param ApolloConfigConfigInterface|null $config
     * @return array|null|string
     * @throws ConfigNotSettedException
     * @throws FailRequestException
     */
    public static function get($key, ApolloConfigConfigInterface $config = null)
    {
        $illumination = Functions::config('request_apollo_illumination');

        if ($config === null) {
            $config = ApolloConfigConfigFactory::getDefaultConfig();
        }

        $config_val = self::getInCache($key, $config);

        if ($config_val !== null) {
            return $config_val;
        }

        $complete_url = $config->get_apollo_complete_url();

        $info = SimpleRequest::json_get($illumination, $complete_url);

        if ( !isset($info[ $key ])) {
            throw new ConfigNotSettedException($key,$config);
        }
        $val = $info[ $key ];

        self::cached($key, $config, $val);

        return $val;
    }

    public static function getInCache($key, ApolloConfigConfigInterface $config)
    {
        $redis_key = self::getKey($key, $config);

        return UnifyRedis::get($redis_key);
    }

    public static function getKey(string $key, ApolloConfigConfigInterface $config)
    {
        $apollo_key_prefix = Functions::config('cached_key_prefix');

        $prefix = $config->get_apollo_complete_url();

        $prefix = md5($prefix);

        return sprintf('%s:%s%s', $apollo_key_prefix, $prefix, $key);
    }

    public static function cached($key, $config, $val)
    {
        $redis_key = self::getKey($key, $config);

        UnifyRedis::set($redis_key, $val);
    }

    public static function getAll(ApolloConfigConfigInterface $config = null)
    {
        return [];
    }
}