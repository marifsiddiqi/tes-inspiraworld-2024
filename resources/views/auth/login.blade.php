@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-sm">
            <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>

            <form action="{{ route('login.process') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" name="password" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Login
                    </button>
                </div>

                @if ($errors->any())
                    <div class="text-red-500 text-sm mt-4">
                        <strong>{{ $errors->first('email') }}</strong>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
