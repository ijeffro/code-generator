<?php

namespace Ijeffro\Codes\Actions;

use Ijeffro\Codes\Models\Code;
use Ijeffro\Codes\Http\Requests\UnallocateCodeData;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UnallocateCodeAction
{

    public function __invoke(UnallocateCodeData $unallocateCodeData): array
    {
        $code = Code::query()->where("secret", $unallocateCodeData->code);

        throw_unless(
            $code->exists(), 
            NotFoundHttpException::class, 
            trans('code::generator.missing', [
                'code' => $unallocateCodeData->code
            ])
        );

        $code->update(['allocated' => false]);
        $code = $code->first();

        return [
            'message' => trans('code::generator.unallocated', [
                'code' => $code->secret,
            ]),
            'code' => $code->secret,
        ];
    }
}
