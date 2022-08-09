@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 mt-1">
                        <h6 class="card-title">Role List</h6>
                        {{-- @can('role-create') --}}
                            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm btn-icon-text float-right"><i
                                    class="btn-icon-prepend" data-feather="plus"></i>Add Role</a>
                        {{-- @endcan --}}
                    </div>
                    {{-- <h6 class="card-title">Brands</h6> --}}
                    {{-- <p class="text-muted mb-3">Description goes here...</p> --}}

                    <div style="margin-top: 10px;" class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Show</a>
                    @can('role-edit')
                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                    @endcan
                    @can('role-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>


    {!! $roles->render() !!}


    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
@endsection



@section('scripts')
    <script type="text/javascript">
        var table = "";

        $(function() {

            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                autoWidth: false,
                ajax: "{{ route('roles.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                        "targets": 1,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                ],
            });
        });

        //code to change status
        function deleteItem(id) {

            Swal.fire({
                title: 'Do you want to delete the role?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (result.value == true) {
                    var url = "{{ route('roles.delete') }}";

                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            'id': id
                        },
                        cache: false,
                        success: function(data) {
                            toastr.success(data.message);
                            table.ajax.reload();
                        },
                        error: function(error) {
                            toastr.error(error.responseJSON.message);
                            console.log(error.responseJSON.message);
                        }
                    });

                }
            });
        }
    </script>
@endsection
