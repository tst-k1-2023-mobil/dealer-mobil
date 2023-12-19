<?php

namespace App\Controllers;
use App\Models\Loyalitas;
use App\Models\UserModel;

class Listmobil extends BaseController
{
    public function index()
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $response = $this->getDataMobil();
        
        $role = $this->session->get('user')['admin'];

        $usermodel = model(UserModel::class);
        $loyalitasmodel = model(Loyalitas::class);

        $diskon = $loyalitasmodel->getDiskon($usermodel->getLoyalty($this->session->get('user')['id'])['loyalitasId']);
    
        $data = [
            'mobil' => $response,
            'role' => $role,
            'diskon' => $diskon,
            'title' => 'List Mobil | Dealer.in'
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
        $curl = curl_init(($id) ? getenv('api_pabrik_key') . 'api/mobil/' . $id : getenv('api_pabrik_key') . 'api/mobil');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . getenv('api_key')
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
