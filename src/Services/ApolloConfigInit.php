<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 7/31/19
 * Time: 8:47 PM
 */

namespace ApolloConfig\Services;


use ApolloConfig\ApolloConfig;
use ApolloConfig\Configs\ApolloConfigConfigFactory;
use CharacterUtil\UnVisibleCharacterFilter;

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


    /**
     * @test
     */
    public function read_options()
    {
        $all_configs = [];

        $str = '';

        $info = explode('=', $str);

        dd($info);

        $env_path = app()->environmentFilePath();

        $handle = fopen($env_path, 'rb+');

        while ( !feof($handle)) {

            $line = fgets($handle, 1024);

            if ( !empty(trim($line))) {

                $line = $this->handle_one_line($line);

                fwrite($handle, $line);
            }

        }

        fclose($handle);
    }

    public function handle_one_line($line)
    {
        $line = UnVisibleCharacterFilter::main($line);

        $info = explode('=', $line);

        //如果不是 2 则有问题　原因返回
        if (count($info) !== 2) {
            return $line;
        }

        return [
            'key' => $info[ 0 ],
            'val' => $info[ 1 ],
        ];
    }

    /**
     * @test
     */
    public function append($filename, $data_set)
    {
        array_map(function ($data) use ($filename) {
            file_put_contents($filename, $data, FILE_APPEND);
        }, $data_set);
    }

}