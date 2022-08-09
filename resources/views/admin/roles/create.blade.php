@extends('admin.layouts.app')


@section('content')


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title  mb-3">Role Form</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                            </div>
                        </div>
                        <label for="permissions" class="form-label">Permissions</label>
                        <br />

                        @foreach ($permission as $value)
                            <div class="col-sm-6 col-md-4 col-lg-3">

                                <div class="form-check mb-2">
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'form-check-input']) }}
                                        {{ $value->display_name }}</label>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <input class="btn btn-primary mt-3" type="submit" value="Submit">

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>
@endsection
