@extends('Frontend.layout.master')

@section('title')
    Reset Password
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-4">
        <div class="row">
            <div class="col-sm-1 col-md-1 col-lg-3"></div>
            <div class="col-sm-10 col-md-10 col-lg-6 ">
                <div class="card py-2 bg-primary">
                    <h5 class="text-white text-center">Reset Password</h5>
                </div>
                <div class="card bg-light pb-5 mb-5 pt-3">
                    <form action="{{ route('home.resetPassword', $token) }}" method="POST">
                        @csrf
                        <input type="hidden" name="reset_token" value="{{ $token }}">
                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="email">Email
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('email')
                            is-invalid
                            @enderror"
                                type="email" name="email" id="email" style="height: 50px !important"
                                placeholder="Enter your email" value="{{ old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="password">Password
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('password')
                            is-invalid
                            @enderror"
                                type="password" name="password" id="password" style="height: 50px !important"
                                placeholder="Enter your password" value="{{ old('password') }}" />
                            @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="password_confirmation">Retype
                                Password
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('password_confirmation')
                            is-invalid
                            @enderror"
                                type="password" name="password_confirmation" id="password_confirmation"
                                style="height: 50px !important" placeholder="Enter your password again"
                                value="{{ old('password_confirmation') }}" />
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary " type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-1 col-md-1 col-lg-3"></div>
        </div>

    </main>
@endsection
@push('user_script')
@endpush
