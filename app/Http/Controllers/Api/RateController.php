<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RateController extends Controller
{
    public function store(RateRequest $request)
    {
        $user = auth('api')->user();

        if ($user->user_type != 'user')
            return Response::api(__('message.You are not a user'), 400, false, 400);

        if ($user->status == 'inactive')
            return Response::api(__('message.You Are blocked Now'), 400, false, 400);

        if ($user->status == 'pending')
            return Response::api(__('message.You Are Pending Now, Wait Until Admin Accept You'), 400, false, 400);

        $rate = $user->rates()->create([
            'vendor_id' => $request->vendor_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
        ]);

        return Response::api(__('message.Success'), 200, true, null, $rate);
    }
}
