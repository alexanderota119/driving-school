<?php

namespace App\Models;

use App\Traits\Models\NoteTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * @property int    $id
 * @property bool   $is_primary
 * @property Carbon $can_receive_sms
 * @property string $number
 * @property string $tenant_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Phone extends Model
{
    use BelongsToTenant, SoftDeletes;
    use HasFactory, NoteTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_primary',
        'can_receive_sms',
        'number',
        'tenant_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'              => 'integer',
        'is_primary'      => 'boolean',
        'can_receive_sms' => 'datetime',
    ];

    /**
     * @return MorphTo
     */
    public function phoneable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getNumberFmtAttribute()
    {
        $cleaned = preg_replace('/[^[:digit:]]/', '', $this->number);
        preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);

        return "({$matches[1]}) {$matches[2]}-{$matches[3]}";
    }
}
