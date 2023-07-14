<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Symfony\Component\HttpFoundation\Response;

class JsonMiddleware
{
    /**
     * The Response Factory our app uses
     *
     * @var ResponseFactory
     */
    protected $factory;

    /**
     * JsonMiddleware constructor.
     *
     * @param ResponseFactory $factory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // First, set the header so any other middleware knows we're
        // dealing with a should-be JSON response.
        if($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');

        }

        // Get the response
        return $response = $next($request);

//        // If the response is not strictly a JsonResponse, we make it
//        if (!$response instanceof JsonResponse) {
//            $response = $this->factory->json(
//                $response->content(),
//                $response->status(),
//                $response->headers->all()
//            );
//        }
//
//        return $response;
    }
}
