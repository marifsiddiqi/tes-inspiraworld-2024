@extends('layouts.app')

@section('content')
    <h1>Provinces</h1>
    <p>You are logged in!</p>

    <form id="form-province-{{ $country->id }}" action="{{ route('provinces.store', $country->id) }}" method="POST">
        @csrf
        <div>
            <label for="code">Code:</label>
            <input type="text" value="{{ $kode_baru }}" required disabled>
        </div>
        <input type="text" name="code" id="code" hidden value="{{ $kode_baru }}">
        <div>
            <label for="country">Country:</label>
            <input type="text" required disabled value="{{ $country->code . " - " . $country->name }}">
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <h4>Tambah Kota di Provinsi Ini</h4>
            <div id="cities-{{ $country->id }}"></div>
            <button type="button" onclick="addCityField({{ $country->id }})">Tambah Kota</button>
        </div>
        <button type="submit">Simpan Provinsi</button>
    </form>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>


    <script>
        function showProvinceForm(countryId) {
            document.getElementById('form-province-' + countryId).style.display = 'block';
        }

        function addCityField(countryId) {
            const citiesDiv = document.getElementById('cities-' + countryId);
            const cityIndex = citiesDiv.children.length;
            const cityField = `<div>
                <label for="cities[${cityIndex}][name]">Nama Kota:</label>
                <input type="text" name="cities[${cityIndex}][name]" required>
            </div>`;
            citiesDiv.insertAdjacentHTML('beforeend', cityField);
        }
    </script>
@endsection
