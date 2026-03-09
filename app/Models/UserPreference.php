<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
    'email_notification',
    'order_notification',
    'promo_notification',
    'dark_mode',
];
    public function user()
{
    return $this->belongsTo(User::class);
}
}
