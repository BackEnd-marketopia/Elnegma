<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth('api')->user();

        $wishlists = $user->wishlists()->with('vendor')->get()->pluck('vendor');

        return Response::api(__('message.Success'), 200, true, null, $wishlists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishlistRequest $request)
    {
        $user = auth('api')->user();
        $wishlists = Wishlist::where('user_id', $user->id)->where('vendor_id', $request->vendor_id)
            ->get();
        if ($wishlists->isNotEmpty())
            return Response::api(__('message.This Vendor Already in Wish List'), 400, false, 400);

        $wishlist = $user->wishlists()->create([
            'vendor_id' => $request->vendor_id,
        ]);

        return Response::api(__('message.Wishlist created successfully'), 200, true, null, $wishlist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Wishlist::where('vendor_id', $id)
            ->where('user_id', auth('api')->id())->delete();
        return Response::api(__('message.Wishlist Deleted successfully'), 200, true, null);
    }
}
