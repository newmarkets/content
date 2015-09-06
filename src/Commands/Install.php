<?php namespace NewMarket\Content\Commands;

use Illuminate\Console\Command;

class Install extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'content:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs content management tables, configs, views and assets';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function fire()
    {

        $this->info('Publishing CMS config file');
        $this->call('vendor:publish', [
            '--provider' => 'NewMarket\\Content\\Providers\\ContentServiceProvider',
            '--tag' => ['config']
        ]);

//        $this->info('Publishing CMS view files');
//        $this->call('vendor:publish', [
//            '--provider' => 'NewMarket\\Content\\Providers\\ContentServiceProvider',
//            '--tag' => ['views']
//        ]);

        $this->info('Publishing CMS public assets');
        $this->call('vendor:publish', [
            '--provider' => 'NewMarket\\Content\\Providers\\ContentServiceProvider',
            '--tag' => ['assets']
        ]);

        $this->info('Creating CMS database tables');
        $this->call('migrate', [
            '--path' => 'vendor/newmarkets/content/src/database/migrations'
        ]);

    }

}
