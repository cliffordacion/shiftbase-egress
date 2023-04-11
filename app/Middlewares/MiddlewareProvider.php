<?php

namespace App\Middlewares;

class MiddlewareProvider
{
    protected $globalMiddlewares = [];
    
    public function __construct()
    {
        $this->globalMiddlewares = config('middlewares.global'); // fetch Middleware configuration from a config file
    }

    public function attachRequestMiddlewares(App\Models\Request $request): App\Models\Request
    {
        foreach ($this->globalMiddlewares as $middleware) {
            // attach global middlewares
        }

        foreach ($request->middlewares as $middleware) {
            // attach endpoint specific middleware
        }
    }

    public function attachResponseMiddlewares(App\Models\Response $response): App\Models\Response
    {
        foreach ($this->globalMiddlewares as $middleware) {
            // attach global middlewares
        }

        foreach ($response->middlewares as $middleware) {
            // attach endpoint specific middleware
        }
    }
}