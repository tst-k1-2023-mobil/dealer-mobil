<?php
namespace App\Models;
use CodeIgniter\Model; 
class Pemesanan extends Model{
    protected $table = 'pemesanan';
    protected $allowedFields = ['userId', 'mobilId', 'tglPesan', 'tglKirim', 'jumlah', 'totalHarga'];

    public function insertPesanan($idAkun,$mobilId,$tanggalPesan,$tanggalKirim,$jumlahMobil,$totalHarga){
        $data = [
            'userId' => $idAkun,
            'mobilId' => $mobilId,
            'tglPesan' => $tanggalPesan,
            'tglKirim' => $tanggalKirim,
            'jumlah' => $jumlahMobil,
            'totalHarga' => $totalHarga
        ];

        return $this->insert($data);
    }

    public function getDataPemesanan($id = null){
        if($id == null){
            return $this->findAll();
        }else{
            return $this->where(['userId' => $id])->findAll();
        }
    }
}
