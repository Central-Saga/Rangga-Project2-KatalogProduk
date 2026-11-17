<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Membatasi area /admin hanya untuk user dengan flag is_admin = true.
 *
 * Registrasi publik selalu membuat user biasa (is_admin = false), sehingga
 * akun pelanggan tidak bisa membuka dashboard admin meskipun sudah login.
 */
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            abort(403, 'Anda tidak memiliki akses ke area admin.');
        }

        return $next($request);
    }
}
