<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:27 AM
 */

namespace ApolloConfig;

use SimpleRequest\SimpleRequest;

class ApolloConfig
{
    public static function changeConnection($namespace, $id, $server)
    {

    }

    public static function get($key, $namespace, $app_id = null)
    {
        $domain = ApolloConfigConfig::get_domain();

        $app_id = ApolloConfigConfig::get_appid($app_id);

        $cluster_name = ApolloConfigConfig::get_cluster_name();

        $path = sprintf("configfiles/json/%s/%s/%s", $app_id, $cluster_name, $namespace);

        SimpleRequest::setRequestDomain($domain);

        SimpleRequest::setRequestIllumination("请求阿波罗");

        $info = SimpleRequest::json_get($path, []);

        return $info[ $key ];
    }

    public static function readFromCache()
    {

    }

    public function writeToCache($namespace, $info)
    {
        
    }
}