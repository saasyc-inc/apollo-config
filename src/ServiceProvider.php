<?php
/**
 * Created by PhpStorm.
 * User: zhu
 * Date: 8/12/19
 * Time: 11:43 AM
 */

namespace ApolloConfig;

use ApolloConfig\Commands\ApolloConfigInitCommand;
use ApolloConfig\Configs\ApolloConfigConfigFactory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    const alias = 'ApolloConfig';
    
    protected $commands = [
        ApolloConfigInitCommand::class
    ];

    public function register()
    {
        //依赖注入
        $this->app->singleton(ApolloConfig::class, function () {
            return ApolloConfigConfigFactory::getDefaultConfig();
        });

        $alias = self::alias;

        $this->app->alias(ApolloConfig::class, $alias);
        
        $this->commands($this->commands);
    }

    public function provides()
    {
        $alias = self::alias;

        return [ApolloConfig::class, $alias];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $config_path =
            sprintf('%s/%s',
                __DIR__,
                '/Configs/apollo.php'
            );

        $this->publishes([
            $config_path => config_path('apollo/apollo.php'),
        ]);
    }

    protected function registerCommands()
    {
//        $this->registerInstallCommand();
        $this->commands('command.eternaltree.install');
    }


}