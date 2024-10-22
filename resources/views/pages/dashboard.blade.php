@extends('layouts.app')

@section('content')
    <h1>Welcome to the Dashboard</h1>
    <p>You are logged in!</p>

    <a href="{{ route('countries.index') }}">Tambah Negara</a>
    {{-- <a href="{{ route('provinces.index') }}">Master Provinsi</a> --}}

    <h2>Daftar Negara, Provinsi, dan Kota</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Negara</th>
                <th>Nama Negara</th>
                <th>Provinsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
            <tr>
                <td>{{ $country->code }}</td>
                <td>{{ $country->name }}</td>
                <td>
                    <ul>
                        @foreach($country->provinces as $province)
                            <li>
                                <strong>{{ $province->code }} - {{ $province->name }}</strong>
                                <ul>
                                    @foreach($province->cities as $city)
                                        <li>{{ $city->code }} - {{ $city->name }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('provinces.index', $country->id) }}">Tambah Provinsi dan Kota</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
