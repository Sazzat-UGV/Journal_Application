@extends('Backend.layout.master')
@section('title')
    Index Department
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Index Department',
        'main_page_name' => 'Departments',
        'sub_page_name' => 'Index Department',
        'main_page_url' => route('department.index'),
    ])

    <div class="card-body">
        <div class="row">
            @can('create-department')
                <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('department.create') }}" class="btn btn-primary me-4"><i class="fas fa-plus-circle"></i>
                            Add New
                            Department</a>
                    </div>
                </div>
            @endcan
            <div class="table-responsive text-nowrap my-3">
                <table class="table table-hover">
                    <thead>
                        <tr class=" text-center">
                            <th>#</th>
                            <th>Last Updated</th>
                            <th>Name</th>
                            <th>Full Name</th>
                            @can('edit-department')
                                <th>Status</th>
                            @endcan
                            @if (Auth::user()->haspermission('edit-department') || Auth::user()->haspermission('delete-department'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($departments as $index=>$department)
                            <tr>
                                <td><strong>{{ $index + 1 }}</strong></td>
                                <td>{{ $department->updated_at->format('d-M-Y') }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ Str::limit($department->full_name, 30, '...') }}</td>
                                @can('edit-department')
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input toggle-class" type="checkbox"
                                                data-id="{{ $department->id }}" id="department-{{ $department->id }}"
                                                {{ $department->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="department-{{ $department->id }}"></label>
                                        </div>
                                    </td>
                                @endcan
                                @can('edit-department')
                                    <td class="text-right">
                                        <div class="actions">
                                            <a href="{{ route('department.edit', $department->id) }}"
                                                class="btn btn-sm bg-success-light mr-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </td>
                                @endcan
                                @can('delete-department')
                                    <td>
                                        <form action="{{ route('department.destroy', $department->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class=" btn btn-sm bg-danger-light show_confirm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endcan
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


            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/department/is_active/' + item_id,
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Status Updated!',
                            'Click ok button!',
                            'success'
                        )
                    },
                    errro: function(err) {
                        if (err) {
                            console.log(err);
                        }
                    }
                });
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
