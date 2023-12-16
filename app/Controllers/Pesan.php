<?php

namespace App\Controllers;
use App\Models\Pemesanan;
use CodeIgniter\HTTP\Response;


class Pesan extends BaseController
{   

    public function index(): string
    {
        return view('pemesanan');
    }

    public function formPemesanan($id): string
    {
        $curl = curl_init(getenv('api.pabrik.key'). 'api/mobil/' . $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '. getenv('api.key')
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = [
            'mobil' => json_decode($response,true)
        ];
        return view('pesan',$data);
    }

    public function pesan(): \CodeIgniter\HTTP\RedirectResponse  {
        $pemesanan = new PemesananAPI();
        $request = service('request');
        $idAkun = $request->getPost('idAkun');
        $mobilId = $request->getPost('id');
        $jumlahMobil = $request->getPost('jumlahPesanan');
        $harga = $request->getPost('harga');
        $waktuProduksi =  $request->getPost('waktuProduksi');
        $penambahanWaktu ='+'. $waktuProduksi .' day';
        $totalHarga = $harga * $jumlahMobil;
        $tangggalPesan = date('Y-m-d');
        $tanggalKirim = $tangggalPesan;  
        
        $this->insert($idAkun,$mobilId,$tangggalPesan,$tanggalKirim,$jumlahMobil,$totalHarga) ;
        return  redirect()->to('/listmobil'); 
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