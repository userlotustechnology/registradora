<?php

namespace App\Http\Middleware;

use App\Models\Partner;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatePartnerApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Token de autenticação não fornecido.',
                'error' => 'Unauthorized'
            ], 401);
        }

        $partner = Partner::where('api_token', $token)
            ->where('is_active', true)
            ->first();

        if (!$partner) {
            return response()->json([
                'message' => 'Token inválido ou parceiro inativo.',
                'error' => 'Unauthorized'
            ], 401);
        }

        // Adiciona o parceiro autenticado ao request
        $request->merge(['authenticated_partner' => $partner]);
        $request->setUserResolver(function () use ($partner) {
            return $partner;
        });

        return $next($request);
    }
}
