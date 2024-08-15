<?php

use Illuminate\Support\Facades\Route;

use Ijeffro\Codes\Http\Controllers\UnallocatedCountController;
use Ijeffro\Codes\Http\Controllers\UnallocateController;
use Ijeffro\Codes\Http\Controllers\AllocateController;

if(config('code.routes.enabled')){

    Route::prefix('/api')->group(function ($slug) {
        Route::prefix(config('code.routes.prefix'))->group(function () {

            Route::post('/allocate', AllocateController::class);
            
            Route::prefix('unallocate')->group(function () {
                Route::post('/', UnallocateController::class);
                Route::get('/count', UnallocatedCountController::class);

            });
        });
    });
}
