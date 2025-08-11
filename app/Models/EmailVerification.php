<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class EmailVerification extends Model
{
    protected $fillable = ['user_id', 'code', 'expires_at'];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function expired()
    {
        return $this->expires_at?->isPast() ?? false;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
