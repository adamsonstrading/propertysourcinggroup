<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class OptimizeApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize the application for maximum performance';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Optimizing application for maximum performance...');
        $this->newLine();

        // Clear all caches first
        $this->info('📦 Clearing old caches...');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        $this->info('✅ Caches cleared');
        $this->newLine();

        // Optimize configuration
        $this->info('⚙️  Caching configuration...');
        Artisan::call('config:cache');
        $this->info('✅ Configuration cached');
        $this->newLine();

        // Optimize routes
        $this->info('🛣️  Caching routes...');
        Artisan::call('route:cache');
        $this->info('✅ Routes cached');
        $this->newLine();

        // Optimize views
        $this->info('👁️  Compiling views...');
        Artisan::call('view:cache');
        $this->info('✅ Views compiled');
        $this->newLine();

        // Optimize autoloader
        $this->info('🔧 Optimizing autoloader...');
        exec('composer dump-autoload -o 2>&1', $output, $returnCode);
        if ($returnCode === 0) {
            $this->info('✅ Autoloader optimized');
        } else {
            $this->warn('⚠️  Could not optimize autoloader');
        }
        $this->newLine();

        $this->info('🎉 Application optimization complete!');
        $this->info('💡 Your website should now load instantly!');

        return 0;
    }
}
