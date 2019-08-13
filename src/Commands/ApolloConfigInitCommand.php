<?php

namespace ApolloConfig\Commands;

use Illuminate\Console\Command;

class ApolloConfigInitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'yiche:ApolloConfigInitCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'apollo 配置初始化';

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

    }
}
