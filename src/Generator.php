<?php

namespace Ijeffro\Codes;

use Spatie\LaravelData\DataCollection;
use Ijeffro\Codes\Contracts\GeneratorInterface;
use Ijeffro\Codes\Services\CodeGeneratorService;

class Generator extends Validator implements GeneratorInterface
{

    /**
     * The desired code length.
     *
     * @var int|string
     */
    public int|string $code;

    /**
     * The desired code length.
     *
     * @var DataCollection
     */
    public DataCollection $codes;

    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $queue = false;

    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $isBatch = false;

    /**
     * The desired code length.
     *
     * @var int
     */
    public int $batchSize;

    /**
     * The desired code length.
     *
     * @var int
     */
    public int $length = 6;

    /**
     * The magic method mappings
     * 
     * @var array<string>
     */
    protected array $mappings = [
        'make' => 'make',
        'batch' => 'batch',
        'length' => 'length',
    ];

    /**
     * Generator Constructor
     * 
     * @param CodeGeneratorService $codeGeneratorService
     */
    public function __construct(
        public CodeGeneratorService $codeGeneratorService
    ) {}

    /**
     * Calling object methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public function __call(string $name, array $arguments): self
    {
        $functionName = $this->mappings[$name];

        return $this->$functionName(...$arguments);
    }

    /**
     * Calling static methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments): self
    {
        $instance = new static(new CodeGeneratorService);
        $calledFuction = $instance->mappings[$method];

        return $instance->$calledFuction(...$arguments);
    }

    /**
     * Define the code's length
     */
    protected function length(int $size): self
    {
        $this->length = $size; return $this;
    }

    /**
     * Define the code's length
     */
    protected function batch(int $size): self
    {
        $this->batchSize = $size;
        $this->isBatch = true;

        return $this;
    }
    
    /**
     * Make new codes
     */
    protected function make(): self
    {
        if ($this->isBatch):
            $this->codes = $this->codeGeneratorService
                ->generateValidBatch($this->batchSize, $this->length);
        endif;

        if (!$this->isBatch):
            $this->code = $this->codeGeneratorService
                ->generateValidCode($this->length)->secret;
        endif;

        return $this;
    }
}
