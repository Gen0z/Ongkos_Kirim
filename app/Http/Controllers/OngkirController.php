<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{
    public function index()
    {
        $response = Http::withHeaders([
            'key' => 'bfc30b16967df1939ec74eeac092e310'
        ])->get('https://api.rajaongkir.com/starter/city');
        $cities = $response['rajaongkir']['results'];
        return view('cek-ongkir', ['cities' => $cities, 'ongkir' => '']);
    }

    public function cekOngkir(Request $request)
    {
        $response = Http::withHeaders([
            'key' => 'bfc30b16967df1939ec74eeac092e310'
        ])->get('https://api.rajaongkir.com/starter/city');

        $responseCost = Http::withHeaders([
            'key' => 'bfc30b16967df1939ec74eeac092e310'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        $cities = $response['rajaongkir']['results'];
        $ongkir = $responseCost['rajaongkir'];
        return view('cek-ongkir', ['cities' => $cities, 'ongkir' => $ongkir]);
    }
}
