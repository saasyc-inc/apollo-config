<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 2:21 AM
 */

namespace ApolloConfig\Configs;


use ApolloConfig\LaravelBridge\Functions;

class ApolloConfigConfig implements ApolloConfigConfigInterface
{
    private $domain;

    private $app_id;

    private $cluster_name;

    private $namespace;

    public function __construct($namespace = null, $cluster_name = null, $domain = null, $app_id = null)
    {
        $this->domain = $domain;

        $this->app_id = $app_id;

        $this->namespace = $namespace;

        $this->cluster_name = $cluster_name;
    }

    public function get_domain()
    {
        return $this->domain ?? Functions::config('default_domain');
    }

    /**
     * @return mixed
     */
    public function get_namespace()
    {
        return $this->namespace ?? Functions::config('default_namespace');
    }

    public function get_app_id()
    {
        return $this->app_id ?? Functions::config('default_app_id');
    }

    //第一版本　我们不用这个属性
    public function get_cluster_name()
    {
        return $this->cluster_name ?? Functions::config('default_cluster_name');
    }


    //需要返回 {config_server_url}/configfiles/json/{appId}/{clusterName}/{namespaceName}?ip={clientIp}
    public function get_apollo_complete_url()
    {
        $domain = $this->get_domain();
//
        $app_id = $this->get_app_id();

        $cluster_name = $this->get_cluster_name();

        $namespace_name = $this->get_namespace();

        return sprintf("%s/configfiles/json/%s/%s/%s", $domain, $app_id, $cluster_name, $namespace_name);
    }


}