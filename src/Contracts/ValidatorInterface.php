<?php

namespace Ijeffro\Codes\Contracts;

interface ValidatorInterface
{

    /**
     * Calling object methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public function __call(string $name, array $arguments): mixed;

    /**
     * Calling static methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments): mixed;
}
