<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \never
     */
    public function handle(Request $request, Closure $next)
    {
//        if ($request->user()->role === 'author' || $request->user()->role === 'editor') {
//            return abort(403,"User Does not allow to Enter!");
//        }
        if (!$request->user()->isAdmin()) {
//            return redirect()->back()->with(['status'=>403]);
            return abort(403,"User Does not allow to Enter!");
        }
        return $next($request);
    }
}
