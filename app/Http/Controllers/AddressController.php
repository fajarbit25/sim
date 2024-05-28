<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AddressController extends Controller
{
    public function getProvinces()
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);
        return $jsonData;
    }
    public function getProvince($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/province/".$id.".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }

    public function getRegencies($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }
    public function getRegency($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regency/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }

    public function getDistricts($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/districts/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }
    public function getDistrict($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/district/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }

    public function getVillages($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/villages/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }
    public function getVillage($id)
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/village/". $id .".json";

        $client = new Client();

        $response = $client->request('GET', $url);
        $jsonData = json_decode($response->getBody(), true);

        return $jsonData;
    }

}
