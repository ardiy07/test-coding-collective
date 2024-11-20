<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <link rel="icon" href="https://codingcollective.com/wp-content/uploads/2021/12/cropped-iconCo2-192x192.png" sizes="192x192">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-gradient-to-b from-green-50 to-green-100">
        @include('components.organisms.header-home')
        @yield('content')
    </div>
</body>

</html>
