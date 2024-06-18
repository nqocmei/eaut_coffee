<?php

namespace App\Http\Middleware;

use Closure;
use Fruitcake\Cors\CorsService;
use Fruitcake\Cors\CorsServiceProvider;

class CorsMiddleware
{
    protected $cors;

    public function __construct()
    {
        $this->cors = new CorsService([
            'allowedOrigins' => ['*'],
            'allowedHeaders' => ['*'],
            'allowedMethods' => ['*'],
            'exposedHeaders' => false,
            'maxAge' => false,
            'supportsCredentials' => false,
        ]);
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        return $this->cors->addActualRequestHeaders($response, $request);
    }
}
