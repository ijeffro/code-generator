<?php

namespace Ijeffro\Codes\Services;

use Ijeffro\Codes\Contracts\CodeValidatorInterface;

class CodeValidatorService implements CodeValidatorInterface
{
    /**
     * Check is palindrome
     * 
     * @param int $code
     */
    public function isPalindrome(int $code): bool
    {
        return (string) $code === strrev($code);
    }

    /**
     * Has repeated characters
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasRepeatedCharacters(int $code, int $amount): bool
    {
        foreach (count_chars($code, 1) as $val) {
            if ($val > $amount): return true; endif;
        }

        return false;
    }

    /**
     * Code has long sequence
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasLongSequence(int $code, int $length): bool
    {
        return preg_match('/(.)\1{' . ($length - 1) . '}/', $code);
    }

    /**
     * Code has Minimum Unique Characters
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasMinimumUniqueCharacters(int $code, int $amount): bool
    {
        return count(array_unique(str_split($code))) >= $amount;
    }
}
