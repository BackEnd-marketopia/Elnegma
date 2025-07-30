<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCheck extends Model
{
    protected $fillable = [
        'user_id',
        'discount_id',
        'comment',
        'price',
        'status',
        'final_price',
        'discount_value',
    ];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
