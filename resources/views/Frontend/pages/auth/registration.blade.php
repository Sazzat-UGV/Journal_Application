@extends('Frontend.layout.master')
@section('title')
    User Registration
@endsection
@push('user_style')
@endpush
@section('content')
    <main class="container pt-5">
        <div class="pb-2 mb-3">
            <div class="container" style="width: 600px !important;">
                <div class="card py-2 px-5 bg-success">
                    <h5 class="text-white text-center">New to UGV Journals? Register here...</h5>
                </div>
                <div class="card bg-light">
                    <form class="text-start p-5" action="{{ route('home.registration') }}" method="POST">
                        @csrf
                        <div class="container">

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="name">Your Name <span
                                        class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('name')
                                    is-invalid
                                @enderror"
                                    type="text" name="name" id="name" style="height: 50px !important;"
                                    placeholder="Enter your name " value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="student_id">Your Student ID
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('student_id')
                                    is-invalid
                                @enderror"
                                    type="text" name="student_id" value="{{ old('student_id') }}"id="student_id"
                                    style="height: 50px !important;" placeholder="Enter your Id ">
                                @error('student_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="email">Your Email <span
                                        class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('email')
                                    is-invalid
                                @enderror"
                                    type="email" name="email" id="email"
                                    value="{{ old('email') }}"style="height: 50px !important;"
                                    placeholder="Enter your email ">
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="phone">Your Phone Number
                                    <span class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('phone')
                                    is-invalid
                                @enderror"
                                    type="phone" name="phone" id="phone" value="{{ old('phone') }}"
                                    style="height: 50px !important;" placeholder="Enter your phone number">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="address">Your Addesss <span
                                        class="text-danger fw-normal">*</span></label>
                                <input
                                    class="form-control px-4 @error('address')
                                    is-invalid
                                @enderror"
                                    type="text" name="address" value="{{ old('address') }}" id="address"
                                    style="height: 50px !important;" placeholder="Enter your address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="address">Department <span
                                        class="text-danger fw-normal">*</span></label>
                                <select
                                    class="form-select @error('department_id')
                                    is-invalid
                                @enderror"
                                    name="department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                            {{ $department->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror

                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="semester_id">Semester <span
                                        class="text-danger fw-normal">*</span></label>
                                <select class="form-select @error('semester_id')
                                is-invalid
                            @enderror" name="semester_id">
                                    <option value="">Select Semester</option>
                                    @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}"
                                            {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                            {{ $semester->semester_name }}</option>
                                    @endforeach
                                </select>
                                @error('semester_id')
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
                                    type="password" name="password" id="password" style="height: 50px !important;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="col-auto mb-4">
                                <label class="form-label text-start text-success fw-bold" for="password">Retype Password
                                    <span class="text-danger fw-normal">*</span></label>
                                <input class="form-control px-4" type="password" name="password_confirmation"
                                    id="password" style="height: 50px !important;">
                            </div>


                            <div class="text-center mb-2">
                                <button type="submit" class="btn btn-success me-4">Submit</button>
                                <button type="reset" class="btn btn-outline-success">Clear</button>
                            </div>
                            <div class="text center d-flex justify-content-center">
                                <span>Already have an account? <a href="{{ route('home.loginPage') }}"
                                        class="text-decoration-none">Sign-in</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('user_script')
@endpush
