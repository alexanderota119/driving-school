<?php

namespace App\Models;

use App\Traits\Models\BaseTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string $stars
 */
class Rating extends Model
{
    use HasFactory, SoftDeletes, BaseTraits;

    protected $fillable = [
        'stars',
    ];

    protected $casts = [
        'stars' => 'integer',
    ];

    public function ratingable()
    {
        return $this->morphTo();
    }
}
