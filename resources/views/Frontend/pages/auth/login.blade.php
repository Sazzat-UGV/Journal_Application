@extends('Frontend.layout.master')
@section('title')
    User Login
@endsection
@push('user_style')

@endpush
@section('content')
    <main class="container pt-4">
        <div class="row">
            <div class="col-sm-1 col-md-1 col-lg-3"></div>
            <div class="col-sm-10 col-md-10 col-lg-6 pb-4">
                <div class="card py-2 bg-primary">
                    <h5 class="text-white text-center">Sign-in to UGV Journal</h5>
                </div>
                <div class="card bg-light">
                    <form class="text-start px-5 pt-4 pb-5" action="{{ route('home.login') }}" method="post">
                        @csrf
                        <div class="container">
                            <div class="mb-4">
                                <label class="form-label text-start fw-bold" for="email">Email
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control @error('email')
                                    is-invalid
                                @enderror"
                                    type="email" name="email" id="email"
                                    placeholder="Enter email address" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-start fw-bold" for="password">Password
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control  @error('password')
                                    is-invalid
                                @enderror"
                                    type="password" name="password" id="password"
                                    placeholder="Enter your password " />
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="text-center mb-4">
                                <button type="submit" class="btn btn-primary me-4">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-outline-primary">
                                    Clear
                                </button>
                            </div>
                            <div class="text-center d-flex justify-content-center mb-2">
                                <span>Dont have an account?
                                    <a href="{{ route('home.registrationPage') }}"
                                        class="text-decoration-none">Register</a></span>
                            </div>
                            <div class="text-center">
                                <p class="fs-6">
                                    <a href="{{ route('home.forgetPasswordPage') }}">Forgot Password?</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-1 col-md-1 col-lg-3"></div>
        </div>

    </main>
@endsection
@push('user_script')

@endpush
