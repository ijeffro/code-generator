<?php

namespace Ijeffro\Codes\Actions;

use Ijeffro\Codes\Models\Code;
use Ijeffro\Codes\Generator;

use Ijeffro\Codes\Http\Requests\AllocateCodeData;

class AllocateCodeAction
{
    public function __invoke(AllocateCodeData $allocateCodeData): array
    {
        $secret = $this->allocatableCode($allocateCodeData);

        return [
            'message' => trans('code::generator.allocated', [
                'code' => $secret,
            ]),
            'code' => $secret,
        ];
    }

    public function allocatableCode(AllocateCodeData $allocateCodeData): string
    {
        $allocatableCode = Code::where('allocated', false)
            ->where('length', $allocateCodeData->length);

        return match ($allocatableCode->exists()) {
            true => $allocatableCode->pluck('secret')->first(),
            false => Generator::length($allocateCodeData->length)->make()->code
        };
    }


}
