<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone',
        'full_address',
        'city',
        'province',
        'postal_code',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Auto-handle default address
    protected static function booted()
    {
        static::creating(function ($address) {
            if ($address->is_default) {
                // Jika address baru ditandai default, unset semua default lain milik user yang sama
                static::where('user_id', $address->user_id)
                    ->update(['is_default' => false]);
            }
        });
        
        static::updating(function ($address) {
            if ($address->is_default && $address->getOriginal('is_default') != true) {
                // Jika address diupdate menjadi default, unset semua default lain
                static::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }
}