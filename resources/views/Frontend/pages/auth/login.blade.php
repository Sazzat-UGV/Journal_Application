@extends('Frontend.layout.master')
@section('title')
    User Login
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-4">
        <div class="pb-2 mb-3">
            <div class="container" style="width: 500px !important">
                <div class="card py-2 px-5 bg-success">
                    <h5 class="text-white text-center">Sign-in to UGV Journals</h5>
                </div>
                <div class="card bg-light">
                    <form class="text-start px-5 pt-4 pb-5" action="{{ route('home.login') }}" method="post">
                        @csrf
                        <div class="container">

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="email">Email
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('email')
                                is-invalid
                                @enderror"
                                    type="email" name="email" id="email" style="height: 50px !important"
                                    placeholder="Enter email address" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="password">Password
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('password')
                                    is-invalid
                                @enderror"
                                    type="password" name="password" id="password" style="height: 50px !important"
                                    placeholder="Enter your password " />
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-success me-4">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-outline-success">
                                    Clear
                                </button>
                            </div>
                            <div class="text center d-flex justify-content-center mb-2">
                                <span>Dont have an account?
                                    <a href="{{ route('home.registrationPage') }}"
                                        class="text-decoration-none">Register</a></span>
                            </div>
                            {{-- <div class="text-center">
                                <p class="fs-6">
                                    <a href="forget_password.html">Forgot Password?</a>
                                </p>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('user_script')
@endpush
