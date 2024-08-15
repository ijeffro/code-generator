<?php

namespace Ijeffro\Codes\Http\Resources;

use Spatie\LaravelData\Resource;


class UnallocatedCodeCountResource extends Resource
{
    public function __construct(
        public ?string $message,
        public ?string $unallocated,
    ) {}
}
