@extends('Frontend.layout.master')

@section('title')
    Reset Password
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-5">
        <div class="pb-2 mb-3">
            <div class="container" style="width: 600px !important;">
                <div class="card py-2 px-5 bg-success">
                    <h5 class="text-white text-center">Reset Password</h5>
                </div>
                <div class="card bg-light">
                    <div class="container px-5 pb-5 pt-4">
                        <form action="{{ route('home.resetPassword',$token) }}" method="POST">
                            @csrf
                            <input type="hidden" name="reset_token" value="{{ $token }}">
                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="email">Email
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('email')
                                is-invalid
                                @enderror"
                                    type="email" name="email" id="email" style="height: 50px !important"
                                    placeholder="Enter your email" value="{{ old('email') }}" />
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
                                    placeholder="Enter your password" value="{{ old('password') }}" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="password_confirmation">Retype Password
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('password_confirmation')
                                is-invalid
                                @enderror"
                                    type="password" name="password_confirmation" id="password_confirmation" style="height: 50px !important"
                                    placeholder="Enter your password again" value="{{ old('password_confirmation') }}" />
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success " type="submit">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('user_script')
@endpush
