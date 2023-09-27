@extends('Backend.layout.master')
@section('title')
    Index Admin
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Index Admin',
        'main_page_name' => 'System Admin Settings',
        'sub_page_name' => 'Index Admin',
        'main_page_url' => route('systemadmin.index'),
    ])

    <div class="card-body">
        <div class="row">
            @can('create-admin')
            <div class="col-md-12 col-lg-12 col-sm-12 pb-3">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('systemadmin.create') }}" class="btn btn-primary me-4"><i class="fas fa-plus-circle"></i>
                        Add New
                        Admin</a>
                </div>
            </div>
            @endcan
            <div class="table-responsive text-nowrap my-3">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Last Updated</th>
                            <th>Admin Role</th>
                            <th>Admin Image</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            @can('edit-admin')
                            <th>Status</th>
                            @endcan
                            @if(
                            Auth::user()->haspermission('edit-admin')||
                            Auth::user()->haspermission('view-admin')||
                            Auth::user()->haspermission('delete-admin'))
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $index => $admin)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $admin->updated_at->format('d-M-Y') }}</td>
                                <td>{{ $admin->role->role_name }}</td>
                                <td><img src="{{ asset('uploads/user') }}/{{ $admin->image }}" alt="admin image"
                                        class="w-25 rounded-circle"></td>
                                <td>{{ Str::limit($admin->name, 25, '...') }}</td>
                                <td>{{ Str::limit($admin->email, 25, '...') }}</td>
                                @can('edit-admin')
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input class="custom-control-input toggle-class" type="checkbox"
                                            data-id="{{ $admin->id }}" id="admin-{{ $admin->id }}"
                                            {{ $admin->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="admin-{{ $admin->id }}"></label>
                                    </div>
                                </td>
                                @endcan
                                @if(Auth::user()->haspermission('edit-admin')||
                                Auth::user()->haspermission('view-admin')||
                                Auth::user()->haspermission('delete-admin'))

                                <td class="text-right">
                                    <div class="actions d-flex justify-content-start">
                                        @can('edit-admin')
                                        <a href="{{ route('systemadmin.edit', $admin->id) }}"
                                            class="btn btn-sm bg-success-light mr-1">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        @endcan
                                        @can('view-admin')
                                        <a href="{{ route('systemadmin.show', $admin->id) }}"
                                            class="btn btn-sm bg-secondary-light border-dark mr-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @endcan
                                        @can('delete-admin')
                                        <form action="{{ route('systemadmin.destroy', $admin->id) }}" method="POST"
                                            >
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


            $('.toggle-class').change(function() {
                var is_active = $(this).prop('checked') == true ? 1 : 0;
                var item_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/check/is_active/' + item_id,
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
