<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 7/31/19
 * Time: 8:47 PM
 */

namespace ApolloConfig\Init;


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
class ApolloInit
{
    public static function main()
    {
        self::check_had_init();
    }

    public static function check_had_init()
    {
        
    }

    public static function read_config()
    {

    }

}