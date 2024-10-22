@extends('layouts.app')

@section('content')
    <h2>Login</h2>

    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>

        @if ($errors->any())
            <div>
                <strong>{{ $errors->first('email') }}</strong>
            </div>
        @endif
    </form>
@endsection
