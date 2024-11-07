<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Enums\ReasonCodeValues; // Assuming ReasonCodeValues is defined somewhere

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Boot the response macros.
     *
     * @return void
     */
    public function boot()
    {
        // Success response macro
        Response::macro('success', function ($data) {
            $json = [
                'success' => true,
                'data'    => $data
            ];
            return Response::json($json);
        });

        // Error response macro
        Response::macro('error', function ($message, $reasonCode = ReasonCodeValues::BAD_REQUEST, $data = []) {
            return Response::json([
                'success'  => false,
                'rc'       => $reasonCode,
                'message'  => $message,
                'data'     => $data
            ]);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // You can register services here if needed
    }
}
