@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">


                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 mt-1">
                        <h6 class="card-title">Customer List</h6>
                    </div>
                    {{-- <h6 class="card-title">Brands</h6> --}}
                    {{-- <p class="text-muted mb-3">Description goes here...</p> --}}

                    <div style="margin-top: 10px;" class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th data-orderable="false">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>DOB</th>
                                    <th>Phone</th>
                                    <th>Status</th>
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
                ajax: "{{ route('users.index') }}",
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
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'thumbnail',
                        name: 'thumbnail'
                    },
                    {
                        data: 'date_of_birth',
                        name: 'date_of_birth'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 5,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    }, {
                        "targets": 7,
                        "className": "text-center",
                    },
                ],
            });
        });


    </script>
@endsection
