<?php

namespace Ijeffro\Codes\Commands;

use Domain\Access\Actions\Codes\UniqueCode;
use Domain\Access\Actions\Codes\ValidateCode;
use Domain\Access\Actions\Codes\GenerateCode;

use Illuminate\Database\Eloquent\Model;

use Ijeffro\Codes\Data\CodeData;
use Ijeffro\Codes\Generator;
use Ijeffro\Codes\Models\Code;
use Ijeffro\Codes\Models\Validation;


use Illuminate\Console\Command;

use function Laravel\Prompts\text;
use function Laravel\Prompts\table;
use function Laravel\Prompts\form;
use function Laravel\Prompts\select;
use function Laravel\Prompts\search;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\password;

use Ijeffro\Codes\Commands\GenerateCodeCommand;
use Ijeffro\Codes\Commands\GenerateCodeBatchCommand;
use Ijeffro\Codes\Contracts\CodeGeneratorInterface;

use Ijeffro\Codes\Jobs\GenerateCodeBatchJob;
use Ijeffro\Codes\Validator;
use NumberFormatter;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:setup {--codes} {--config} {--routes} {--models} {--migrations} {--translations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configure the Code Generator by publishing assets and generating valid codes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->handleRequiredAssets();

        if ($this->option('batch')) {
            $this->call(GenerateCodeBatchCommand::class);
            return $this->info("Successfully generated a batch of codes.");
        }

        if (!$this->option('batch')) {
            $generatedCode = $this->call(GenerateCodeCommand::class);
            return $this->info("Successfully generated $generatedCode as is currently unallocated.");
        }
        
    }

    public function handleRequiredAssets()
    {
        return match ($this->hasRequestedAssets()) {
            true => $this->whenProvidedAssets(),
            false => $this->whenNotProvidedAssets()
        };
    }

    public function hasRequestedAssets(): bool
    {
        return in_array(true, [
            'config' => $this->option('config'),
            'routes' => $this->option('routes'),
            'models' => $this->option('models'),
            'migrations' => $this->option('migrations'),
            'translations' => $this->option('translations'),
        ]);
    }

    public function publishAsset($asset): int
    {
        return $this->call('vendor:publish', ['--tag' => $asset]);
    }

    public function whenProvidedAssets(): void
    {
        if ($this->option('config')): $this->publishAsset('code-config'); endif;
        if ($this->option('routes')): $this->publishAsset('code-routes'); endif;
        if ($this->option('models')): $this->publishAsset('code-models'); endif;
        if ($this->option('migrations')): $this->publishAsset('code-migrations'); endif;
        if ($this->option('translations')): $this->publishAsset('code-translations'); endif;
    }

    public function whenNotProvidedAssets(): void
    {
        if (confirm(trans('code::generator.setup.questions.config'))): $this->publishAsset('code-config'); endif;
        if (confirm(trans('code::generator.setup.questions.routes'))): $this->publishAsset('code-routes'); endif;
        if (confirm(trans('code::generator.setup.questions.models'))): $this->publishAsset('code-models'); endif;
        if (confirm(trans('code::generator.setup.questions.migrations'))): $this->publishAsset('code-migrations'); endif;
        if (confirm(trans('code::generator.setup.questions.translations'))): $this->publishAsset('code-translations'); endif;
    }
}
