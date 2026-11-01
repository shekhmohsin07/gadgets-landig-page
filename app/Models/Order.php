<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUSES = [
        'pending'    => 'Pending',
        'confirmed'  => 'Confirmed',
        'shipped'    => 'Shipped',
        'delivered'  => 'Delivered',
        'cancelled'  => 'Cancelled',
    ];

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public static function newNumber(): string
    {
        do {
            $number = 'GC' . strtoupper(Str::random(7));
        } while (self::query()->where('order_number', $number)->exists());

        return $number;
    }
}
