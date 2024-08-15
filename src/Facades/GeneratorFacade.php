<?php

namespace Ijeffro\Codes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ijeffro\Codes\Generator
 */
class GeneratorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'generator';
    }
}
