@extends('admin.layouts.app')
@include('admin.layouts.dataTableStyle')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2>Role Management</h2>

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">User Management</li>
        </ol>
      </div>
    </div>
    <div class="pull-right">
      @can('role-create')
      <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
      @endcan
    </div>
  </div><!-- /.container-fluid -->
</section>






<!-- Main content -->
<section class="content">



  <div class="card">
    <div class="card-header">
      <h3 class="card-title">User Management List</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
             <th>Roles</th> 
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
        </tbody>

      </table>
     
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  </div>
  <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->
@endsection
@section('scripts')
@include('admin.layouts.dataTableScripts')
<script>
    $(function() {
    var table = $('.table-striped').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
           // {data: 'roles', name: 'roles'},
            {data: 'roles', name: 'roles', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        
    });

    // $("#example1").DataTable({
            // "responsive": true,
            // "lengthChange": false,
            // "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection