<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;


// تسجيل مستخدم جديد وتسجيل دخول (عام)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// عرض المنتجات والتصنيفات للجميع (بدون تسجيل دخول)
Route::get('/products/search', [ProductController::class, 'search']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

// مصادقة لجميع المسارات المحمية
Route::middleware('auth:sanctum')->group(function () {

    // تسجيل الخروج وجلب بيانات المستخدم
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // مسارات المشرف فقط
    Route::middleware('role:admin')->group(function () {
        Route::get('/users', [AuthController::class, 'allUsers']);
        Route::put('/users/{id}', [AuthController::class, 'updateUser']);
        Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);

        Route::post('/categories', [CategoryController::class, 'store']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        Route::get('/all-orders', [OrderController::class, 'getAllOrders']);
    });

    // مسارات البائع والمشرف
    Route::middleware('role:admin,seller')->group(function () {
        // إضافة / تعديل / حذف منتجات
        Route::post('/products', [ProductController::class, 'store']);
        Route::put('/products/{id}', [ProductController::class, 'update']);
        Route::delete('/products/{id}', [ProductController::class, 'destroy']);

        // منتجات البائع الحالي
        Route::get('/seller/products', [ProductController::class, 'getSellerProducts']);
        // طلبات البائع
        Route::get('/seller/orders', [OrderController::class, 'getSellerOrders']);
    });

    // مسارات المشتري فقط
    Route::middleware('role:buyer')->group(function () {
        Route::get('/cart', [CartController::class, 'index']);
        Route::post('/cart', [CartController::class, 'store']);
        Route::delete('/cart/clear', [CartController::class, 'clear']);
        Route::put('/cart/{id}', [CartController::class, 'update']);
        Route::delete('/cart/{id}', [CartController::class, 'destroy']);

        Route::get('/orders', [OrderController::class, 'index']);
        Route::post('/orders', [OrderController::class, 'store']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);

        Route::post('/payments', [PaymentController::class, 'store']);
        Route::get('/payments/{id}', [PaymentController::class, 'show']);

        Route::post('/products/{id}/reviews', [ReviewController::class, 'store']);
        Route::get('/products/{id}/reviews', [ReviewController::class, 'index']);

        // محاكاة الدفع (بدون بوابة حقيقية)
        Route::post('/simulate-payment', [PaymentController::class, 'simulatePayment']);

    });

    // إشعارات ودردشة لجميع المستخدمين
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);

    Route::get('/chats', [ChatController::class, 'index']);
    Route::get('/chats/{chat_id}', [ChatController::class, 'show']);
    Route::post('/chats/{chat_id}/messages', [ChatController::class, 'storeMessage']);
});
