<script src="{{ asset('assets/Frontend') }}/js/main.js"></script>
<script src="{{ asset('assets/Frontend') }}/js/bootstrap.bundle.min.js"></script>


<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@stack('user_script')
