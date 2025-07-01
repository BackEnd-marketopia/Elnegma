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
            'image_of_card',
            'price_of_card',
            app()->getLocale() == 'ar' ? 'description_of_card_arabic as description_of_card' : 'description_of_card_english as description_of_card',
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

        $feeds = Feed::orderByDesc('created_at')
            ->take(5)
            ->get();

        $categories = Category::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image', 'is_sport')
            ->orderBy('sort_order', 'asc')
            ->take(20)
            ->get();

        $vendors = Vendor::select('id', 'name', 'description', 'cover', 'category_id')
            ->with(['category' => function ($query) {
                $query->select(
                    'id',
                    app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name'
                );
            }])
            ->where('status', 'accepted')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();


        return Response::api(__('message.Success'), 200, true, null, ['banners' => $banners, 'feeds' => $feeds, 'categories' => $categories, 'vendors' => $vendors]);
    }

    public function clickedAds($id)
    {
        $ads = Advertisement::findOrFail($id);
        $ads->increment('clicked');
        return Response::api(__('message.Success'), 200, true, null, ['ads' => $ads]);
    }
}
