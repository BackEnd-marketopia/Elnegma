<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    public function search(Request $request)
    {
        if ($request->type == 'vendor') {
            $user = auth('api')->user();
            $vendors = $user ? Vendor::where('status', 'accepted')
                ->whereJsonContains('citys_id', (string)$user->city_id)
                ->where(function($query) use ($request) {
                    $query->where('name_ar', 'like',  '%' . $request->search . '%')
                          ->orWhere('name_en', 'like',  '%' . $request->search . '%');
                })
                ->when($request->catId, function ($query) use ($request) {
                    return $query->where('category_id', $request->catId);
                })
                ->get(['id', 'name_ar', 'name_en', 'logo', 'description_ar', 'description_en']) :
                Vendor::where('status', 'accepted')
                ->where(function($query) use ($request) {
                    $query->where('name_ar', 'like',  '%' . $request->search . '%')
                          ->orWhere('name_en', 'like',  '%' . $request->search . '%');
                })
                ->when($request->catId, function ($query) use ($request) {
                    return $query->where('category_id', $request->catId);
                })
                ->orderByDesc('created_at')
                ->take(40)->get(['id', 'name_ar', 'name_en', 'logo', 'description_ar', 'description_en']);
            return Response::api(__('message.Success'), 200, true, null, ['vendors' => $vendors]);
        } elseif ($request->type == 'discount') {
            $discount = Discount::where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->where(function($query) use ($request) {
                    $query->where('title_en', 'like',  '%' . $request->search . '%')
                          ->orWhere('title_ar', 'like',  '%' . $request->search . '%')
                          ->orWhere('description_en', 'like',  '%' . $request->search . '%')
                          ->orWhere('description_ar', 'like',  '%' . $request->search . '%');
                })
                ->get();
            return Response::api(__('message.Success'), 200, true, null, ['discounts' => $discount]);
        }
    }

    public function vendorsByCategoryId($category_id)
    {
        $user = auth('api')->user();
        $vendors = $user ? Vendor::where('category_id', $category_id)
            ->where('status', 'accepted')
            ->whereJsonContains('citys_id', (string)$user->city_id)
            ->get(['id', 'name_ar', 'name_en', 'logo', 'description_ar', 'description_en']) :
            Vendor::where('category_id', $category_id)
            ->where('status', 'accepted')
            ->orderByDesc('created_at')
            ->take(40)->get(['id', 'name_ar', 'name_en', 'logo', 'description_ar', 'description_en']);

        return Response::api(__('message.Success'), 200, true, null, ['vendors' => $vendors]);
    }

    public function vendorDetails($id)
    {
        $vendor = Vendor::findOrFail($id);
        $discounts = $vendor->discounts()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get()
            ->makeHidden(['title_en', 'title_ar', 'description_en', 'description_ar'])
            ->makeVisible(['title', 'description']);
        return Response::api(__('message.Success'), 200, true, null, ['vendor' => $vendor, 'discounts' => $discounts]);
    }

    public function categories()
    {
        $categories = Category::select('id', app()->getLocale() == 'ar' ? 'name_arabic as name' : 'name_english as name', 'image')
            ->orderBy('sort_order', 'asc')
            ->get();
        return Response::api(__('message.Success'), 200, true, null, ['categories' => $categories]);
    }
    public function getDiscounts(Request $request)
    {
        $request->validate([
            'per_page' => 'nullable|integer',
        ]);

        $perPage = $request->per_page ?? 10;

        $user = auth('api')->user();

        if ($user->user_type != 'vendor')
            return Response::api(__('message.unauthorized'), 401, false, 401);

        $discounts = Discount::where('vendor_id', auth('api')->user()->vendor->id)
            ->withCount([
                'discountChecks as pending_checks_count' => function ($query) {
                    $query->where('status', 'pending');
                },
                'discountChecks as accepted_checks_count' => function ($query) {
                    $query->where('status', 'accepted');
                },
            ])
            ->get()
            ->makeHidden(['title_en', 'title_ar', 'description_en', 'description_ar'])
            ->makeVisible(['title', 'description']);

        $paginatedDiscounts = new \Illuminate\Pagination\LengthAwarePaginator(
            $discounts->forPage(1, $perPage),
            $discounts->count(),
            $perPage,
            1,
            ['path' => request()->url()]
        );

        return Response::api(__('message.Success'), 200, true, null, ['discounts' => $paginatedDiscounts]);
    }
}
