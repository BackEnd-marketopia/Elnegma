<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Discount\StoreDiscountRequest;
use App\Http\Requests\Admin\Discount\UpdateDiscountRequest;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use \App\Models\DiscountCheck;

class DiscountController extends Controller
{
    public function search(Request $request, int $vendorId)
    {
        $search = $request->input('search');

        $discounts = Discount::where('vendor_id', $vendorId)
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('start_date', 'LIKE', "%{$search}%")
                    ->orWhere('end_date', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        $discountIds = $discounts->pluck('id');
        $pendingCount = DiscountCheck::whereIn('discount_id', $discountIds)
            ->where('status', 'pending')->count();
        $acceptedCount = DiscountCheck::whereIn('discount_id', $discountIds)
            ->where('status', 'accepted')->count();

        return view('admin.discount.index', compact('discounts', 'vendorId', 'pendingCount', 'acceptedCount'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(int $vendorId)
    {
        $discounts = Discount::where('vendor_id', $vendorId)
            ->paginate(10);

        $discountIds = $discounts->pluck('id');

        return view('admin.discount.index', compact('discounts', 'vendorId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $vendorId)
    {
        return view('admin.discount.create', compact('vendorId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request, int $vendorId)
    {
        $image = Helpers::addImage($request->image, 'discount');
        Discount::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'vendor_id' => $vendorId,
        ]);

        return redirect()->route('admin.discounts.index', ['vendorId' => $vendorId])
            ->with('success', __('message.Discount created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, int $vendorId)
    {
        // $discount = Discount::findOrFail($id);
        // return view('admin.discount.show', compact('discount', 'vendorId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, int $vendorId)
    {
        $discount = Discount::findOrFail($id);
        return view('admin.discount.edit', compact('discount', 'vendorId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, string $id, int $vendorId)
    {
        $discount = Discount::findOrFail($id);
        $image = $request->image ? $request->image : $discount->image;
        if ($request->image) {
            if (File::exists($discount->image)) {
                File::delete($discount->image);
            }
            $image = Helpers::addImage($request->image, 'discount');
        }
        $discount->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.discounts.index', ['vendorId' => $vendorId])
            ->with('success', __('message.Discount updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, int $vendorId)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.discounts.index', ['vendorId' => $vendorId])
            ->with('success', __('message.Discount deleted successfully'));
    }
}
