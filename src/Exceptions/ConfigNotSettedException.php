<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/5/19
 * Time: 10:39 AM
 */

namespace ApolloConfig\Exceptions;

use ApolloConfig\Configs\ApolloConfigConfigInterface;

class ConfigNotSettedException extends ApolloException
{
    public function __construct($key, ApolloConfigConfigInterface $config)
    {
        $namespace = $config->get_namespace();

        $message = sprintf('在命名空间 %s 中配置 %s 未设置', $namespace, $key);

        parent::__construct($message);
    }
}