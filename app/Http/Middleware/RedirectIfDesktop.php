<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class RedirectIfDesktop
{
    public function handle(Request $request, Closure $next)
    {
        // Skip untuk AJAX requests
        if ($request->expectsJson()) {
            return $next($request);
        }
        
        $agent = new Agent();
        
        // CEK: Jika ini MOBILE yang mencoba akses route DESKTOP
        if ($agent->isMobile()) {
            return redirect()->route('profile.index')
                ->with('info', 'Halaman ini khusus untuk desktop. Gunakan menu Profile di mobile.');
        }
        
        // Jika DESKTOP, lanjutkan (boleh akses)
        return $next($request);
    }
}