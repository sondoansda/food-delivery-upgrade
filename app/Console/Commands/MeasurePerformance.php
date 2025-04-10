<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class MeasurePerformance extends Command
{
    protected $signature = 'measure:performance';
    protected $description = 'Measure performance of the /restaurants route (before optimization)';

    public function handle()
    {
        $iterations = 1000;
        $url = 'http://localhost:8080/food-delivery-app/public/restaurants';

        $this->info("Starting performance test with $iterations requests...");

        $bar = $this->output->createProgressBar($iterations);
        $bar->start();

        $start = microtime(true);

        for ($i = 0; $i < $iterations; $i++) {
            $response = Http::timeout(30)->retry(2, 500)->get($url);

            if (!$response->successful()) {
                $this->newLine();
                $this->error("❌ Request failed at iteration $i");
                return;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $end = microtime(true);
        $executionTime = ($end - $start) * 1000;
        $averageTime = $executionTime / $iterations;

        $this->info("✅ Execution time for $iterations requests: " . round($executionTime, 2) . " ms");
        $this->info("✅ Average time per request: " . round($averageTime, 2) . " ms");
    }
}
