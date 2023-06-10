<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class MobilController extends BaseController
{

  // --------------------------------Controller Post Data------------------------
  public function index()
  {
    $data = DB::table('mobil')->get();
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
    $data = DB::table('mobil')->where('mobil_id', $id)->first();
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
    $mobil = [
      'mobil_id' => $data['mobil_id'],
      'mobil_merk' => $data['mobil_merk'],
      'mobil_nopol' => $data['mobil_nopol'],
      'mobil_warna' => $data['mobil_warna'],
      'mobil_tahun' => $data['mobil_tahun'],
      'mobil_status' => $data['mobil_status']
    ];
    try {
      DB::table('mobil')->insert($mobil);
      return [
        'succes' => true,
        'status' => 200,
        'message' => 'Insert Data Mobil Sukses'
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
    $mobil = [
      'mobil_id' => $data['mobil_id'],
      'mobil_merk' => $data['mobil_merk'],
      'mobil_nopol' => $data['mobil_nopol'],
      'mobil_warna' => $data['mobil_warna'],
      'mobil_tahun' => $data['mobil_tahun'],
      'mobil_status' => $data['mobil_status']
    ];
    try {
      DB::table('mobil')
        ->where('mobil_id', $id)
        ->update($mobil);
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Update Data Mobil Sukses'
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
      DB::table('mobil')
        ->where('mobil_id', $id)
        ->delete();
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Delete Data Mobil Sukses'
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
