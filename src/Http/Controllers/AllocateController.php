<?php

namespace Ijeffro\Codes\Http\Controllers;

use Ijeffro\Codes\Http\Resources\CodeAllocationResource;
use Ijeffro\Codes\Http\Requests\AllocateCodeData;

use Ijeffro\Codes\Actions\AllocateCodeAction;

class AllocateController
{
    public function __invoke(
        AllocateCodeData $allocateCodeData,
        AllocateCodeAction $allocateCodeAction,
        CodeAllocationResource $codeAllocationResource
    ): CodeAllocationResource {
        return $codeAllocationResource::from($allocateCodeAction($allocateCodeData));
    }
}
