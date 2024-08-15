<?php 

namespace Ijeffro\Codes\Http\Requests;

use Spatie\LaravelData\Data;

use Spatie\LaravelData\Mappers\SnakeCaseMapper;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Exists;

#[MapOutputName(SnakeCaseMapper::class)]
class UnallocateCodeData extends Data {

    public function __construct(
        #[Exists('codes', 'secret')]
        public readonly int $code,
    ) {}
}