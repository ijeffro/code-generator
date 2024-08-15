<?php 

namespace Ijeffro\Codes\Http\Requests;

use Spatie\LaravelData\Data;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class AllocateCodeData extends Data {

    public function __construct(
        public readonly ?int $length,
    ) {}
}
