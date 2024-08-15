<?php

namespace Ijeffro\Codes\Http\Controllers;

use Ijeffro\Codes\Actions\UnallocateCodeAction;
use Ijeffro\Codes\Http\Requests\UnallocateCodeData;
use Ijeffro\Codes\Http\Resources\CodeAllocationResource;

class UnallocateController
{
    public function __invoke(
        UnallocateCodeData $unallocateCodeData,
        UnallocateCodeAction $unallocateCodeAction,
        CodeAllocationResource $codeAllocationResource
    ): CodeAllocationResource {
        return $codeAllocationResource::from(($unallocateCodeAction)($unallocateCodeData));
    }
}
