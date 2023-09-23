@extends('Backend.layout.master')
@section('title')
    Edit Semester
@endsection
@push('admin_style')
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Edit Semester',
        'main_page_name' => 'Semesters',
        'sub_page_name' => 'Edit Semester',
        'main_page_url' => route('semester.index'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="d-flex justify-content-start">
                        <a href="{{ route('semester.index') }}" class="btn btn-primary me-4"><i
                                class="fas fa-arrow-alt-circle-left"></i>
                            Back to Semesters</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="{{ route('semester.update', $semester->slug) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Semester Name <span class="text-danger">*</span></label>
                        <input type="text" name="semester_name" value="{{ $semester->semester_name }}"
                            placeholder="Enter semester name"
                            class="form-control @error('semester_name')
            is-invalid
            @enderror">
                        @error('semester_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('admin_script')
@endpush
