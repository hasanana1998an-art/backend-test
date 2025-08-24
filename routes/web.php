<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;


Route::get('/test-role', function() {
    $middleware = app(\App\Http\Middleware\RoleMiddleware::class);
    return get_class($middleware);
});


Route::get('/dev/run-migrate-clear', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return response()->json([
            'status' => true,
            'message' => 'Migration and cache cleared successfully.',
            'output' => [
                'migrate' => Artisan::output(),
                'config_clear' => '✔ config:clear done.',
                'cache_clear' => '✔ cache:clear done.',
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error occurred.',
            'error' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/dev/run-seed', function (Request $request) {

    try {
        $class = $request->get('class');

        if ($class) {
            \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => $class, '--force' => true]);
        } else {
            Artisan::call('db:seed', ['--force' => true]);
        }

        return response()->json([
            'status' => true,
            'message' => $class ? "Seeder '$class' executed successfully." : "All seeders executed successfully.",
            'output' => Artisan::output(),
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error occurred while seeding.',
            'error' => $e->getMessage(),
        ], 500);}
});
