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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek user jika belum login
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['Silakan login terlebih dahulu.']);
        }

        // Ambil string nama role dari user yang sedang login
        // Menyesuaikan apakah relasi di model User berupa text langsung atau object relasi
        $userRole = is_object($request->user()->role) ? $request->user()->role->name : $request->user()->role;

        // Jika role user tidak sesuai dengan route yang diminta
        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}
