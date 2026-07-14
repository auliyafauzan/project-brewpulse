<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_name',
        'location',
        'items',
        'total_amount',
        'status'
    ];

    // Mengonversi otomatis format teks JSON di database menjadi array PHP
    protected $casts = [
        'items' => 'array',
    ];
}