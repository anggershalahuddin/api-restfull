<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class AccountController extends BaseController
{
  public function loggin()
  {
    $email = request()->get('email');
    $password = request()->get('password');

    $user = DB::table('admin')->where('admin_username', $email)
      ->whereRaw('admin_password = sha1(?)', $password)
      ->first();

    if ($user) {
      $token = $this->createToken($email);
      return response()
        ->json([
          'succes' => true,
          'status' => 200,
          'message' => 'Login Berhasil',
          'acces_token' => $token
        ]);
    } else {
      return response()
        ->json([
          'succes' => false,
          'status' => 401,
          'message' => 'Username email atau password salah'
        ], 401);
    }
  }
  private function createToken($email)
  {
    $appKey = env('JWT_KEY');
    $iat = time();
    $payload = [
      'iss' => 'http://localhost:8000',
      'aud' => 'http://localhost:8000',
      'iat' => $iat,
      'exp' => $iat + (60 * 60),
      'email' => $email
    ];
    $token = JWT::encode($payload, $appKey, 'HS256');
    return $token;
  }
}
