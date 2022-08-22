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
      <h3 class="card-title">Role Management List</h3>
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
        @foreach ($data as $key => $user)
          <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
      @foreach($user->getRoleNames() as $v)
      <label class="badge badge-success">{{ $v }}</label>
      @endforeach
      @endif
    </td>
    <td>
                            <div class="btn-group">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">Action
                                    </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="{{ route('users.show',$user->id) }}"><i class="fa fa-fw fa-eye mr-2"></i>View</a>
                                        <hr>
                                        <?php /* 
                                        @can('user-edit')
                                        */?>
                                        <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}"> <i class="fa fa-fw fa-edit mr-2"></i>Edit</a>
                                        <hr>
                                        <?php /* 
                                        @endcan
                                        @can('user-delete')
                                        */?>
                                        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                        <i class="fa fa-fw fa-trash ml-3"></i>
                                        {!! Form::submit('Delete', ['class' => 'btn btn-dangers']) !!}
                                        {!! Form::close() !!}
                                        <?php /*
                                        @endcan
                                        */?>
                                    </div>
                                </div>
                            </div>
                        </td>
  
  </tr>
          @endforeach
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
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection