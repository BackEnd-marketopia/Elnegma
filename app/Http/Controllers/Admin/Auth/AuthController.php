<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Admin\Auth\RegisterVendorRequest;
use App\Http\Requests\Provider\RegisterRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\EducationDepartment;
use App\Models\Provider;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\OtpService;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function loginStore(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->where('user_type', 'admin')
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => __('message.email_not_found')]);
        }
        if (!Hash::check($request->password, $user->password))
            return back()->withErrors(['password' => __('message.incorrect_password')]);
        if ($user->status != 'active')
            return back()->withErrors(['email' => __('message.You Are Blocked Now')]);
        auth('web')->login($user);

        return redirect()->route('admin.index');
    }
    public function logout()
    {
        auth('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
