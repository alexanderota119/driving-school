<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $text
 */
class Note extends Model
{
    use BaseTraits;

    protected $fillable = [
        'text',
        'userable_type',
        'userable_id',
    ];

    public function noteable(): MorphTo
    {
        return $this->morphTo();
    }

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }
}
