<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// استدعاء النماذج والسياسات
use App\Models\Product;
use App\Policies\ProductPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * خريطة السياسات لتطبيقك.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        // أضف سياسات أخرى هنا عند الحاجة
    ];

    /**
     * تسجيل أي خدمات مصادقة / تفويض.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // لا حاجة لتعريف بوابات إضافية هنا إذا كنت تستخدم السياسات (Policies)
    }
}
