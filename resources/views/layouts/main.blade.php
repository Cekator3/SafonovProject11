<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Styles -->
    {{-- Common styles --}}
    <link href="/assets/css/common/normalize.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/themes.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/app.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/common/header.css" rel="stylesheet" type="text/css">

    <link href="/assets/css/fonts/manropeFont.css" rel="stylesheet" type="text/css">
    {{-- Other styles --}}
    @yield('styles')

    {{-- Javascripts --}}
    @yield('scripts')
</head>

<body>
    <header>
        {{-- Logo --}}
        <a class="company-logo" href="{{ route('home') }}"></a>

        {{-- Navigation --}}
        <nav>
            @yield('navigation')
        </nav>
    </header>

    <main>
        @yield('main')
    </main>
</body>
