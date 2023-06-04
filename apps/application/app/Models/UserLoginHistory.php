<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'was_successful',
        'meta',
    ];

    protected $casts = [
        'was_successful' => 'boolean',
        'meta'           => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
