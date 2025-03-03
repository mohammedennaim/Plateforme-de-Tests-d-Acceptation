<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        
        // Si aucun rôle n'est spécifié, vérifie seulement admin
        if (empty($roles)) {
            if ($user->isAdmin()) {
                return $next($request);
            }
        } else {
            // Vérifie si l'utilisateur a l'un des rôles spécifiés
            foreach ($roles as $role) {
                $method = 'is' . ucfirst($role);
                if (method_exists($user, $method) && $user->$method()) {
                    return $next($request);
                }
            }
        }

        return redirect('/')->with('error', 'Accès non autorisé.');
    }
}