<?php

namespace Ijeffro\Codes\Actions;

use NumberFormatter;

use Ijeffro\Codes\Models\Code;

class UnallocatedCodeCountAction
{
    public function __invoke(): array
    {
        $count = Code::query()->whereAllocated(false)->count();
        $numberFormatter = new NumberFormatter(config('app.locale'), NumberFormatter::SPELLOUT);      

        return [
            'message' => trans('code::generator.count', ['count' => $numberFormatter->format($count)]),
            'unallocated' => $count
        ];
    }
}
