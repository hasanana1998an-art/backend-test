<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        // يمكنك تسجيل خدمات مخصصة هنا إذا احتجت لاحقًا
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // لتفادي مشاكل الطول في المفاتيح الأجنبية (خاصة في MySQL 5.6 أو أقل)
        Schema::defaultStringLength(191);

        // يمكنك إضافة إعدادات عامة هنا مثل مشاركة متغيرات مع جميع الواجهات
    }
}
