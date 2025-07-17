<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\UpdatePofileRequest;
use App\Models\User;
use App\Models\Code;
use App\Models\Vendor;
use App\Models\Discount;
use App\Models\DiscountCheck;
use App\Models\Category;
use App\Models\City;
use App\Models\Advertisement;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // إحصائيات المستخدمين
        $users = User::where('user_type', 'user')->count();
        $vendors = User::where('user_type', 'vendor')->count();
        $activeUsers = User::where('user_type', 'user')->where('status', 'active')->count();
        $activeVendors = User::where('user_type', 'vendor')->where('status', 'active')->count();
        $pendingVendors = User::where('user_type', 'vendor')->where('status', 'pending')->count();

        // إحصائيات التجار والمتاجر
        $acceptedVendors = Vendor::where('status', 'accepted')->count();
        $pendingVendorsStore = Vendor::where('status', 'pending')->count();
        $rejectedVendors = Vendor::where('status', 'rejected')->count();

        // إحصائيات الخصومات
        $totalDiscounts = Discount::count();
        $activeDiscounts = Discount::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->count();
        $expiredDiscounts = Discount::where('end_date', '<', now())->count();
        $upcomingDiscounts = Discount::where('start_date', '>', now())->count();

        // إحصائيات طلبات الخصم
        $totalDiscountRequests = DiscountCheck::count();
        $pendingDiscountRequests = DiscountCheck::where('status', 'pending')->count();
        $acceptedDiscountRequests = DiscountCheck::where('status', 'accepted')->count();
        $canceledDiscountRequests = DiscountCheck::where('status', 'canceled')->count();

        // إحصائيات التصنيفات والمدن
        $totalCategories = Category::count();
        $totalCities = City::count();
        $totalAds = Advertisement::count();
        $totalBanners = Banner::count();

        // إحصائيات المشاهدات
        $totalDiscountViews = Discount::sum('viwe_count');
        $totalAdsViews = Advertisement::sum('viewed');
        $totalAdsClicks = Advertisement::sum('clicked');

        // إحصائيات هذا الشهر
        $currentMonth = Carbon::now()->startOfMonth();
        $usersThisMonth = User::where('user_type', 'user')
            ->where('created_at', '>=', $currentMonth)
            ->count();
        $vendorsThisMonth = User::where('user_type', 'vendor')
            ->where('created_at', '>=', $currentMonth)
            ->count();
        $discountsThisMonth = Discount::where('created_at', '>=', $currentMonth)->count();
        $discountRequestsThisMonth = DiscountCheck::where('created_at', '>=', $currentMonth)->count();

        // إحصائيات آخر 7 أيام (للرسم البياني)
        $last7Days = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $last7Days[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'users' => User::where('user_type', 'user')
                    ->whereDate('created_at', $date)
                    ->count(),
                'vendors' => User::where('user_type', 'vendor')
                    ->whereDate('created_at', $date)
                    ->count(),
                'discounts' => Discount::whereDate('created_at', $date)->count(),
                'requests' => DiscountCheck::whereDate('created_at', $date)->count(),
            ];
        }

        // إحصائيات آخر 30 يوم
        $last30Days = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $last30Days[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('M d'),
                'users' => User::where('user_type', 'user')
                    ->whereDate('created_at', $date)
                    ->count(),
                'vendors' => User::where('user_type', 'vendor')
                    ->whereDate('created_at', $date)
                    ->count(),
                'discounts' => Discount::whereDate('created_at', $date)->count(),
                'requests' => DiscountCheck::whereDate('created_at', $date)->count(),
            ];
        }

        // إحصائيات آخر 90 يوم (مجمعة أسبوعياً)
        $last90Days = [];
        for ($i = 12; $i >= 0; $i--) {
            $startDate = Carbon::now()->subWeeks($i)->startOfWeek();
            $endDate = Carbon::now()->subWeeks($i)->endOfWeek();
            $last90Days[] = [
                'date' => $startDate->format('Y-m-d'),
                'day' => $startDate->format('M d') . ' - ' . $endDate->format('M d'),
                'users' => User::where('user_type', 'user')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'vendors' => User::where('user_type', 'vendor')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->count(),
                'discounts' => Discount::whereBetween('created_at', [$startDate, $endDate])->count(),
                'requests' => DiscountCheck::whereBetween('created_at', [$startDate, $endDate])->count(),
            ];
        }

        // أفضل 5 تجار (بناءً على عدد الخصومات)
        $topVendors = Vendor::withCount('discounts')
            ->where('status', 'accepted')
            ->orderBy('discounts_count', 'desc')
            ->take(5)
            ->get();

        // أفضل 5 خصومات (بناءً على عدد المشاهدات)
        $topDiscounts = Discount::with('vendor')
            ->orderBy('viwe_count', 'desc')
            ->take(5)
            ->get();

        // أحدث العمليات
        $recentUsers = User::where('user_type', 'user')
            ->latest()
            ->take(5)
            ->get();
        $recentVendors = User::where('user_type', 'vendor')
            ->with('vendor')
            ->latest()
            ->take(5)
            ->get();
        $recentDiscounts = Discount::with('vendor')
            ->latest()
            ->take(5)
            ->get();
        $recentRequests = DiscountCheck::with(['user', 'discount.vendor'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.index', compact(
            // إحصائيات المستخدمين
            'users',
            'vendors',
            'activeUsers',
            'activeVendors',
            'pendingVendors',

            // إحصائيات التجار
            'acceptedVendors',
            'pendingVendorsStore',
            'rejectedVendors',

            // إحصائيات الخصومات
            'totalDiscounts',
            'activeDiscounts',
            'expiredDiscounts',
            'upcomingDiscounts',

            // إحصائيات طلبات الخصم
            'totalDiscountRequests',
            'pendingDiscountRequests',
            'acceptedDiscountRequests',
            'canceledDiscountRequests',

            // إحصائيات عامة
            'totalCategories',
            'totalCities',
            'totalAds',
            'totalBanners',
            'totalDiscountViews',
            'totalAdsViews',
            'totalAdsClicks',

            // إحصائيات هذا الشهر
            'usersThisMonth',
            'vendorsThisMonth',
            'discountsThisMonth',
            'discountRequestsThisMonth',

            // بيانات للرسوم البيانية والقوائم
            'last7Days',
            'last30Days',
            'last90Days',
            'topVendors',
            'topDiscounts',
            'recentUsers',
            'recentVendors',
            'recentDiscounts',
            'recentRequests'
        ));
    }
    public function profileMe()
    {
        return view('admin.profile');
    }

    public function profileMeSotre(UpdatePofileRequest $request)
    {
        $user = auth('web')->user();
        $image = $request->image ? $request->image : $user->image;
        $password = $request->password ? Hash::make($request->password) : $user->password;
        if ($request->image) {
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
            $image = Helpers::addImage($request->image, 'user');
        }
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => $password,
            'image'    => $image,
        ]);
        return redirect()->route('admin.profileMe');
    }
}
