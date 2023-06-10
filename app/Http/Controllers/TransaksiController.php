<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class transaksiController extends BaseController
{

  // --------------------------------Controller Post Data------------------------
  public function index()
  {
    $data = DB::table('transaksi')->get();
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
    $data = DB::table('transaksi')->where('transaksi_id', $id)->first();
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
    $transaksi = [
      'transaksi_id' => $data['transaksi_id'],
      'admin_id' => $data['admin_id'],
      'cust_id' => $data['cust_id'],
      'mobil_id' => $data['mobil_id'],
      'transaksi_tgl_pinjam' => $data['transaksi_tgl_pinjam'],
      'transaksi_tgl_kembali' => $data['transaksi_tgl_kembali'],
      'transaksi_harga' => $data['transaksi_harga'],
      'transaksi_denda' => $data['transaksi_denda'],
      'transaksi_tgl' => $data['transaksi_tgl'],
      'transaksi_totaldenda' => $data['transaksi_totaldenda'],
      'transaksi_status' => $data['transaksi_status'],
      'transaksi_tgldikembalikan' => $data['transaksi_tgldikembalikan']
    ];
    try {
      DB::table('transaksi')->insert($transaksi);
      return [
        'succes' => true,
        'status' => 200,
        'message' => 'Insert Data transaksi Sukses'
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
    $transaksi = [
      'transaksi_id' => $data['transaksi_id'],
      'admin_id' => $data['admin_id'],
      'cust_id' => $data['cust_id'],
      'mobil_id' => $data['mobil_id'],
      'transaksi_tgl_pinjam' => $data['transaksi_tgl_pinjam'],
      'transaksi_tgl_kembali' => $data['transaksi_tgl_kembali'],
      'transaksi_harga' => $data['transaksi_harga'],
      'transaksi_denda' => $data['transaksi_denda'],
      'transaksi_tgl' => $data['transaksi_tgl'],
      'transaksi_totaldenda' => $data['transaksi_totaldenda'],
      'transaksi_status' => $data['transaksi_status'],
      'transaksi_tgldikembalikan' => $data['transaksi_tgldikembalikan']
    ];
    try {
      DB::table('transaksi')
        ->where('transaksi_id', $id)
        ->update($transaksi);
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Update Data transaksi Sukses'
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
      DB::table('transaksi')
        ->where('transaksi_id', $id)
        ->delete();
      return [
        'success' => true,
        'status' => 201,
        'message' => 'Delete Data Transaksi Sukses'
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
