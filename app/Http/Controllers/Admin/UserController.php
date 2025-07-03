<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\City;
use App\Models\Code;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

        if (File::exists($user->image))
            File::delete($user->image);

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', __('message.User Deleted Successfully'));
    }
}
