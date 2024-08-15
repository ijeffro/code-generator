<?php

namespace Ijeffro\Codes;

use Ijeffro\Codes\Data\CodeData;

use Ijeffro\Codes\Services\CodeValidatorService;
use Ijeffro\Codes\Contracts\ValidatorInterface;

class Validator implements ValidatorInterface
{

    /**
     * The generated code
     *
     * @var int|string
     */
    public int|string $code;

    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $isPalindrome = false;

    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $hasLongSequence = false;

    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $hasRepeatedCharacters = false;
    
    /**
     * The desired code length.
     *
     * @var bool
     */
    public bool $hasMinimumUniqueCharacters = false;
    
    /**
     * The magic method mappings
     * 
     * @var array<string>
     */
    protected array $mappings = [
        'code' => 'code',
        'isPalindrome' => 'isPalindrome',
        'hasRepeatedCharacters' => 'hasRepeatedCharacters',
        'hasLongSequence' => 'hasLongSequence',
        'hasMinimumUniqueCharacters' => 'hasMinimumUniqueCharacters',
    ];

    /**
     * Generator Constructor
     */
    public function __construct(
        public CodeValidatorService $codeValidatorService
    ) {}

    /**
     * Calling object methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed
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
    public static function __callStatic(string $method, array $arguments): mixed
    {
        $instance = (new static(new CodeValidatorService));
        $calledFuction = $instance->mappings[$method];

        return $instance->$calledFuction(...$arguments);
    }

    /**
     * Set the code for validation
     * 
     * @param int $code
     */
    protected function code(int $code): self
    {  
        $this->code = $code; 
        return $this;
    }

    /**
     * Check if code is palindrome
     * 
     * @param int|null $code
     */
    protected function isPalindrome(int $code = null): bool
    {
        return $this->codeValidatorService->isPalindrome($code ? $code : $this->code);
        // return $this->codeValidatorService->isPalindrome($code ? $code : $this->code);
    }

    /**
     * Has repeated characters
     * 
     * @param int $amount
     * @param int|null $code
     * 
     * @return bool
     */
    protected function hasRepeatedCharacters(int $code, int $amount): bool
    {

        return $this->codeValidatorService
            ->hasRepeatedCharacters($code ? $code : $this->code, $amount);
    }

    /**
     * Has long sequence
     * 
     * @param int $amount
     * @param int|null $code
     * 
     * @return bool
     */
    protected function hasLongSequence(int $length, int $code = null): bool
    {
        return $this->codeValidatorService
            ->hasLongSequence($code ? $code : $this->code, $length);
    }

    /**
     * Has Minimum Unique Characters
     * 
     * @param int $amount
     * @param int|null $code
     * 
     * @return bool
     */
    protected function hasMinimumUniqueCharacters(int $amount, int $code = null): bool
    {
        return $this->codeValidatorService
            ->hasMinimumUniqueCharacters($code ? $code : $this->code, $amount);
    }
}
