<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscountChekRequest;
use App\Models\DiscountCheck;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\DiscountChecksExport;
use Maatwebsite\Excel\Facades\Excel;

class UserDiscountController extends Controller
{
    public function search(Request $request, int $discountId)
    {
        $search = $request->input('search');

        $users = User::whereRelation('discountChecks', 'discount_id', $discountId)
            ->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            })->paginate(10);

        return view('admin.discount.user-discount.index', compact('users', 'discountId'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $discountId)
    {
        $users = User::whereRelation('discountChecks', 'discount_id', $discountId)
            ->paginate(10);

        return view('admin.discount.user-discount.index', compact('users', 'discountId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $discountId)
    {
        $users = User::all();
        return view('admin.discount.user-discount.create', compact('discountId', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiscountChekRequest $request, int $discountId)
    {
        DiscountCheck::create([
            'user_id' => $request->user_id,
            'discount_id' => $discountId,
            'comment' => $request->comment,
            'price' => $request->price,
            'status' => $request->status,
            'final_price' => $request->final_price,
        ]);

        return redirect()->route('admin.discounts.users.index', ['discountId' => $discountId])
            ->with('success', __('message.User discount created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, int $discountId)
    {
        $discountCheck = DiscountCheck::with(['user', 'discount'])->findOrFail($id);
        return view('admin.discount.user-discount.show', compact('discountCheck', 'discountId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, int $discountId)
    {
        $discountCheck = DiscountCheck::findOrFail($id);
        $users = User::all();
        $vendorId = $discountCheck->discount->vendor_id;

        return view('admin.discount.user-discount.edit', compact('discountCheck', 'discountId', 'users', 'vendorId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiscountChekRequest $request, int $id, int $discountId)
    {
        $discountCheck = DiscountCheck::findOrFail($id);

        $discountCheck->update([
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'price' => $request->price,
            'status' => $request->status,
            'final_price' => $request->final_price,
        ]);

        return redirect()->route('admin.discounts.users.index', ['discountId' => $discountId])
            ->with('success', __('message.User discount updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, int $discountId)
    {
        $discountCheck = DiscountCheck::findOrFail($id);
        $discountCheck->delete();

        return redirect()->route('admin.discounts.users.index', ['discountId' => $discountId])
            ->with('success', __('message.User discount deleted successfully.'));
    }

    public function exportExcel(int $discountId)
    {
        return Excel::download(new DiscountChecksExport(), 'user_discounts.xlsx');
    }
}
