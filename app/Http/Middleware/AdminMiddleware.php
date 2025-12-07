<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        $valid = [
//            'Modules\Beneficiary\App\Http\Controllers\Dashboard\BeneficiaryController@index',
//            'Modules\Beneficiary\App\Http\Controllers\Dashboard\BeneficiaryController@datatable',
//        ];

        if (auth()->check() && (auth()->user()->hasPermissionTo('access dashboard') || auth()->user()->can('access dashboard'))) {
            //prevent any route into production
//      if (app()->environment('production') && !in_array($request->route()->getActionName(), $valid)) {
//        return redirect()->route('dashboard.beneficiary.index');
//      } else {
            return $next($request);
//      }
        }

        return abort('403', 'User does not have the right permissions.');
    }
}
