<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Translatable\Facades\Translatable;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'WMT-Site-Locale';
        $defaultLocale = config('app.fallback_locale');

        /**
         * requests hasHeader is used to check the Accept-Language header from the REST API's
         */
        if ($request->hasHeader($key)) {
            /**
             * If Accept-Language header found then set it to the default locale
             */
            App::setLocale($request->header($key));
        }
        Translatable::fallback(
            fallbackLocale: $request->hasHeader($key) ?? $defaultLocale,
        );
        return $next($request);
    }
}
