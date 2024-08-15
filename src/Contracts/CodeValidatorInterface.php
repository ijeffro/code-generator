<?php

namespace Ijeffro\Codes\Contracts;

interface CodeValidatorInterface
{
    /**
     * Check is palindrome
     * 
     * @param int $code
     */
    public function isPalindrome(int $code): bool;

    /**
     * Has repeated characters
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasRepeatedCharacters(int $code, int $amount): bool;

    /**
     * Has long sequence
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasLongSequence(int $code, int $length): bool;

    /**
     * Has Minimum Unique Characters
     * 
     * @param int $code
     * @param int $amount
     * 
     * @return bool
     */
    public function hasMinimumUniqueCharacters(int $code, int $amount): bool;
}
