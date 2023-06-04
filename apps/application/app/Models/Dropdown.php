<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property string $name
 * @property string $slug
 * @property string $type_name
 * @property int    $sort
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Dropdown extends Model
{
    use BelongsToTenant, SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'type_name',
        'sort',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('sorted', function (Builder $builder) {
            $builder->orderBy('sort')->orderBy('name');
        });
    }

    // Article model
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
