<?php

namespace Ijeffro\Codes\Http\Controllers;

use Ijeffro\Codes\Actions\UnallocatedCodeCountAction;
use Ijeffro\Codes\Http\Resources\UnallocatedCodeCountResource;

class UnallocatedCountController
{
    public function __invoke(
        UnallocatedCodeCountAction $unallocatedCodeCountAction,
        UnallocatedCodeCountResource $unallocatedCodeCountResource
    ): UnallocatedCodeCountResource {
        return $unallocatedCodeCountResource::from(($unallocatedCodeCountAction)());
    }
}
