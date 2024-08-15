<?php

namespace Ijeffro\Codes\Contracts;

use Ijeffro\Codes\Enums\CodeType;

use Ijeffro\Codes\Data\CodeData;

use Spatie\LaravelData\DataCollection;
use Symfony\Component\Console\Exception\InvalidArgumentException;

interface CodeGeneratorInterface
{
    /**
     * Generate a valid code
     * 
     * @param int $length
     * @param CodeType $type
     */
    public function generateValidCode(int $length, CodeType $type = CodeType::String);

    /**
     * Generate a valid batch of codes
     * 
     * @param int $size
     * @param int $length
     */
    public function generateValidBatch(int $size = 100, int $length = 6);

    /**
     * Random Number Generator
     *
     * @param int $length
     * 
     * @throws InvalidArgumentException
     */
    public function generateRandomNumber(int $length): int;

    /**
     * Check the code criteria
     * 
     * @param int $code
     */
    public function isInvalidCode(int $code): bool;
}
