@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold mb-6">Welcome to the Dashboard</h1>

        <a href="{{ route('countries.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-6 inline-block">Tambah Negara</a>

        <h2 class="text-2xl font-semibold mt-6 mb-4">Daftar Negara, Provinsi, dan Kota</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">Kode Negara</th>
                        <th class="py-2 px-4 text-left">Nama Negara</th>
                        <th class="py-2 px-4 text-left">Provinsi</th>
                        <th class="py-2 px-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr class="border-b">
                        <td class="py-2 px-4">{{ $country->code }}</td>
                        <td class="py-2 px-4">{{ $country->name }}</td>
                        <td class="py-2 px-4">
                            <ul class="list-disc pl-6">
                                @foreach($country->provinces as $province)
                                    <li class="mb-2">
                                        <strong>{{ $province->code }} - {{ $province->name }}</strong>
                                        <ul class="list-decimal pl-6">
                                            @foreach($province->cities as $city)
                                                <li>{{ $city->code }} - {{ $city->name }}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('provinces.index', $country->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-6 inline-block">Tambah Provinsi dan Kota</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <form action="{{ route('logout') }}" method="POST" class="mt-6">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Logout</button>
        </form>
    </div>
@endsection
