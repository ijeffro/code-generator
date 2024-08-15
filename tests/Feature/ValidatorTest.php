<?php

namespace Tests\Feature;

use Orchestra\Testbench\TestCase;

use Ijeffro\Codes\Generator;
use Ijeffro\Codes\Validator;


class ValidatorTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'Ijeffro\Codes\Providers\CodeServiceProvider'
        ];
    }
    
    public function test_code_is_palindrome()
    {
        $palindrome_code = 12521;
        $test = Validator::isPalindrome($palindrome_code);

        $this->assertTrue($test);
    }

    public function test_code_is_not_palindrome()
    {
        $none_palindrome_code = 123456;
        $test = Validator::isPalindrome($none_palindrome_code);
        $this->assertFalse($test);
    }

    public function test_has_repeated_characters()
    {
        $code_repeated_with_characters = 122256;
        $test = Validator::hasRepeatedCharacters($code_repeated_with_characters, 1);

        $this->assertTrue($test);
    }

    public function test_has_no_repeated_characters()
    {
        $code_repeated_without_characters = 123456;
        $test = Validator::hasRepeatedCharacters($code_repeated_without_characters, 1);

        $this->assertFalse($test);
    }

}
