<?php
namespace App\Controllers;

use App\Controllers\Pesan;
use App\Controllers\Listmobil;

class PemesananMobilService {
    protected $listMobilController;

    public function __construct()
    {
        $this->listMobilController = new Listmobil();
    }

    public function getMobilById($id)
    {
        // Call the method from Listmobil controller
        return $this->listMobilController->getDataMobil($id);
    }
}