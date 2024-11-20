@extends('components.template.dashboard')

@section('title', 'Employees')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Edit Employee</h2>

            <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                @csrf
                @method('PUT')
                <!-- Name Field -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $employee->user->name) }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        disabled>
                </div>

                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $employee->user->email) }}"
                        class="mt-1 p-2 w-full  border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        disabled>
                </div>

                <div class="mb-4">
                    <label for="city" class="block text-sm font-medium text-gray-600">City</label>
                    <input type="text" name="city" id="city" value="{{ old('city', $employee->city) }}"
                        class="mt-1 p-2 capitalize w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        required>
                    @if ($errors->has('city'))
                        <div class="text-red-500">{{ $errors->first('city') }}</div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="dob" class="block text-sm font-medium text-gray-600">Date of Birth</label>
                    <input type="date" name="dob" id="dob" value="{{ old('dob', $employee->dob) }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           required>
                    @if ($errors->has('dob'))
                        <div class="text-red-500">{{ $errors->first('dob') }}</div>
                    @endif
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full text-white py-2 px-4 rounded-md bg-gradient-to-tl from-purple-700 to-pink-500 focus:outline-none">
                        Update Employee
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
