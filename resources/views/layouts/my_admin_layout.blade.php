<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset(get_my_app_config('favicon')) }}" type="image/x-icon">

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <title>@yield('title', 'Title') | {{ config('app.name', 'Laravel') }}</title>

    @if (auth()->user())
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   @endif

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .sidebar-link, a.sidebar-link{
            color:white;
        }
        .sidebar-link i, .sidebar-link svg, a.sidebar-link i, a.sidebar-link svg {
            color: white;
        }
    </style>
    {{-- untuk push style --}}
    @stack('style')

</head>

<body>
        @if (auth()->user() == null)
            @include('layouts.navbar')
            @yield('content')
        @else
        <div class="wrapper mb-0">
            @if(auth()->user()->role !== 'user')
                @include('layouts.sidebar_user')
            @endif
            <div class="main">
                @include('layouts.topbar_user')
                @yield('content')
            </div>
        </div>
        @endif
        @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.dataTables.js"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
</body>

</html>
