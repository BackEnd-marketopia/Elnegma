<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Advertisement;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CodeController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
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
use App\Http\Controllers\Admin\UserDiscountController;
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
        Route::get('/users/{userId}/discounts', [UserController::class, 'userDiscounts'])->name('users.discounts');
        Route::get('/users/{userId}/discounts/search', [UserController::class, 'userDiscountsSearch'])->name('users.discounts.search');
        Route::get('/users/{userId}/discounts/export', [UserController::class, 'userDiscountsExport'])->name('users.discounts.export');
        Route::get('/users/{userId}/discounts/{discountCheckId}/edit', [UserController::class, 'userDiscountEdit'])->name('users.discounts.edit');
        Route::put('/users/{userId}/discounts/{discountCheckId}', [UserController::class, 'userDiscountUpdate'])->name('users.discounts.update');
        Route::delete('/users/{userId}/discounts/{discountCheckId}', [UserController::class, 'userDiscountDestroy'])->name('users.discounts.destroy');
        Route::group(['prefix' => 'discounts'], function () {
            Route::get('/{vendorId}', [AdminDiscountController::class, 'index'])->name('discounts.index');
            Route::get('/create/{vendorId}', [AdminDiscountController::class, 'create'])->name('discounts.create');
            Route::post('/store/{vendorId}', [AdminDiscountController::class, 'store'])->name('discounts.store');
            Route::get('/edit/{id}/{vendorId}', [AdminDiscountController::class, 'edit'])->name('discounts.edit');
            Route::put('/update/{id}/{vendorId}', [AdminDiscountController::class, 'update'])->name('discounts.update');
            Route::delete('/destroy/{id}/{vendorId}', [AdminDiscountController::class, 'destroy'])->name('discounts.destroy');
            Route::group(['prefix' => 'users'], function () {
                Route::get('/{discountId}', [UserDiscountController::class, 'index'])->name('discounts.users.index');
                Route::get('/create/{discountId}', [UserDiscountController::class, 'create'])->name('discounts.users.create');
                Route::post('/store/{discountId}', [UserDiscountController::class, 'store'])->name('discounts.users.store');
                Route::get('/edit/{id}/{discountId}', [UserDiscountController::class, 'edit'])->name('discounts.users.edit');
                Route::put('/update/{id}/{discountId}', [UserDiscountController::class, 'update'])->name('discounts.users.update');
                Route::delete('/destroy/{id}/{discountId}', [UserDiscountController::class, 'destroy'])->name('discounts.users.destroy');
                Route::get('/export/{discountId}', [UserDiscountController::class, 'exportExcel'])->name('discounts.users.export');
            });
        });
        Route::group(['prefix' => 'search'], function () {
            Route::get('/cities', [CityController::class, 'search'])->name('cities.search');
            Route::get('/categories', [CategoryController::class, 'search'])->name('categories.search');
            Route::get('/banners', [BannerController::class, 'search'])->name('banners.search');
            Route::get('/ads', [Advertisement::class, 'search'])->name('ads.search');
            Route::get('/admins', [AdminController::class, 'search'])->name('admins.search');
            Route::get('/users', [UserController::class, 'search'])->name('users.search');
            Route::get('/vendors', [VendorController::class, 'search'])->name('vendors.search');
            Route::get('/discounts/{vendorId}', [AdminDiscountController::class, 'search'])->name('discounts.search');
            Route::get('/discounts/users/{discountId}', [UserDiscountController::class, 'search'])->name('discounts.users.search');
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
