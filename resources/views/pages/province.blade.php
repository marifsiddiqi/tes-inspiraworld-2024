@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6">Provinces</h1>

        <form id="form-province-{{ $country->id }}" action="{{ route('provinces.store', $country->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label for="code" class="block text-gray-700 text-sm font-bold mb-2">Code:</label>
                <input type="text" value="{{ $kode_baru }}" required disabled class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <input type="text" name="code" id="code" hidden value="{{ $kode_baru }}">

            <div class="mb-4">
                <label for="country" class="block text-gray-700 text-sm font-bold mb-2">Country:</label>
                <input type="text" required disabled value="{{ $country->code . ' - ' . $country->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" name="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <h4 class="text-lg font-semibold mb-2">Tambah Kota di Provinsi Ini</h4>
                <div id="cities-{{ $country->id }}" class="mb-4"></div>
                <button type="button" onclick="addCityField({{ $country->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Tambah Kota</button>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Provinsi</button>
        </form>

        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
        </form>
    </div>

    <script>
        function addCityField(countryId) {
            const citiesDiv = document.getElementById('cities-' + countryId);
            const cityIndex = citiesDiv.children.length;
            const cityField = `<div class="mb-4">
                <label for="cities[${cityIndex}][name]" class="block text-gray-700 text-sm font-bold mb-2">Nama Kota:</label>
                <input type="text" name="cities[${cityIndex}][name]" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>`;
            citiesDiv.insertAdjacentHTML('beforeend', cityField);
        }
    </script>
@endsection
