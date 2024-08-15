<?php

namespace Ijeffro\Codes\Http\Resources;

use Spatie\LaravelData\Resource;


class CodeAllocationResource extends Resource
{
    public function __construct(
        public ?string $code,
        public ?string $message,
    ) {}
}
