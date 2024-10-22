<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function indexCountries()
    {
        $countries = Country::with('provinces.cities')->get();

        // $kode = 'N0001';
        // $ambil_angka = substr($kode, 1, strlen($kode));
        // $convert_to_int = intval($ambil_angka) + 1;
        // $convert_to_string = strval($convert_to_int);


        // $kode_nol = '';
        // for ($i = 0; $i < 4 - strlen($convert_to_string); $i++) {
        //     $kode_nol .= '0';
        // }

        // $kode_baru = "N" . $kode_nol . $convert_to_string;

        // dd($kode_baru);

        try {
            $lastCountry = Country::orderBy('id', 'desc')->first();
            $ambil_angka = substr($lastCountry->code, 1, strlen($lastCountry->code));
            $convert_to_int = intval($ambil_angka) + 1;
            $convert_to_string = strval($convert_to_int);


            $banyak_kode_nol = '';
            for ($i = 0; $i < 4 - strlen($convert_to_string); $i++) {
                $banyak_kode_nol .= '0';
            }

            $kode_baru = "N" . $banyak_kode_nol . $convert_to_string;
        } catch (\Throwable $th) {
            $kode_baru = "N0001";
        }

        // dd($kode_baru);

        return view('pages.countries', compact('countries', 'kode_baru'));
    }

    public function storeCountry(Request $request)
    {
        Country::create($request->all());
        return redirect()->route('dashboard');
    }

    public function indexProvinces($countryId)
    {
        $country = Country::with('provinces.cities')->find($countryId);
        try {
            $lastProvince = Province::orderBy('id', 'desc')->first();
            $ambil_angka = substr($lastProvince->code, 1, strlen($lastProvince->code));
            $convert_to_int = intval($ambil_angka) + 1;
            $convert_to_string = strval($convert_to_int);


            $banyak_kode_nol = '';
            for ($i = 0; $i < 4 - strlen($convert_to_string); $i++) {
                $banyak_kode_nol .= '0';
            }

            $kode_baru = "P" . $banyak_kode_nol . $convert_to_string;
        } catch (\Throwable $th) {
            $kode_baru = "P0001";
        }
        return view('pages.province', compact('country', 'kode_baru'));
    }

    public function storeProvince(Request $request, $countryId)
    {
        Province::create([
            'code' => $request->code,
            'name' => $request->name,
            'country_id' => $countryId
        ]);

        $lastProvince = Province::orderBy('id', 'desc')->first();

        if (isset($request->cities) && is_array($request->cities)) {
            foreach ($request->cities as $city) {
                $lastCity = City::orderBy('id', 'desc')->first();
                $ambil_angka_city = $lastCity ? substr($lastCity->code, 1) : '0';
                $convert_to_int_city = intval($ambil_angka_city) + 1;

                $banyak_kode_nol_city = str_repeat('0', 4 - strlen((string)$convert_to_int_city));
                $kode_baru_kota = "C" . $banyak_kode_nol_city . $convert_to_int_city;

                City::create([
                    'code' => $kode_baru_kota,
                    'name' => $city['name'],
                    'province_id' => $lastProvince->id,
                ]);
            }
        }

        return redirect()->route('dashboard');
    }

    public function indexCities($provinceId)
    {
        $province = Province::with('cities')->find($provinceId);
        return view('pages.cities', compact('province'));
    }

    public function storeCity(Request $request, $provinceId)
    {
        City::create([
            'code' => $request->code,
            'name' => $request->name,
            'province_id' => $provinceId
        ]);
        return redirect()->back();
    }
}
