<?php

namespace Ijeffro\Codes\Commands;

use Ijeffro\Codes\Models\Code;

use Ijeffro\Codes\Generator;
use Illuminate\Console\Command;

class GenerateCodeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a validated code.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        return $this->info(trans('code::generator.completed', [
            'code' => Generator::make()->code
        ]));
    }
}
