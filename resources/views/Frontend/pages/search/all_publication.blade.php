@extends('Frontend.layout.master')
@section('title')
    All Publications
@endsection
@push('user_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .modal-body p {
            max-width: 100%;
            /* Ensure text does not overflow horizontally */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            /* Allow text to wrap */
        }
    </style>
@endpush
@section('content')
    <main class="container-fluid pt-3">
        <div class="card px-5 bg-warning">
            <h5 class="text-white text-center">All publications of {{ $user->name }}</h5>
        </div>
        <div class="table-responsive text-nowrap my-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Publish Year</th>
                        <th>Paper Title</th>
                        <th>Paper Area</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($papers as $index => $paper)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $paper->created_at->format('Y') }}</td>
                            <td>{{ Str::limit($paper->paper_title, 50, '...') }}</td>
                            <td>{{ Str::limit($paper->category->category_name, 30, '...') }}</td>
                            <td>{{ $paper->publication_type }}</td>
                            <td>
                                <div class="actions">
                                    <a href="{{ route('home.search_details',['paper_id'=>$paper->id]) }}" class="btn btn-sm bg-secondary-light border-dark mr-1" >
                                        Defails
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
@push('user_script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'first_last_numbers',
            });
        });
    </script>
@endpush
