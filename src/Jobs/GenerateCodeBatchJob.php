<?php

namespace Ijeffro\Codes\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Ijeffro\Codes\Models\Code;

class GenerateCodeBatchJob implements ShouldQueue
{
    use Queueable;

    protected $chunk;
  
    /**
     * Create a new job instance.
     */
    public function __construct(array $chunk)
    {
        $this->chunk = $chunk;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(fn () => Code::query()->insert($this->chunk));
    }
}
