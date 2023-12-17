<?php

namespace App\Controllers;

use App\Models\Pemesanan;
use App\Models\UserModel;
use App\Models\Loyalitas;

use CodeIgniter\HTTP\Response;

class Pesan extends BaseController
{
    protected $pemesananMobilService;

    public function __construct()
    {
        $this->pemesananMobilService = new PemesananMobilService();
    }

    public function index(): string
    {
        return view('pesan');
    }

    public function formPemesanan($id): string
    {
        $curl = curl_init(getenv('api.pabrik.key') . 'api/mobil/' . $id);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . getenv('api.key')
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = [
            'mobil' => json_decode($response, true)
        ];
        return view('pesan', $data);
    }

    public function pesan(): \CodeIgniter\HTTP\RedirectResponse
    {
        $loyalitasmodel = model(Loyalitas::class);
        $usermodel = model(UserModel::class);
        
        $request = service('request');
        $idAkun = $this->session->get('user')['id'];    
        $mobilId = $request->getPost('id');
        $jumlahMobil = $request->getPost('jumlahPesanan');
        $harga = $request->getPost('harga');
        $stok = $request->getPost('stok');
        $waktuProduksi =  $request->getPost('waktuProduksi');
        if($waktuProduksi > 1){
            $penambahanWaktu = $waktuProduksi . ' days';
            $penambahanWaktu = date_create($penambahanWaktu);
        } else{
            $penambahanWaktu = $waktuProduksi . ' day';
            $penambahanWaktu = date_create($penambahanWaktu);
        }
        $totalHarga = $harga * $jumlahMobil;
        $tanggalPesan = date('Y-m-d');
        $tanggalKirim = $tanggalPesan;
        $stokSekarang = $stok - $jumlahMobil;

        $curl = curl_init(getenv('api.pabrik.key') . '/api/order');
        $data = [
            'mobilId' => $mobilId,
            'jumlah' => $jumlahMobil,
        ];
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . getenv('api.key')
        ]);
        $response = curl_exec($curl);
        $tanggalKirim = json_decode($response)->tanggalKirim;
        $user= $usermodel->getUserById($idAkun);
        $diskon = $loyalitasmodel->getDiskon((int)$user['loyalitasId']);
        $totalHarga = $totalHarga * (1-floatval($diskon));

        $this->insert($idAkun, $mobilId, $tanggalPesan, $tanggalKirim, $jumlahMobil, $totalHarga);
        return redirect()->to('/');
    }

    public function insert($idAkun, $mobilId, $tanggalPesan, $tanggalKirim, $jumlahMobil, $totalHarga)
    {
        $model = model(Pemesanan::class);
        $response = service('response');
        $data = $model->insertPesanan($idAkun, $mobilId, $tanggalPesan, $tanggalKirim, $jumlahMobil, $totalHarga);
        if ($data) {
            return $response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Data inserted successfully', 'data' => $data]);
        } else {
            return $response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Failed to insert data']);
        }
    }

    public function getDataPemesanan()
    {
        $model = model(Pemesanan::class);
        $response = service('response');
        $data = $model->getDataPemesanan();
        if ($data) {
            return $response->setStatusCode(200)->setJSON(['success' => true, 'message' => 'Data retrieved successfully', 'data' => $data]);
        } else {
            return $response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Failed to retrieve data']);
        }
    }

    public function transaksi(): string
    {
        // get data pemesanan
        $model = model(Pemesanan::class);
        $user = model(UserModel::class);

        $id = $this->session->get('user')['id'];
        
        if ($this->session->get('user')['admin'] == 1) {
            $transaksiData = $model->getDataPemesanan();
        } else {
            $transaksiData = $model->getDataPemesanan($id);
        }

        $mobilDetails = [];

        foreach ($transaksiData as &$transaksi) {
            $mobilId = $transaksi['mobilId'];

            $mobilDetail = $this->pemesananMobilService->getMobilById($mobilId);
            
            $userDetail = $user->getUserById($transaksi['userId']);

            $transaksi['mobilNama'] = $mobilDetail['nama'];
            $transaksi['userNama'] = $userDetail['nama'];

            unset($transaksi['mobilId'], $transaksi['userId']);
            $mobilDetails[] = $mobilDetail;
        }

        $data = [
            'transaksi' => $transaksiData
        ];

        return view('transaksi', $data);
    }
}
