<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiToken;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = $request->query('api_token');

            if(empty($token)){
                $token = $request->input('api_token');
            }
    
            if(empty($token)){
                $token = $request->bearerToken();
            }
            
            if(is_null($token)) {
                return response()->json(['error' => 'Not authorized.'], 403);
            }
            
            $token_select = ApiToken::select(ApiToken::ATTRIBUTE_TOKEN)
                ->where(ApiToken::ATTRIBUTE_TOKEN, $token)
                ->where(ApiToken::ATTRIBUTE_STATUS, true)
                ->first();
    
            if(is_null($token_select)) {
                return response()->json(['error' => 'Not authorized.'], 403);
            }
    
            if($token != $token_select->getToken()) {
                return response()->json(['error' => 'Not authorized.'], 403);
            }
    
            return $next($request);
        } catch (Exception  $e) {
            return response()->json(['error' => $e->getMessage()], 403);
        }
        
    }
}
