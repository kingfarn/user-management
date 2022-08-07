<!-- Header -->
@include('layouts.header')
<div class="content-wrapper">
    <section class="content">
        @yield('content')
    </section>
</div>

<!-- Footer -->
@include('sweetalert::alert')
@include('layouts.footer')
