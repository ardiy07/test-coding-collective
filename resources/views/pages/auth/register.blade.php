@extends('components.template.auth')
@section('title', 'Sign Up')
@section('content')
    <section class="relative py-10 bg-gray-900 sm:py-16 lg:py-24">
        <div class="absolute inset-0">
            <img class="object-cover w-full h-full"
                src="https://cdn.rareblocks.xyz/collection/celebration/images/signup/2/woman-working-laptop.jpg"
                alt="" />
        </div>
        <div class="relative max-w-lg px-4 mx-auto sm:px-0">
            <div class="overflow-hidden bg-white rounded-md shadow-md">
                <div class="px-4 py-6 sm:px-8 sm:py-7">
                    <a href="/" class="flex justify-center pb-5">
                        <img width="150" src="https://codingcollective.com/wp-content/uploads/2024/10/logo-co2.png" alt="logo" />
                    </a>
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-gray-900">Create an account</h2>
                        <p class="mt-2 text-base text-gray-600">Already joined? <a href="/login" title="login"
                                class="text-blue-600 transition-all duration-200 hover:underline hover:text-blue-700">Sign
                                in now</a></p>
                    </div>

                    <form action="{{ route('register.store') }}" method="POST" class="mt-8">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="" class="text-base font-medium text-gray-900"> Full name
                                </label>
                                <div class="mt-2.5">
                                    <input type="text" name="name" id="name" placeholder="Enter your full name"
                                        value="{{ old('name') }}"
                                        class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600"
                                        required />
                                </div>
                                @if ($errors->has('name'))
                                    <div class="text-red-500">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div>
                                <label for="" class="text-base font-medium text-gray-900"> Email address </label>
                                <div class="mt-2.5">
                                    <input type="email" name="email" id="email"
                                        placeholder="Enter email to get started" value="{{ old('email') }}"
                                        class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600"
                                        required />
                                </div>
                                @if ($errors->has('email'))
                                    <div class="text-red-500">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div>
                                <label for="password" class="text-base font-medium text-gray-900"> Password </label>
                                <div class="mt-2.5">
                                    <input type="password" name="password" id="password" placeholder="Enter your password"
                                        class="block w-full p-4 text-black placeholder-gray-500 transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-blue-600 caret-blue-600"
                                        required />
                                </div>
                                @if ($errors->has('password'))
                                    <div class="text-red-500">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div>
                                <button type="submit"
                                    class="inline-flex items-center justify-center w-full px-4 py-4 text-base font-semibold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-md focus:outline-none hover:bg-blue-700 focus:bg-blue-700">Sign
                                    up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
