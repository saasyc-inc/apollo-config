<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/11/19
 * Time: 9:25 PM
 */

namespace ApolloConfig;


use ApolloConfig\Configs\ApolloConfigConfigFactory;
use ApolloConfig\Exceptions\ConfigNotSettedException;
use ApolloConfig\Interfaces\ApolloConfigConfigInterface;
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
     * @throws \RedisException
     */
    public static function get($key, ApolloConfigConfigInterface $config = null)
    {
        if ($config === null) {
            $config = ApolloConfigConfigFactory::getDefaultConfig();
        }

        $config_val = self::getInCache($key, $config);

        if ($config_val !== null) {
            return $config_val;
        }

        $info = self::getAll($config);

        if ( !isset($info[ $key ])) {
            throw new ConfigNotSettedException($key, $config);
        }
        $val = $info[ $key ];

        self::cached($key, $config, $val);

        return $val;
    }

    /**
     * @param $key
     * @param ApolloConfigConfigInterface $config
     * @return array|null|string
     * @throws \RedisException
     */
    public static function getInCache($key, ApolloConfigConfigInterface $config)
    {
        $redis_key = self::getKey($key, $config);

        return UnifyRedis::get($redis_key);
    }

    /**
     * @param string $key
     * @return string
     */
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

        //防止内存雪崩
        $time = Functions::config('default_expired_time') - random_int(-60, 60);

        if ($time < 0) {
            $time = 1;
        }

        UnifyRedis::setEx($redis_key, $time, $val);

    }

    public static function expired($key, $config)
    {
        $redis_key = self::getKey($key, $config);

        UnifyRedis::expire_key($redis_key);

    }

    /**
     * @param ApolloConfigConfigInterface|null $config
     * @return array
     * @throws FailRequestException
     */
    public static function getAll(ApolloConfigConfigInterface $config)
    {
        $illumination = Functions::config('request_apollo_illumination');

        $complete_url = $config->get_apollo_complete_url();

        return SimpleRequest::json_get($illumination, $complete_url);
    }
}

