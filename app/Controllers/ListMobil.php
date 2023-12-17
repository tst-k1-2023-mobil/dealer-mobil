<?php

namespace App\Controllers;
use App\Models\Pemesanan;

class Listmobil extends BaseController
{
    public function index()
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $response = $this->getDataMobil();
        
        $role = $this->session->get('user')['admin'];
        $data = [
            'mobil' => $response,
            'role' => $role
        ];
        return view('listmobil', $data);
    }

    public function detailPesanan(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $request = service('request');
        $id = $request->getPost('id');
        return redirect()->to('/pesan/' . $id);
    }

    public function getDataMobil($id = null)
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $curl = curl_init(($id) ? getenv('api.pabrik.key') . 'api/mobil/' . $id : getenv('api.pabrik.key') . 'api/mobil');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . getenv('api.key')
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
