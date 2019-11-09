<?php
// Place this file on the Providers folder of your project
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('success', function ($message = '', $data = null) use ($factory) {
            $format = [
                'code' => 200,
                'message' => $message,
                'contents' => $data,
            ];

            return $factory->make($format);
        });

        $factory->macro('error', function (string $message = '', $errors = []) use ($factory){
            $format = [
                'code' => 422, 
                'message' => $message,
                'contents' => $errors,
            ];

            return $factory->make($format);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}