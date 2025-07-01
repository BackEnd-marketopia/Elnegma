<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Notification\StoreNotificationRequest;
use App\Models\City;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::where('type', '!=', 'user')->paginate(10);

        return view('admin.notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.notification.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        $image = null;
        if ($request->image)
            $image =  Helpers::addImage($request->image, 'notification');

        Notification::create([
            'title' => $request->title,
            'body' => $request->body,
            'type' => 'topic',
            'to' => $request->to == 'users' ? 'users' : $request->city_id,
            'image' => $image ?? null,
        ]);

        Helpers::sendNotification(
            $request->title,
            $request->body,
            'topic',
            $request->to == 'users' ? 'users' : $request->city_id,
            false,
            null,
            $image ? env('APP_URL') . $image : null
        );
        return redirect()->route('admin.notifications.index')->with('success', __('message.Notification Added Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreNotificationRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        if (File::exists($notification->image)) {
            File::delete($notification->image);
        }
        $notification->delete();
        return redirect()->route('admin.notifications.index')->with('success', __('message.Notification Deleted Successfully'));
    }
}
