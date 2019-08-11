<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/5/19
 * Time: 11:38 AM
 */

return [
    //主动更新 如果为true  则(目前)定时抓取 appolo 的配置 否则 也不接受更新(收到更新通知后不做处理 且不发轮询)
    //对历史项目建议为 false  避免误改动
    'positive_update'               => false,
    //缓存信息临时目录
//    'snap_dir'          => 'apollo',
    //默认的命名空间
    'default_namespace'             => 'default',
    //apollo 的 app_id　
    'default_app_id'                => 'SampleApp',
    //apollo 默认的 cluster_name
    'default_cluster_name'          => 'default',
    //默认的域名
    'default_domain'                => 'http://apollo-dev.web-docker.saasyc.com',
    //默认env对应的命名空间
    'default_env_related_namespace' => 'env',

    //在redis中的key的前缀
    'cached_key_prefix'             => 'apollo_key_prefix',
    //获取阿波罗配置请求说明
    'request_apollo_illumination'   => '请求配置中心',
];
