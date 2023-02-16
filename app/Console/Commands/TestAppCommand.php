<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TestAppCommand extends Command
{
    use WithFaker;

    protected $signature = 'test:app';

    protected $description = 'Runs simple tests';

    public function handle(): int
    {
        try {
            $this->line('');
            $this->info('Starting tests');

            $this->setUpFaker();

            $slug = Str::slug($this->faker->words($this->faker->numberBetween(4, 8), true));

            $this->line('');
            $this->warn($slug);

            $this->line('');
            $this->info("Done.\n");

            return 0;
        } catch (\Exception $e) {
            $this->line('');
            $this->error($e->getMessage());
            $this->line('');
            Log::error($e->getMessage());

            return 1;
        }
    }
}
