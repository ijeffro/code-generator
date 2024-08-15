<?php
 
namespace Ijeffro\Codes\Traits;

use Ijeffro\Codes\Data\CodeData;
use Ijeffro\Codes\Generator;

trait UniqueCode
{   

    /**
     * The default secret length
     *
     * @var int
     */
    protected static $length = 6;

    /**
     * Boots to the model
     * 
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {

                $model->secret = CodeData::validate([
                    'secret' => Generator::length(self::$length)->create()->code
                ])['secret'];

                $model->length = self::$length;
            }
        });
    }
}