@extends('components.template.dashboard')

@section('title', 'Dashboard')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Edit User</h2>

            <form method="POST" action="{{ route('user.update', $user->id) }}">
                @csrf
                @method('PUT')
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                    @if ($errors->has('name'))
                        <div class="text-red-500">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                    @if ($errors->has('email'))
                        <p class="text-red-500">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">New Password</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @if ($errors->has('password'))
                        <p class="text-red-500">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full  text-white py-2 px-4 rounded-md bg-gradient-to-tl from-purple-700 to-pink-500 focus:outline-none">
                        Update User
                    </button>
                </div>
            </form>

            <!-- success message -->
            @if (session('success'))
                <div class="mt-4 text-green-500 text-center">
                    {{ session('success') }}
                </div>
            @endif


            <!-- Error Messages -->
            @if (session('error'))
                <div class="mt-4 text-red-500 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
