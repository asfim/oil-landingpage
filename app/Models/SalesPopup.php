<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPopup extends Model
{
    protected $fillable = [
        'customer_name',
        'time_ago',
        'product_name',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
