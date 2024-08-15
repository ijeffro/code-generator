<?php

namespace Ijeffro\Codes\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Ijeffro\Codes\Traits\UniqueCode;

class Code extends Model
{
    use HasFactory, UniqueCode;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'secret',
        'allocated',
    ];
}
