<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataTableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderDirection = request('order.0.dir');
        $columnName = request('columns.' . request("order.0.column") . '.data');

        if ($columnName && $orderDirection) {
            $orderBy = $columnName;
            $orderAs = $orderDirection;
        }

        $page = (request('start', 0) / request('length', 10)) + 1;

        request()->merge([
            'page'    => $page ?? 1,
            'orderBy' => $orderBy ?? 'id',
            'orderAs' => $orderAs ?? 'desc',
            'perPage' => request('length', 10),
            'search'  => request('search.value', ''),
        ]);

        return $next($request);
    }
}
