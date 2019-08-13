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
use SimpleRequest\Exceptions\FailRequestException;

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
    //从　apollo 获取到的配置文件信息
    private static $env_variables_in_apollo = [];

    private static $env_file_path;

    /**
     * @throws FailRequestException
     */
    public static function main()
    {
        $env_variables_in_apollo = self::$env_variables_in_apollo = self::get_env_variables_in_apollo();

        $env_file_path = self::$env_file_path = self::get_env_file_path();

        $exist_keys_in_env = self::get_variable_keys_from_env(
            self::$env_file_path
        );

        $env_keys_in_apollo = array_keys($exist_keys_in_env);

        $diff = array_diff(
            $env_keys_in_apollo, $exist_keys_in_env
        );

        self::append_env_variables($env_file_path, $diff, $env_variables_in_apollo);

    }

    /**
     * @throws FailRequestException
     */
    public static function get_env_variables_in_apollo()
    {
        $config = ApolloConfigConfigFactory::getEnvConfig();

        ApolloConfig::setConfig($config);

        return ApolloConfig::getAll();
    }

    public static function get_env_file_path()
    {
        return app()->environmentFilePath();
    }

    public static function get_variable_keys_from_env($env_path)
    {
        $return_keys = [];

        $handle = fopen($env_path, 'rb+');

        while ( !feof($handle)) {

            $line = fgets($handle, 1024);

            if ( !empty(trim($line))) {

                $line = self::handle_one_line($line);

                if ( !empty($line)) {
                    $return_keys[] = $line[ 'val' ];
                }

            }

        }

        fclose($handle);

        return $return_keys;
    }

    public static function append_env_variables($env_file_path, array $diffs, array $env_variables_in_apollo)
    {
        array_map(function ($diff) use ($env_file_path, $env_variables_in_apollo) {
            $line_info = sprintf(
                "%s=%s", $diff, $env_variables_in_apollo[ $diff ]
            );
            file_put_contents($env_file_path, $line_info, FILE_APPEND);
        }, $diffs);
    }

    public function modify($env_path)
    {
        $all_configs = [];

        $str = '';

        $info = explode('=', $str);

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

    public static function handle_one_line($line)
    {
        $line = UnVisibleCharacterFilter::main($line);

        $info = explode('=', $line);

        //如果不是 2 则有问题　原因返回
        if (count($info) !== 2) {
            return [];
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