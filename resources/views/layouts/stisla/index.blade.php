@include('layouts.stisla.header')

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('layouts.stisla.navbar')

            @include('layouts.stisla.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @if(isset($header))
                    <div class="section-header">
                        <h1>{{ $header }}</h1>
                    </div>
                    @endif

                    

                    @yield('content')
                </section>
            </div>
        </div>
    </div>

@include('layouts.stisla.footer')