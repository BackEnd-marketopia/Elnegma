<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckDiscountRequest;
use App\Http\Requests\Api\DiscountCheckRequest;
use App\Http\Requests\Api\PriceCheckDiscountRequest;
use App\Models\Discount;
use App\Models\DiscountCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class DiscountController extends Controller
{
    public function index($id)
    {
        $user = auth('api')->user();
        $discounts = Discount::with(['discountChecks'])->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->findOrFail($id);

        $discounts->viwe_count += 1;
        $discounts->save();

        if ($user) {
            $discount_check = DiscountCheck::where('user_id', $user->id)
                ->where('discount_id', $id)
                ->first();
            $discounts->is_checked = $discount_check ? true : false;
        } else
            $discounts->is_checked = false;


        return Response::api(__('message.Success'), 200, true, null, ['discounts' => $discounts]);
    }

    public function discountChecked($discountId)
    {
        Discount::findOrFail($discountId);

        $user = auth('api')->user();
        if (!$user)
            return Response::api(__('message.Login First'), 403, false, 403);

        // if (!$user->email_verified_at)
        //     return Response::api(__('message.You must be Verified'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        // $discount_check = DiscountCheck::where('user_id', auth('api')->user()->id)
        //     ->where('discount_id', $discountId)
        //     ->first();

        // if ($discount_check)
        //     return Response::api(__('message.Already Checked'), 403, false, 403);

        DiscountCheck::create([
            'user_id' => auth('api')->user()->id,
            'discount_id' => $discountId,
        ]);
        return Response::api(__('message.Success'), 200, true, null);
    }
    public function discountDetails(int $discountId)
    {
        $user = auth('api')->user();

        // if (!$user->email_verified_at)
        //     return Response::api(__('message.You must be Verified'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $discount_check = DiscountCheck::where('user_id', $user->id)
            ->where('discount_id', $discountId)
            ->latest()->first();

        if (!$discount_check)
            return Response::api(__('message.You have not received the discount yet'), 403, false, 403);


        return Response::api(__('message.Success'), 200, true, null, $discount_check);
    }
    public function userDiscounts()
    {
        $user = auth('api')->user();
        if (!$user)
            return Response::api(__('message.Login First'), 403, false, 403);

        // if (!$user->email_verified_at)
        //     return Response::api(__('message.You must be Verified'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $discountChecks = DiscountCheck::where('user_id', $user->id)
            ->whereHas('discount', function ($query) {
            $query->where('end_date', '>', now());
            })
            ->with('discount.vendor')
            ->get();
            
        return Response::api(__('message.Success'), 200, true, null, $discountChecks);
    }
    public function vendorDiscountDetails(int $id)
    {
        $user = auth('api')->user();
        if ($user->user_type != 'vendor')
            return Response::api(__('message.You are not a vendor'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $discountChecks = DiscountCheck::where('id', $id)
            ->with('discount.vendor')
            ->first();

        if (!$discountChecks)
            return Response::api(__('message.Discount not found'), 404, false, 404);


        return Response::api(__('message.Success'), 200, true, null, $discountChecks);
    }
    public function vendorAcceptDiscount(int $id)
    {
        $user = auth('api')->user();

        if ($user->user_type != 'vendor')
            return Response::api(__('message.You are not a vendor'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $discountCheck = DiscountCheck::findOrFail($id);

        if ($user->vendor->id != $discountCheck->discount->vendor_id)
            return Response::api(__('message.unauthorized'), 403, false, 403);

        $discountCheck->update(['status' => 'accepted']);
        if ($discountCheck->user->fcm_token) {
            Helpers::sendNotification(
                'Negma',
                'تم قبول الخصم من قبل التاجر',
                'token',
                $discountCheck->user->fcm_token,
                false,
                $discountCheck->user_id,
                null,
                ["refresh" => '1']
            );
        }
        return Response::api(__('message.Success'), 200, true, null);
    }
    public function vendorAddPriceToDiscountCheck(PriceCheckDiscountRequest $request, int $id)
    {
        $user = auth('api')->user();

        if ($user->user_type != 'vendor')
            return Response::api(__('message.You are not a vendor'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $discountCheck = DiscountCheck::findOrFail($id);

        if ($user->vendor->id != $discountCheck->discount->vendor_id)
            return Response::api(__('message.unauthorized'), 403, false, 403);

        if ($discountCheck->status != 'accepted')
            return Response::api(__('message.Discount not Accepted up till now'), 403, false, 403);

        $discountCheck->update([
            'price' => $request->price,
            'discount_value' => $request->discount_value,
        ]);
        if ($discountCheck->user->fcm_token) {
            Helpers::sendNotification(
                'Negma',
                'تم اضافه السعر من قبل التاجر',
                'token',
                $discountCheck->user->fcm_token,
                false,
                $discountCheck->user_id,
                null,
                ["refresh" => '1']
            );
        }
        return Response::api(__('message.Success'), 200, true, null);
    }

    
    public function userAcceptDiscountCheck(DiscountCheckRequest $request, int $id)
    {
        $user = auth('api')->user();

        if ($user->user_type != 'user')
            return Response::api(__('message.You are not a user'), 400, false, 400);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 400, false, 400);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 400, false, 400);

        $discountCheck = DiscountCheck::findOrFail($id);

        if ($discountCheck->user_id != $user->id)
            return Response::api(__('message.unauthorized'), 403, false, 403);

        if ($discountCheck->status == 'pending' || !$discountCheck->price)
            return Response::api(__('message.Wait Until Vendor Accept Discount'), 400, false, 400);

        $discountCheck->update([
            'final_price' => $request->final_price ?? $discountCheck->price,
            'comment' => $request->comment ?? null,
            'status' => $request->status ?? 'accepted',
        ]);
        if ($discountCheck->discount->vendor->user->fcm_token) {
            if ($request->final_price && !$request->status) {
                Helpers::sendNotification(
                    'Negma',
                    'تم تعديل السعر من قبل المستخدم',
                    'token',
                    $discountCheck->discount->vendor->user->fcm_token,
                    false,
                    $discountCheck->user_id,
                    null,
                    ["refresh" => '1']
                );
            } elseif ($request->status)
                Helpers::sendNotification(
                    'Negma',
                    'تم رفض الخصم من قبل المستخدم',
                    'token',
                    $discountCheck->discount->vendor->user->fcm_token,
                    false,
                    $discountCheck->discount->vendor_id,
                    null,
                    ["refresh" => '1']
                );
            else {
                Helpers::sendNotification(
                    'Negma',
                    'تم قبول الخصم من قبل المستخدم',
                    'token',
                    $discountCheck->discount->vendor->user->fcm_token,
                    false,
                    $discountCheck->discount->vendor_id,
                    null,
                    ["refresh" => '1']
                );
            }
        }
        return Response::api(__('message.Success'), 200, true, null);
    }

    public function checkActiveUserDiscount()
    {
        $user = auth('api')->user();

        if (!$user)
            return Response::api(__('message.Login First'), 403, false, 403);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 403, false, 403);
        elseif ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 403, false, 403);

        $activeDiscountCheck = DiscountCheck::where('user_id', $user->id)
            ->whereHas('discount', function ($query) {
                $query->where('start_date', '<=', now())
                      ->where('end_date', '>=', now());
            })
            ->where(function ($query) {
                $query->where('status', 'pending')
                      ->orWhere(function ($subQuery) {
                          $subQuery->where('status', 'accepted')
                                   ->whereNull('price');
                      })
                      ->orWhere(function ($subQuery) {
                          $subQuery->where('status', 'accepted')
                                   ->whereNotNull('price')
                                   ->whereNull('final_price')
                                   ->whereNull('comment');
                      });
            })
            ->with(['discount.vendor'])
            ->latest()
            ->first();

        if (!$activeDiscountCheck) {
            return Response::api(__('message.No active discount found'), 200, true, null, [
                'has_active_discount' => false,
                'discount_data' => null
            ]);
        }

        return Response::api(__('message.Success'), 200, true, null, [
            'has_active_discount' => true,
            'discount_data' => $activeDiscountCheck
        ]);
    }
}
