<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/2/19
 * Time: 1:37 AM
 */

namespace ApolloConfig;


class RetrieveApolloRequestParams
{
    public static function retrieve($data)
    {
        [
            'url'          => $url,
            'app_id'       => $app_id,
            'cluster_name' => $cluster_name,
        ] = $data;

        return [
            'config_server_url' => $url,
            'appId'             => $app_id,
            'clusterName'       => $cluster_name,
        ];
    }

    public function retrieve_url($data)
    {
        //{config_server_url}/configfiles/json/{appId}/{clusterName}/{namespaceName}?ip={clientIp}

        [
            'url'            => $url,
            'app_id'         => $app_id,
            'cluster_name'   => $cluster_name,
            'namespace_name' => $namespace_name,
        ] = $data;

        $url = sprintf("%s/configfiles/json/%s/%s/%s", $url, $app_id, $cluster_name, $namespace_name);
    }
}