<?php 

namespace Ijeffro\Codes\Data;

use Carbon\Carbon;

use Ijeffro\Codes\Models\Code;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\Validation\Unique;


#[MapOutputName(SnakeCaseMapper::class)]
class CodeData extends Data {

    public function __construct(
        #[Unique(Code::class)]
        public readonly string $secret,
        public readonly int $length,
        public readonly ?bool $allocated,
        public readonly ?Carbon $createdAt,
        public readonly ?Carbon $updatedAt,
    ) {}    
}