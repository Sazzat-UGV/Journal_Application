@extends('Frontend.layout.master')

@section('title')
    Forget Password
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-4">
        <div class="row">
            <div class="col-sm-1 col-md-1 col-lg-3"></div>
            <div class="col-sm-10 col-md-10 col-lg-6 ">
                <div class="card py-2 bg-primary">
                    <h5 class="text-white text-center">Forget Password?</h5>
                </div>
                <div class="card bg-light pb-5 mb-5 ">
                    <p class="pt-4 fs-6 text-center">Forgotten your password? Enter your email address below, and we'll email
                        instructions for setting a new one.</p>
                    <form action="{{ route('home.forgetPassword') }}" method="POST">
                        @csrf
                        <div class="col-auto mb-4">
                            <label class="form-label text-start fw-bold" for="email">Email
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control  @error('email')
                            is-invalid
                            @enderror"
                                type="email" name="email" id="email" style="height: 50px !important"
                                placeholder="Enter your email" value="{{ old('email') }}" />
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        <div class="text-center">

                            <button class="btn btn-primary " type="submit">Send email</button>
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
