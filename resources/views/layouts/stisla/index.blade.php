@include('layouts.stisla.header')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.stisla.navbar')

            @include('layouts.stisla.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard - {{ auth()->user()->name }}</h1>
                    </div>

                    @yield('content')
                </section>
            </div>
            @include('layouts.stisla.footer')