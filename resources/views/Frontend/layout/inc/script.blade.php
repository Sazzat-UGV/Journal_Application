<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/Frontend') }}/lib/easing/easing.min.js"></script>
<script src="{{ asset('assets/Frontend') }}/lib/waypoints/waypoints.min.js"></script>
<script src="{{ asset('assets/Frontend') }}/lib/counterup/counterup.min.js"></script>
<script src="{{ asset('assets/Frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets/Frontend') }}/js/main.js"></script>

<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        {!! Toastr::message() !!}
@stack('user_script')
