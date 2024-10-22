@extends('layouts.app')

@section('content')
    <h1>Countries</h1>

    <form action="{{ route('countries.store') }}" method="POST">
        @csrf
        <div>
            <label for="code">Code:</label>
            <input disabled type="text" value="{{ $kode_baru }}" required>
        </div>

        <input type="text" name="code" id="code" hidden value="{{ $kode_baru }}">

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <button type="submit">Simpan</button>
    </form>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection