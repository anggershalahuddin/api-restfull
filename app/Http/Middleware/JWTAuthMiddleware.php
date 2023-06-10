<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuthMiddleware
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
    if ($request->is('api/v1/account/loggin')) {
      return $next($request);
    }

    $token = $request->bearerToken();
    if (isset($token)) {
      $key = env('JWT_KEY', 'KeyTOkenS3cret');
      try {
        $decode = JWT::decode($token, new Key($key, 'HS256'));
      } catch (\Exception $ex) {
        return response()
          ->json([
            'status' => 401,
            'succes' => false,
            'message' => $ex->getMessage()
          ], 401);
      }
    } else {
      return response()
        ->json([
          'status' => 401,
          'succes' => false,
          'message' => 'Token Not Found'
        ], 401);
    }

    return $next($request);
  }
}
