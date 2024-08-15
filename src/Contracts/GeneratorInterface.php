<?php

namespace Ijeffro\Codes\Contracts;

interface GeneratorInterface
{
    /**
     * Calling object methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public function __call(string $name, array $arguments): self;

    /**
     * Calling static methods
     * 
     * @param string $name
     * @param array $arguments
     * 
     * @return mixed
     */
    public static function __callStatic(string $method, array $arguments): self;
}
