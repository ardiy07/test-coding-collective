<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Default Title')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="icon" href="https://codingcollective.com/wp-content/uploads/2021/12/cropped-iconCo2-192x192.png" sizes="192x192">
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <link href={{ asset('css/soft-ui-dashboard-tailwind.css') }} rel="stylesheet" />
</head>

<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    @include('components.organisms.header-dashboard')
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        @include('components.organisms.navbar')
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>
    </main>
    @yield('script')    
</body>

</html>
