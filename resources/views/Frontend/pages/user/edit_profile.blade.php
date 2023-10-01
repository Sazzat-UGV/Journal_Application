@extends('Frontend.layout.master')
@section('title')
Edit Profile
@endsection
@push('user_style')

@endpush
@section('content')
<main class="container pt-4">
    <div class="row">
        <div class="col-sm-1 col-md-1 col-lg-3"></div>
        <div class="col-sm-10 col-md-10 col-lg-6 pb-4">
            <div class="card py-2 bg-primary">
                <h5 class="text-white text-center">Edit Profile</h5>
            </div>
            <div class="card bg-light">
                <form class="text-start p-4" action="{{ route('user.editProfile',['id'=>Auth::user()->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="name">Your Name <span
                                    class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('name')
                                is-invalid
                            @enderror"
                                type="text" name="name" id="name" style="height: 50px !important;"
                                placeholder="Enter your name " value="{{ Auth::user()->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="email">Your Email <span
                                    class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                type="email" name="email" id="email"
                                value="{{Auth::user()->email }}"style="height: 50px !important;"
                                placeholder="Enter your email ">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="phone">Your Phone Number
                                <span class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('phone')
                                is-invalid
                            @enderror"
                                type="phone" name="phone" id="phone" value="{{ Auth::user()->phone }}"
                                style="height: 50px !important;" placeholder="Enter your phone number">
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="address">Your Addesss <span
                                    class="text-danger fw-normal">*</span></label>
                            <input
                                class="form-control @error('address')
                                is-invalid
                            @enderror"
                                type="text" name="address" value="{{ Auth::user()->address }}" id="address"
                                style="height: 50px !important;" placeholder="Enter your address">
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="address">Department <span
                                    class="text-danger fw-normal">*</span></label>
                            <select
                                class="form-select form-control @error('department_id')
                                is-invalid
                            @enderror"
                                name="department_id">
                                <option value="">Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        @if (Auth::user()->department_id == $department->id)
                                         selected
                                         @endif
                                         >
                                        {{ $department->full_name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                        </div>
                        <div class=" mb-4">
                            <label class="form-label text-start fw-bold" for="semester_id">Semester <span
                                    class="text-danger fw-normal">*</span></label>
                            <select class="form-select form-control @error('semester_id')
                            is-invalid
                        @enderror" name="semester_id">
                                <option value="">Select Semester</option>
                                @foreach ($semesters as $semester)
                                    <option value="{{ $semester->id }}"
                                        @if (Auth::user()->semester_id == $semester->id)
                                         selected
                                         @endif
                                         >
                                        {{ $semester->semester_name }}</option>
                                @endforeach
                            </select>
                            @error('semester_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                        </div>

                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-primary me-4">Submit</button>
                            <button type="reset" class="btn btn-outline-primary">Clear</button>
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
