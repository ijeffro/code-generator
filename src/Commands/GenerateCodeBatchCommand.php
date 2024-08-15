<?php

namespace Ijeffro\Codes\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use Ijeffro\Codes\Generator;

use Ijeffro\Codes\Models\Code;
use Ijeffro\Codes\Jobs\GenerateCodeBatchJob;

class GenerateCodeBatchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:generate:batch {size} {--queue}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a batch of verified codes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $batchSize = $this->argument('size');
        $generator = Generator::batch($batchSize)->make();

        collect($generator->codes)->chunk(20)->each(function ($chunk) {
            if ($this->option('queue')): return GenerateCodeBatchJob::dispatch($chunk->toArray()); endif;
            return DB::transaction(fn () => Code::query()->upsert($chunk->toArray(), 'secret'));
        });
    }
}
