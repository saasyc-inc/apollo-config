<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 2:21 AM
 */

namespace ApolloConfig;


class ApolloConfigConfig
{
    public static function get_domain()
    {
        return 'http://apollo-dev.web-docker.saasyc.com';
    }

    public static function get_appid($appid = null)
    {
        if ($appid === null) {
            return 'SampleApp';
        }

        return $appid;
    }

    public static function get_cluster_name()
    {
        return 'default';
    }

    public static function file_name()
    {

    }

    public static function get_default_namespace()
    {
//        return config();
    }
}