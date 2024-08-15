<?php

namespace Ijeffro\Codes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ijeffro\Codes\Validator
 */
class ValidatorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'validator';
    }
}
