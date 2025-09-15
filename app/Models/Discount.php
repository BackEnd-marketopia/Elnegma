<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable =
    [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'start_date',
        'end_date',
        'vendor_id',
        'image',
        'viwe_count',
    ];

    protected $appends = ['title', 'description'];

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function discountChecks()
    {
        return $this->hasMany(DiscountCheck::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'discount_checks', 'discount_id', 'user_id')
            ->withPivot('id');
    }
}
