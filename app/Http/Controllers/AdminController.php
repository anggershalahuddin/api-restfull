<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class AdminController extends BaseController
{

  // --------------------------------Controller Post Data------------------------
  public function index()
  {
    $data = DB::table('admin')->get();
    return [
      'success' => true,
      'status' => 200,
      'message' => 'request data success',
      'data' => $data
    ];
  }

  // --------------------------------Controller Post Data By Id------------------------
  public function getByID($id)
  {
    $data = DB::table('admin')->where('admin_id', $id)->first();
    if ($data) {
      return response()->json($data);
    } else {
      return response()
        ->json([
          'success' => false,
          'status' => 404,
          'message' => 'Data not found'
        ], 404);
    }
  }

  // --------------------------------Controller Insert Data------------------------
  public function insert()
  {
    $data = request()->all();
    $admin = [
      'admin_id' => $data['admin_id'],
      'admin_nama' => $data['admin_nama'],
      'admin_username' => $data['admin_username'],
      'admin_password' => $data['admin_password'],
      'admin_hp' => $data['admin_hp'],
      'admin_alamat' => $data['admin_alamat']
    ];
    try {
      DB::table('admin')->insert($admin);
      return [
        'succes' => true,
        'status' => 200,
        'message' => 'Insert Data Admin Sukses'
      ];
    } catch (\Exception $ex) {
      $message = $ex->getMessage();
      return response()
        ->json([
          'succes' => false,
          'status' => 400,
          'message' => $message
        ], 400);
    }
  }

  // --------------------------------Controller Update Data------------------------
  public function update($id)
  {
    $data = request()->all();
    $admin = [
      'admin_id' => $data['admin_id'],
      'admin_nama' => $data['admin_nama'],
      'admin_username' => $data['admin_username'],
      'admin_password' => $data['admin_password'],
      'admin_hp' => $data['admin_hp'],
      'admin_alamat' => $data['admin_alamat']
    ];
    try {
      DB::table('admin')
        ->where('admin_id', $id)
        ->update($admin);
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Update Data Admin sukses'
      ];
    } catch (\Exception $ex) {
      $message = $ex->getMessage();
      return response()
        ->json([
          'success' => false,
          'status' => 400,
          'message' => $message
        ], 400);
    }
  }

  // --------------------------------Controller Delete Data------------------------
  public function delete($id)
  {
    try {
      DB::table('admin')
        ->where('admin_id', $id)
        ->delete();
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Delete Data Admin Sukses'
      ];
    } catch (\Exception $ex) {
      $message = $ex->getMessage();
      return response()
        ->json([
          'success' => false,
          'status' => 400,
          'message' => $message
        ], 400);
    }
  }
}
