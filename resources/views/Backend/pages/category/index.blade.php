@extends('Backend.layout.master')
@section('title')
    Index Category
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Index Category',
        'main_page_name' => 'Categories',
        'sub_page_name' => 'Index Category',
        'main_page_url' => route('category.index'),
    ])

    <div class="card-body">
        <div class="row">
            @can('create-category')
                <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('category.create') }}" class="btn btn-primary me-4"><i class="fas fa-plus-circle"></i>
                            Add New
                            Category</a>
                    </div>
                </div>
            @endcan
            <div class="table-responsive text-nowrap my-3">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr class=" text-center">
                            <th>#</th>
                            <th>Created at</th>
                            <th>Category Name</th>
                            @if (Auth::user()->haspermission('edit-category') || Auth::user()->haspermission('delete-category'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($categories as $index=>$category)
                            <tr>
                                <td><strong>{{ $index + 1 }}</strong></td>
                                <td>{{ $category->created_at->format('d-M-Y') }}</td>
                                <td>{{ $category->category_name }}</td>

                                @if (Auth::user()->haspermission('edit-category') || Auth::user()->haspermission('delete-category'))
                                    <td class="text-right">
                                        <div class="actions d-flex justify-content-start">
                                            @can('edit-category')
                                                <div class="actions">
                                                    <a href="{{ route('category.edit', $category->id) }}"
                                                        class="btn btn-sm bg-success-light mr-1">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                </div>
                                            @endcan
                                            @can('delete-category')
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" btn btn-sm bg-danger-light show_confirm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@push('admin_script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                pagingType: 'first_last_numbers',
            });

            $('.show_confirm').click(function(event) {
                let form = $(this).closest('form');
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })



        });
    </script>
@endpush
