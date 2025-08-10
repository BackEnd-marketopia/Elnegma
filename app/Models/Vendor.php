<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

class Vendor extends Model
{
    protected $fillable =
    [
        'name_ar',
        'name_en',
        'logo',
        'cover',
        'description',
        'whatsapp',
        'facebook',
        'instagram',
        'address',
        'google_map_link',
        'citys_id',
        'category_id',
        'user_id',
        'status',
    ];
    protected $appends = ['is_wished', 'rate'];

    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getIsWishedAttribute()
    {
        $user = auth('api')->user();
        if (!$user)
            return false;

        $isWished = Wishlist::where('user_id', $user->id)->where('vendor_id', $this->id)->first();
        if ($isWished)
            return true;
        else
            return false;
    }
    public function getRateAttribute()
    {
        $average = Rate::where('vendor_id', $this->id)
            ->select('rate')
            ->average('rate');

        return $average ?? 0;
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
