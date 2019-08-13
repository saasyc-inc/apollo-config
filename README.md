## 为携程 Apollo 配置中心写的 laravel 客户端
 
依赖了　redis 扩展

###  需求说明

1. 实现获取配置

2. 兼容　laravel 的 env 配置  

保证存储在　apollo 中namespace为env的信息同步到本地

3. 定时更行配置 懒更新　只更新使用过的namespace

###  初始化说明



###  调用说明

```
    $info = ApolloConfig::get($key); //  yiche
    
    如果不希望抛出错误 希望对不存在的值 返回为 null 
    则调用 
    $info = ApolloConfig::getSilent($key); //  yiche
    
```

``` 调用默认命名空间

    $key = 'creator';
        
    $info = ApolloConfig::get($key); //  yiche
    
```


``` 调用 env 命名空间

    $key = 'creator'; 
           
    $info = ApolloConfig::get($key); //  yiche
```



when init
 0. check had init
 1. read apollo config (url app_id app_key)
 2. read env priviority
 (if apollo and env have same configs in order to not influence old env  u can give a higer priviority to env still think about this)
 3. read config from apollo and write to config files
 4. override env
 done


when update
 3. read config from apollo and write to config files
 4. override env

when read config
    1. read from file
    2. read from env
    3. read from apollo (in order to get a new config in real time)

when maintain config latest
    1. crontab do update




```
    初始化
    
    提供的命令  php artisan write_to_cache  将redis 中的数据存放于
    
    提供的命令  php artisan sync_env 将 apollo 中关于 env 的配置信息同步到 
    
    应该 可以配置 是否可以动态更新配置
```


#### 开发过程中的思考(不阅读不影响使用)
```
    采用延迟加载的模式
    
    一开始认为 配置应该存放于 redis 当中
    
    后面认为应该存放于文件 因为 php7.4 将会把 文件全部载入内存 
    
    最终思考的结果是可读性比性能重要 还是存放于redis 
    
    首先会维护一张 频次表 不会每次修改都去写入文件
```



