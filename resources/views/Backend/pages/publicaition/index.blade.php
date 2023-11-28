@extends('Backend.layout.master')
@section('title')
    Index Publications
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Index Publication',
        'main_page_name' => 'Publications',
        'sub_page_name' => 'Index Publication',
        'main_page_url' => route('publication.index'),
    ])
<div class="card">
    <div class="card-body">
        <div class="row">

            <div class="table-responsive text-nowrap my-3">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Publish Date</th>
                            <th>Publish By</th>
                            <th>Student ID</th>
                            <th>Paper Title</th>
                            <th>Paper Area</th>
                            @can('view-publication')
                                <th>Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($papers as $index => $paper)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $paper->created_at->format('d-M-Y') }}</td>
                                <td>{{ Str::limit($paper->user->name, 15, '...') }}</td>
                                <td>{{ $paper->user->student_id }}</td>
                                <td>{{ Str::limit($paper->paper_title, 25, '...') }}</td>
                                <td>{{ Str::limit($paper->category->category_name, 15, '...') }}</td>
                                @can('view-publication')
                                    <td>
                                        <div class="actions">
                                            <a href="#" class="btn btn-sm bg-secondary-light border-dark mr-1"
                                                data-toggle="modal" data-target="#myModal-{{ $paper->id }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

<!-- Modal -->
@foreach ($papers as $paper)
    <div class="modal fade" id="myModal-{{ $paper->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModal-{{ $paper->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModal-{{ $paper->id }}Label">Paper Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <p><span class="text-success">Title: </span>{{ $paper->paper_title }}</p>
                        <p><span class="text-success">Published By:</span> {{ $paper->user->name }}</p>
                        <p><span class="text-success">Student ID:</span> {{ $paper->user->student_id }}</p>
                        <p><span class="text-success">Paper Area:</span> {{ $paper->category->category_name }}</p>
                        <p><span class="text-success">Type:</span> {{ $paper->publication_type }}</p>
                        <p><span class="text-success">Email:</span> {{ $paper->email }}</p>
                        <p><span class="text-success">DOI:</span> <a href="https://dx.doi.org/{{ $paper->doi }}"
                            target="blank">{{ $paper->doi }}</a></p>
                        <p><span class="text-success">Authors:</span> {{ $paper->author }}</p>
                        <p><span class="text-success">Abstract:</span> {{ $paper->abstract }}</p>
                       @if (isset($paper->image))
                       <p><img src="{{ asset('uploads/paper') }}/{{ $paper->image }}"
                        alt="Image"
                        class="img-fluid w-75 text-center" /></p>
                       @endif
                        <a href="{{ route('admin.usershowPDF', ['user_id' => $paper->user_id, 'filename' => $paper->file]) }}"
                            class="btn btn-sm bg-secondary-light border-dark mr-1" target="_blank">
                            Download
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'first_last_numbers',
            });
        });
    </script>
@endpush
