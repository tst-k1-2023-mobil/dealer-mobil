<?php
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Pemesanan;
use CodeIgniter\HTTP\Response;
class PemesananAPI extends ResourceController{
    public function index(){
        $model = 1;
        return model;
    }
    public function insert($idAkun,$mobilId,$tangggalPesan,$tanggalKirim,$jumlahMobil,$totalHarga){
        $model = model(Pemesanan::class);
        $response = service('response');
        $data = $model->insertPesanan($idAkun,$mobilId,$tangggalPesan,$tanggalKirim,$jumlahMobil,$totalHarga);
        if ($data) {
            return $response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Data inserted successfully', 'data' => $data]);
        } else {
            return $response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Failed to insert data']);
        }
    }
}