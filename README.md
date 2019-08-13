## 为携程 Apollo 配置中心写的 laravel 客户端
 
依赖了　redis 扩展

###  需求说明

1. 实现获取配置

2. 兼容　laravel 的 env 配置  

保证存储在　apollo 中namespace为env的信息同步到本地

3. 关于更新 不主动更新　在配置中设置超时时间

提供　命令　使得所有特定缓存失效　



#### 初始化　

    php artisan vendor:publish

    然后在根据需要修改对应的文件　
        config/apollo/apollo.php

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


#### 开发过程中的思考(不阅读不影响使用)
```
    采用延迟加载的模式
    
    一开始认为 配置应该存放于 redis 当中
    
    后面认为应该存放于文件 因为 php7.4 将会把 文件全部载入内存 
    
    最终思考的结果是可读性比性能重要 还是存放于redis 
    
    首先会维护一张 频次表 不会每次修改都去写入文件
```



