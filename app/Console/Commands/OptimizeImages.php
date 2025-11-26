<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\File;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:optimize-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = public_path('produtos');

        $files = File::allFiles($path);
        $count = count($files);
        $this->info("Otimizando {$count} imagens...");

        foreach ($files as $file) {
            $this->line("-> " . $file->getFilename());
            ImageOptimizer::optimize($file->getRealPath());
        }

        $this->info("✅ Todas as imagens foram otimizadas!");
    }
}
