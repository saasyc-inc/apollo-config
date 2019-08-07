### 为携程 Apollo 配置中心写的 laravel 客户端

```
    放弃对原先 SapiConfig 的支持(sapi_config 中的表里的数据) 无法做到无缝迁移(成本不合适) 命名空间会不一样

获取配置参数  ApolloConfig\ApolloConfig::get($key,$id);
获取配置参数  ApolloConfig\ApolloConfig::get($key,$id);

```

```
    初始化
    
    提供的命令  php artisan write_to_cache  将redis 中的数据存放于
```

```
    采用延迟加载的模式
    
    反复犹豫 
    一开始认为 配置应该存放于 redis 当中
    后面认为应该存放于文件 因为 php7.4 将会把 文件全部载入内存 
    
    最终犹豫 认为 可读性比性能重要 还是存放于redis 
    
    首先会维护一张 频次表 不会每次修改都去写入文件
    
    
```

```
    提供的命令  php artisan write_to_cache  将redis 中的数据存放于
    
    提供的命令  php artisan sync_env 将 apollo 中关于 env 的配置信息同步到 
    
    应该 可以配置 是否可以动态更新配置
```


```
    命名空间 
    有两个默认的命名空间 
    一个是 env 所对应的命名空间
    一个是默认的命名空间 命名空间的名称可以在 config 中配置
    其余的惰性更新
```

``` 
    env 的合并策略
```
