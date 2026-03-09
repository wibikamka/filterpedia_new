<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class RedirectIfMobile
{
    public function handle(Request $request, Closure $next)
    {
        // Skip untuk AJAX requests
        if ($request->expectsJson()) {
            return $next($request);
        }
        
        $agent = new Agent();
        
        // CEK: Jika ini DESKTOP yang mencoba akses route MOBILE
        if (!$agent->isMobile()) {
            return redirect()->route('account.index')
                ->with('warning', 'Halaman ini khusus untuk mobile. Gunakan halaman Account di desktop.');
        }
        
        // Jika MOBILE, lanjutkan (boleh akses)
        return $next($request);
    }
}