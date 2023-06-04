<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

trait BaseTraits
{
    use AddressTrait, NoteTrait, SoftDeletes,
        HasFactory, RevisionableTrait;

    protected $revisionForceDeleteEnabled = true;

    protected $revisionCleanup = true;

    protected $revisionEnabled = true;

    protected $historyLimit = 100;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($user) {
            \Cache::forget(self::class.'-options');
        });

        static::updated(function ($user) {
            \Cache::forget(self::class.'-options');
        });
    }
}
