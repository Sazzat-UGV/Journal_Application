@extends('Frontend.layout.master')

@section('title')
    Forget Password
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container py-5">
        <div class="pb-2 mb-5">
            <div class="container" style="width: 600px !important;">
                <div class="card py-2 px-5 bg-success">
                    <h5 class="text-white text-center">Forget Password?</h5>
                </div>
                <div class="card bg-light">
                    <div class="container px-5 pb-5 ">
                        <p class="pt-4 fs-6 text-center">Forgotten your password? Enter your email address below, and we'll email
                            instructions for setting a new one.</p>
                        <form action="{{ route('home.forgetPassword') }}" method="POST">
                            @csrf
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
                            <div class="text-center">

                                <button class="btn btn-success " type="submit">Send email</button>
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
