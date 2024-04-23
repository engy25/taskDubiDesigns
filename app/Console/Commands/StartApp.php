<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class StartApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start app with migrations and seeders and factories and serve';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $this->info('Start the app');

        // Run migrations
        Artisan::call('migrate');
        $this->info('Migrations completed. ');

        // Seed the database and factory
        Artisan::call('db:seed');
        $this->info('Seeders completed.');

        // Start the development server in the background
        $this->info('Start the development server. ');
        shell_exec('php artisan serve --port=8000 --host=localhost --quiet &');

        $this->info('Application started successfully at http://localhost:8000');

        // Start the queue worker
        $this->info('Starting queue ');
        Artisan::call('queue:work', ['--daemon' => true]);

        $this->info('Queue worker started.');

        return 1;
    }
}
