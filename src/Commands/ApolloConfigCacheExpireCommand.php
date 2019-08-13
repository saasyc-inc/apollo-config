<?php

namespace ApolloConfig\Commands;

use ApolloConfig\ApolloConfig;
use ApolloConfig\ApolloConfigService;
use ApolloConfig\Configs\ApolloConfigConfigFactory;
use ApolloConfig\LaravelBridge\Functions;
use ApolloConfig\Services\ApolloConfigInit;
use Illuminate\Console\Command;

class ApolloConfigCacheExpireCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yiche:ApolloConfigCacheExpireCommand {namespace} {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '使特定键换粗立刻失效';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //这里是手动执行的命令所以不抛出异常
        $namespace = $this->argument('namespace');

        $key = $this->argument('key');

        $config = ApolloConfigConfigFactory::getByNamespace($namespace);

        ApolloConfigService::expired($key,$config);
    }
}
