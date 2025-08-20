<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\City;
use App\Models\Code;
use App\Models\User;
use App\Models\DiscountCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserDiscountsExport;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('user_type', 'user')
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhere('status', 'LIKE', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.user.index', compact('users'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('user_type', 'user')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.user.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $image = $request->image ? Helpers::addImage($request->image, 'user') : null;
        User::create([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'image' => $image,
            'user_type' => 'user',
            'status' => 'active',
            'city_id' => $request->city_id,
            'card_image' => Helpers::addImage($request->card_image, 'card'),
        ]);

        return redirect()->route('admin.users.index')->with('success', __('message.User Added Successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = user::findOrFail($id);
        $cities = City::all();
        return view('admin.user.edit', compact('user', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $image = $request->image ? Helpers::addImage($request->image, 'user') : $user->image;
        $cardImage = $request->card_image ? Helpers::addImage($request->card_image, 'card') : $user->card_image;

        if ($request->image && File::exists($user->image))
            File::delete($user->image);

        if ($request->card_image && File::exists($user->card_image))
            File::delete($user->card_image);

        $user->update([
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'image' => $image,
            'user_type' => 'user',
            'status' => $request->status,
            'city_id' => $request->city_id,
            'card_image' => $cardImage,
        ]);

        return redirect()->route('admin.users.index')->with('success', __('message.User Edit Successfully'));
    }

        /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', __('message.User Deleted Successfully'));
    }

    /**
     * Display user discounts.
     */
    public function userDiscounts(string $userId)
    {
        $user = User::findOrFail($userId);
        $discountChecks = DiscountCheck::with(['discount.vendor.user', 'discount'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user.discounts', compact('user', 'discountChecks'));
    }

    /**
     * Search user discounts.
     */
    public function userDiscountsSearch(Request $request, string $userId)
    {
        $user = User::findOrFail($userId);
        $search = $request->input('search');

        $discountChecks = DiscountCheck::with(['discount.vendor.user', 'discount'])
            ->where('user_id', $userId)
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('comment', 'LIKE', "%{$search}%")
                      ->orWhere('price', 'LIKE', "%{$search}%")
                      ->orWhere('final_price', 'LIKE', "%{$search}%")
                      ->orWhere('discount_value', 'LIKE', "%{$search}%")
                      ->orWhere('status', 'LIKE', "%{$search}%")
                      ->orWhereHas('discount', function ($dq) use ($search) {
                          $dq->where('title', 'LIKE', "%{$search}%")
                             ->orWhere('description', 'LIKE', "%{$search}%");
                      })
                      ->orWhereHas('discount.vendor', function ($vq) use ($search) {
                          $vq->where('name_ar', 'LIKE', "%{$search}%")
                             ->orWhere('name_en', 'LIKE', "%{$search}%");
                      });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user.discounts', compact('user', 'discountChecks'));
    }

    /**
     * Export user discounts to Excel.
     */
    public function userDiscountsExport(string $userId)
    {
        $user = User::findOrFail($userId);
        $fileName = 'user-' . $user->id . '-discounts-' . date('Y-m-d') . '.xlsx';
        
        return Excel::download(new UserDiscountsExport($userId), $fileName);
    }

    /**
     * Show the form for editing a user discount.
     */
    public function userDiscountEdit(string $userId, string $discountCheckId)
    {
        $user = User::findOrFail($userId);
        $discountCheck = DiscountCheck::with(['discount.vendor', 'discount'])
            ->where('user_id', $userId)
            ->findOrFail($discountCheckId);

        return view('admin.user.discount-edit', compact('user', 'discountCheck'));
    }

    /**
     * Update a user discount.
     */
    public function userDiscountUpdate(Request $request, string $userId, string $discountCheckId)
    {
        $user = User::findOrFail($userId);
        $discountCheck = DiscountCheck::where('user_id', $userId)->findOrFail($discountCheckId);

        $request->validate([
            'comment' => 'nullable|string|max:500',
            'price' => 'nullable|numeric|min:0',
            'final_price' => 'nullable|numeric|min:0',
            'discount_value' => 'nullable|numeric|min:0',
            'status' => 'required|in:pending,accepted,cancelled',
        ]);

        $discountCheck->update([
            'comment' => $request->comment,
            'price' => $request->price,
            'final_price' => $request->final_price,
            'discount_value' => $request->discount_value,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.discounts', $userId)
            ->with('success', __('message.User Discount Updated Successfully'));
    }

    /**
     * Delete a user discount.
     */
    public function userDiscountDestroy(string $userId, string $discountCheckId)
    {
        $user = User::findOrFail($userId);
        $discountCheck = DiscountCheck::where('user_id', $userId)->findOrFail($discountCheckId);
        
        $discountCheck->delete();

        return redirect()->route('admin.users.discounts', $userId)
            ->with('success', __('message.User Discount Deleted Successfully'));
    }
}
