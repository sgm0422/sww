<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecordPageVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && $response->getStatusCode() < 400) {
            PageVisit::create([
                'path' => $request->getPathInfo(),
                'ip_address' => $request->ip(),
                'visited_at' => now(),
            ]);
        }

        return $response;
    }
}
