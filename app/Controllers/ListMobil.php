<?php

namespace App\Controllers;

class Listmobil extends BaseController
{
    public function index(): string
    {
        $curl = curl_init('http://localhost:8081//api/mobil');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $data = [
            'mobil' => json_decode($response,true)
        ];
        return view('listmobil',$data);
    }

    public function detailPesanan(): \CodeIgniter\HTTP\RedirectResponse 
    {
        $request = service('request');
        $id = $request->getPost('id');
        return redirect()->to('/pesan/' . $id);
    }
}