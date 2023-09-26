@extends('Backend.layout.master')
@section('title')
    Index User
@endsection
@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
    @include('Backend.layout.inc.breadcumb', [
        'page_name' => 'Index User',
        'sub_page_name' => 'Index User',
        'main_page_name' => 'User Managements',
        'main_page_url' => route('admin.userManagementIndex'),
    ])

    <div class="card-body">
        <div class="row">
            <div class="table-responsive text-nowrap my-3">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Created at</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Student ID</th>
                            <th>Department</th>
                            @can('edit-user')
                                <th>Status</th>
                            @endcan
                            @if (Auth::user()->haspermission('view-user-profile') || Auth::user()->haspermission('delete-user'))
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $user->created_at->format('d-M-Y') }}</td>
                                <td><img src="{{ asset('uploads/user') }}/{{ $user->image }}" alt="user image"
                                        class="w-25 rounded-circle"></td>
                                <td>{{ Str::limit($user->name, 20, '...') }}</td>
                                <td>{{ $user->student_id }}</td>
                                <td>{{ Str::limit($user->department->name, 10, '...') }}</td>
                                @can('edit-user')
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input toggle-class" type="checkbox"
                                                data-id="{{ $user->id }}" id="user-{{ $user->id }}"
                                                {{ $user->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="user-{{ $user->id }}"></label>
                                        </div>
                                    </td>
                                @endcan
                                @if (Auth::user()->haspermission('view-user-profile') || Auth::user()->haspermission('delete-user'))
                                    <td class="text-right">
                                        <div class="actions d-flex justify-content-end">
                                            @can('view-user-profile')
                                                <a href="{{ route('admin.userManagementView', ['id' => $user->id]) }}"
                                                    class="btn btn-sm bg-secondary-light border-dark mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('delete-user')
                                                <form action="{{ route('admin.userManagementDestroy', ['id' => $user->id]) }}"
                                                    method="POST">
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
