@extends('Frontend.layout.master')
@section('title')
    Search Details
@endsection
@push('user_script')
@endpush
@section('content')
    <main class="container-fluid pt-3 pb-3 bg-light">
        <div class="container">
            <p style="font-size: 12px; font-weight: 600; color: black">GENERIC OPEN ACCESS
                <span class="text-danger text-bold">PDF</span>
            </p>
            <h5 class="card-title">{{ $result->paper_title }}</h5>
            <p class="card-text">
                {{ $result->author }}
            </p>
            <a href="{{ route('user.userManagementshowPDF', ['user_id' => $result->user_id, 'filename' => $result->file]) }}"
                class="btn btn-sm bg-secondary-light border-dark mr-1" target="_blank">
                <i class="fas fa-file"></i> Download PDF
            </a>

            <hr>
            <p style="font-size: 14px;">ABSTRACT</p>
            <p class="card-text text-justify">
                {{ $result->abstract }}
            </p>
            @if (isset($result->image))
                <p class=" d-flex justify-content-center">
                    <img src="{{ asset('uploads/paper') }}/{{ $result->image }}" class="img-fluid w-50" />
                </p>
            @endif
            <hr>
            <p><span style="font-weight: 600; color: black">Published by: </span><a
                    href="{{ route('home.publisherProfile', ['student_id' => $result->user->id]) }}">{{ $result->user->name }}</a>
            </p>
            <p class=""><span style="font-weight: 600; color: black">Publisher
                    DOI: </span><a href="https://dx.doi.org/{{ $result->doi }}" target="blank">{{ $result->doi }}</a>
            </p>
        </div>

    </main>
@endsection
@push('user_script')
@endpush
