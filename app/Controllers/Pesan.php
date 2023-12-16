<?php

namespace App\Controllers;
use  App\Controllers\PemesananAPI;


class Pesan extends BaseController
{
    public function index(): string
    {
        return view('pemesanan');
    }

    public function formPemesanan($id): string
    {
        $curl = curl_init('http://localhost:8081//api/mobil/' . $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
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
        
        $pemesanan->insert($idAkun,$mobilId,$tangggalPesan,$tanggalKirim,$jumlahMobil,$totalHarga) ;
        return  redirect()->to('/listmobil'); 
    }
}