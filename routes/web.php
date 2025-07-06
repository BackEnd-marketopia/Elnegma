<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Advertisement;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\FeedController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PlayerFormController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Provider\AttachmentController;
use App\Http\Controllers\Provider\ClassRoomController;
use App\Http\Controllers\Provider\HomeController as ProviderHomeController;
use App\Http\Controllers\Provider\LessonController;
use App\Http\Controllers\Provider\UnitController;
use App\Http\Controllers\Vendor\DiscountController;
use App\Http\Controllers\Vendor\HomeController as VendorHomeController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ChangePhone;
use App\Http\Controllers\Vendor\UserController as VendorUserController;
use Illuminate\Support\Facades\Route;

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar']))
        session()->put('locale', $locale);
    return redirect()->back();
})->name('setLocale');

Route::group(['middleware' => 'WebLang'], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'checkAdmin'], function () {

        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [HomeController::class, 'profileMe'])->name('profileMe');
            Route::post('/update', [HomeController::class, 'profileMeSotre'])->name('profileMeSotre');
        });
        Route::resources([
            'cities'        => CityController::class,
            'banners'       => BannerController::class,
            'categories'    => CategoryController::class,
            'users'         => UserController::class,
            'vendors'       => VendorController::class,
            'admins'        => AdminController::class,
            'ads'           => Advertisement::class,
            'notifications' => NotificationController::class,
        ]);
        Route::group(['prefix' => 'search'], function () {
            Route::get('/cities', [CityController::class, 'search'])->name('cities.search');
            Route::get('/categories', [CategoryController::class, 'search'])->name('categories.search');
            Route::get('/banners', [BannerController::class, 'search'])->name('banners.search');
            Route::get('/ads', [Advertisement::class, 'search'])->name('ads.search');
            Route::get('/admins', [AdminController::class, 'search'])->name('admins.search');
            Route::get('/users', [UserController::class, 'search'])->name('users.search');
            Route::get('/vendors', [VendorController::class, 'search'])->name('vendors.search');
        });

        Route::group(['prefix' => 'config'], function () {
            Route::get('/', [ConfigController::class, 'config'])->name('config');
            Route::put('/update/{id}', [ConfigController::class, 'configStore'])->name('configStore');
        });
        Route::group(['prefix' => 'payments'], function () {
            Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        });
    });
 
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginStore'])->name('loginStore');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
