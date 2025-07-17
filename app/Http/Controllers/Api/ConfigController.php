<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\Config;
use App\Models\Feed;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ConfigController extends Controller
{
    public function config()
    {
        $user = auth('api')->user();

        $config = Config::select(
            'terms_and_conditions',
            'about_us',
            'privacy_policy',
            'android_version',
            'ios_version',
            'android_url',
            'ios_url',
            'facebook_link',
            'twitter_link',
            'instagram_link',
            'youtube_link',
            'snapchat_link',
            'tiktok_link',
            'whatsapp_link',
            'linkedin_link',
            'telegram_link',
            'website_link',
        )->first();

        $cities = City::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name')->get();

        $adsQuery = Advertisement::whereDate('start_date', '<=', Carbon::today())
            ->whereDate('end_date', '>=', Carbon::today());

        if ($user)
            $adsQuery->where(function ($query) use ($user) {
                $query->whereJsonContains('city_id', 'all')
                    ->orWhereJsonContains('city_id', (string) $user->city_id);
            });
        else
            $adsQuery->whereJsonContains('city_id', 'all');

        $ads = $adsQuery->first();

        if ($ads) {
            $ads->increment('viewed');
        }

        return Response::api(__('message.Success'), 200, true, null, ['config' => $config, 'cities' => $cities, 'ads' => $ads]);
    }
    public function homePage()
    {
        $banners = Banner::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image')
            ->get();

        $categories = Category::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image')
            ->orderBy('sort_order', 'asc')
            ->take(20)
            ->get();

        $vendors = Vendor::with(['category' => function ($query) {
            $query->select(
                'id',
                app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name'
            );
        }])
            ->where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();


        return Response::api(__('message.Success'), 200, true, null, ['banners' => $banners, 'categories' => $categories, 'vendors' => $vendors]);
    }

    public function clickedAds($id)
    {
        $ads = Advertisement::findOrFail($id);
        $ads->increment('clicked');
        return Response::api(__('message.Success'), 200, true, null, ['ads' => $ads]);
    }

    public function vendorHomePage()
    {
        $user = auth('api')->user();

        $vendor = $user->vendor;

        if ($user->user_type != 'vendor')
            return Response::api(__('message.unauthorized'), 401, false, 401);

        if ($vendor->status == 'pending' || $user->status == 'pending')
            return Response::api(__('message.You are pending, wait until admin accept you'), 400, false, 400);

        if ($user->status != 'active')
            return Response::api(__('message.You are blocked'), 401, false, 401);

        if ($vendor->status == 'rejected')
            return Response::api(__('message.You are rejected'), 400, false, 400);

        $discounts = $vendor->discounts()
            ->withCount([
                'discountChecks as pending_checks_count' => function ($query) {
                    $query->where('status', 'pending');
                },
                'discountChecks as accepted_checks_count' => function ($query) {
                    $query->where('status', 'accepted');
                },
            ])
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        $vendor->load(['category' => function ($query) {
            $query->select(
                'id',
                app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name'
            );
        }]);
        $vendor->citys_id = json_decode($vendor->citys_id, true);

        $vendor->cities = City::whereIn('id', $vendor->citys_id)
            ->select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name')
            ->get();

        $discountsActive = $vendor->discounts()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();

        $discountsExpired = $vendor->discounts()
            ->where('end_date', '<', now())
            ->count();
        $discountsTotal = $vendor->discounts()->count();

        return Response::api(__('message.Success'), 200, true, null, [
            'vendor' => $vendor,
            'discounts' => $discounts,
            'discounts_active' => $discountsActive,
            'discounts_expired' => $discountsExpired,
            'discounts_total' => $discountsTotal,
        ]);
    }
}
