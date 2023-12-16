<?php

namespace App\Controllers;

class Listmobil extends BaseController
{
    public function index(): string
    {
        $curl = curl_init(getenv('api.pabrik.key').'api/mobil');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_HTTPHEADER, [
            'Authorization: Bearer '. getenv('api.key')
        ]);
        $response = curl_exec($curl);
        curl_close($curl);
        $role = $this->session->get('user')['admin'];
        $data = [
            'mobil' => json_decode($response,true),
            'role' => $role
        ];
        return view('listmobil', $data);
    }

    public function detailPesanan(): \CodeIgniter\HTTP\RedirectResponse 
    {
        $request = service('request');
        $id = $request->getPost('id');
        return redirect()->to('/pesan/' . $id);
    }
}
