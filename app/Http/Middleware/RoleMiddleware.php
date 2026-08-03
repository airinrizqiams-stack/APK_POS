<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request):
     *(\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    : Response
    {
        // Cek user jika belum login
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['Silakan login terlebih dahulu.']);
        }

<<<<<<< HEAD
        $userRole = $request->user()->role?->name;
=======
        $userRole = $request->user()->role;
>>>>>>> 7fe10870449df8d307f7f7f883236694e2066e3d

        // Jika role user tidak sesuai ruote yang diminta
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
