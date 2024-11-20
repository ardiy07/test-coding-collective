@extends('components.template.auth')
@section('title', 'Sign In')
@section('content')
    <section class="relative py-10 bg-gray-900 sm:py-16 lg:py-24 h-screen">
        <div class="absolute inset-0">
            <img class="object-cover w-full h-full"
                src="https://cdn.rareblocks.xyz/collection/celebration/images/signin/2/man-eating-noodles.jpg"
                alt="" />
        </div>
        <div class="absolute inset-0 bg-gray-900/20"></div>

        <div class="relative max-w-lg px-4 mx-auto sm:px-0">
            <div class="overflow-hidden bg-white rounded-md shadow-md">
                <div class="px-4 py-6 sm:px-8 sm:py-7">
                    <a href="/" class="flex justify-center pb-5">
                        <img width="150" src="https://codingcollective.com/wp-content/uploads/2024/10/logo-co2.png" alt="logo" />
                    </a>
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
                        <p class="mt-2 text-base text-gray-600">Don’t have one? <a href="/register" title="register"
                                class="text-blue-600 transition-all duration-200 hover:underline hover:text-blue-700">Create
                                an account</a></p>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-500 text-white p-4 rounded-lg mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="mt-2" method="POST" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="text-base font-medium text-gray-900">
                                    Email
                                </label>
                                <div class="mt-2.5">
                                    <input type="email" id="email" name="email" placeholder="Enter your email"
                                        class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600" />
                                </div>
                            </div>

                            <div>
                                <label for="password" class="text-base font-medium text-gray-900">
                                    Password
                                </label>
                                <div class="mt-2.5">
                                    <input type="password" id="password" name="password" placeholder="Enter your password"
                                        class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600" />
                                </div>
                            </div>

                            @if(session('error'))
                                <div class="bg-red-100 text-red-800 p-3 rounded mb-3">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div>
                                <button type="submit" id="loginButton"
                                    class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">
                                    Log in
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
