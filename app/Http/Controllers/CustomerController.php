<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class CustomerController extends BaseController
{

  // --------------------------------Controller Post Data------------------------
  public function index()
  {
    $data = DB::table('customer')->get();
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
    $data = DB::table('customer')->where('cust_id', $id)->first();
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
    $cust = [
      'cust_id' => $data['cust_id'],
      'cust_nama' => $data['cust_nama'],
      'cust_alamat' => $data['cust_alamat'],
      'cust_kelamin' => $data['cust_kelamin'],
      'cust_hp' => $data['cust_hp'],
      'cust_ktp' => $data['cust_ktp']
    ];
    try {
      DB::table('customer')->insert($cust);
      return [
        'succes' => true,
        'status' => 200,
        'message' => 'Insert Data Customer Sukses'
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
    $cust = [
      'cust_id' => $data['cust_id'],
      'cust_nama' => $data['cust_nama'],
      'cust_alamat' => $data['cust_alamat'],
      'cust_kelamin' => $data['cust_kelamin'],
      'cust_hp' => $data['cust_hp'],
      'cust_ktp' => $data['cust_ktp']
    ];
    try {
      DB::table('customer')
        ->where('cust_id', $id)
        ->update($cust);
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Update Data Customer Sukses'
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
      DB::table('customer')
        ->where('cust_id', $id)
        ->delete();
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Delete Data Customer Sukses'
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
