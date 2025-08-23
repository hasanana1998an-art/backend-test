<?php

use Illuminate\Support\Facades\Route;

Route::get('/test-role', function() {
    $middleware = app(\App\Http\Middleware\RoleMiddleware::class);
    return get_class($middleware);
});
