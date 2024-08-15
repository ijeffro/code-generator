<?php

namespace Ijeffro\Codes\Services;

use Carbon\Carbon;

use Spatie\LaravelData\DataCollection;

use Ijeffro\Codes\Data\CodeData;
use Ijeffro\Codes\Enums\CodeType;
use Ijeffro\Codes\Services\CodeValidatorService;
use Ijeffro\Codes\Contracts\CodeGeneratorInterface;

use Symfony\Component\Console\Exception\InvalidArgumentException;

class CodeGeneratorService extends CodeValidatorService implements CodeGeneratorInterface
{   

    /**
     * The desired code length.
     *
     * @var CodeData
     */
    public CodeData $code;

    /**
     * The desired code length.
     *
     * @var DataCollection
     */
    public DataCollection $codes;

    /**
     * Generate a random code
     * 
     * @param int $length
     */
    
    /**
     * Generate a valid code
     * 
     * @param int $length
     */

     
    public function __construct() {}

    /**
     * Generate a valid code
     * 
     * @param int $length
     */
    public function generateValidCode(int $length, CodeType $type = CodeType::String): CodeData
    {
        do {
            match ($type) {
                CodeType::Integer => $code = (int) $this->generateRandomNumber($length),
                CodeType::String => $code = (string) $this->generateRandomNumber($length),
            };
        } while ($this->isInvalidCode($code));

        return CodeData::from([
            'secret' => $code,
            'allocated' => false,
            'length' => $length,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    /**
     * Generate a valid batch of codes
     * 
     * @param int $size
     * @param int $length
     */
    public function generateValidBatch(int $size = 100, int $length = 6): DataCollection
    {
        $codes = [];

        for ($i = 0; $i < $size; $i++) {
            $code = $this->generateValidCode($length);

            $codes[] = [
                'secret' => $code->secret,
                'length' => $length,
                'allocated' => $code->allocated,
                'created_at' => $code->createdAt,
                'updated_at' => $code->updatedAt
            ];
        }

        return new DataCollection(CodeData::class, $codes);
    }

    /**
     * Random Number Generator
     *
     * @throws InvalidArgumentException
     */
    public function generateRandomNumber(int $length): int
    {
        if ($length <= 0):
            throw new InvalidArgumentException(trans('code::length')); endif;

        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;

        return mt_rand($min, $max);
    }

    /**
     * Check the code criteria
     * 
     * @param int $code @return bool
     */
    public function isInvalidCode(int $code): bool
    {
        return $this->isPalindrome($code) 
            || $this->hasRepeatedCharacters($code, 3) 
            || $this->hasLongSequence($code, 3) 
            || !$this->hasMinimumUniqueCharacters($code, 3);
    }
}