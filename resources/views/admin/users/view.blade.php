@extends('admin.layouts.app')


@section('content')
    <div id="app">
        <div class="row">
            <!-- left wrapper start -->
            <div class="col-md-12 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 mt-1">
                            <h6 class="card-title">Customer Details</h6>
                        </div>

                        <div class="row">

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" style="height: 50px; width: 50px;"
                                        src="{{ asset("$user->profile_image_url") }}" alt="profile">
                                    <div class="ms-2">
                                        <span class="h4 ms-1 text-dark">{{ $user->name }}</span>
                                        <p class="tx-11 ms-1 text-muted">Member since:
                                            {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>


                            <div>

                            </div>

                            <div class="mt-4 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                                <p class="text-muted">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                                <p class="text-muted">{{ $user->phone_number }}</p>
                            </div>

                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Date of Birth:</label>
                                <p class="text-muted">
                                    {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d F Y') }}</p>
                            </div>

                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Membership:</label>
                                <p class="text-muted">
                                    @if ($user->membership == 'vip')
                                        <span class="badge rounded-pill bg-primary">VIP</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">Normal</span>
                                    @endif
                                </p>

                            </div>



                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">License Number:</label>
                                <p class="text-muted">{{ $user->license_number ?? '---' }}</p>
                            </div>

                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">License Verification Status:</label>
                                <p class="text-muted">
                                    @if ($user->license_verification_status == 'rejected')
                                        <span class="badge rounded-pill bg-danger">Rejected</span>
                                    @elseif ($user->license_verification_status == 'verified')
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @elseif ($user->license_verification_status == 'pending')
                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                    @else
                                        ---
                                    @endif
                                </p>
                            </div>

                            <div class="mt-3 col-lg-4">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Account Status:</label>
                                <p class="text-muted">
                                    @if ($user->status == 'active')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="mt-3">
                                <label class="tx-11 fw-bolder mb-0 text-uppercase">Actions:</label>
                                <p class="text-muted">



                                    @if ($user->status == 'active')
                                        <a href="{{ route('users.status', ['id' => $user->id, 'status' => 'inactive']) }}"
                                            class="btn btn-danger btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                            Inactive
                                        </a>
                                    @endif

                                    @if ($user->status == 'inactive')
                                        <a href="{{ route('users.status', ['id' => $user->id, 'status' => 'active']) }}"
                                            class="btn btn-success btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                            Active
                                        </a>
                                    @endif



                                    @if ($user->membership == 'vip')
                                        <a href="{{ route('users.membership', ['id' => $user->id, 'membership' => 'normal']) }}"
                                            class="btn btn-secondary btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                            Mark as Normal User
                                        </a>
                                    @endif

                                    @if ($user->membership == 'normal')
                                        <a href="{{ route('users.membership', ['id' => $user->id, 'membership' => 'vip']) }}"
                                            class="btn btn-secondary btn-icon-text">
                                            <i class="btn-icon-prepend" data-feather="edit"></i>
                                            Mark as VIP User
                                        </a>
                                    @endif


                                </p>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
        </div>

    </div>
@endsection

<script type="text/javascript">
    //code to change status
    function changeStatus(changeTo) {

        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
        }).then((result) => {

            if (result.value == true) {
                var url = "{{ route('booking.status') }}";
                var id = "{{ $user->id }}";
                console.log("approve: " + id);

                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        'id': id,
                        'changeto': changeTo
                    },
                    cache: false,
                    success: function(data) {
                        toastr.success(data.message);
                        window.location.reload();
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                        console.log(error.responseJSON.message);
                    }
                });

            }
        });
    }

    function reject(changeTo) {

        Swal.fire({
            title: 'Do you want to reject?',
            icon: 'warning',
            text: 'Please provide a reason for rejection. It will show to the user.',
            showCancelButton: true,
            confirmButtonText: 'Reject',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showLoaderOnConfirm: true,
            preConfirm: (notes) => {
                var id = "{{ $user->id }}";
                console.log("Reject: " + id);
                var url = "{{ route('booking.status') }}";

                return fetch(`${url}?id=${id}&notes=${notes}&changeto=${changeTo}`)
                    .then(async response => {

                        var str = await response.text();
                        var data = JSON.parse(str);

                        if (!response.ok) {
                            throw data.message;
                        }

                        toastr.success(data.message);
                        window.location.reload();
                        return data;
                    })
                    .catch(error => {
                        toastr.error(error);
                        Swal.showValidationMessage(
                            `Request failed: ${error}`
                        )
                    })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {

        });
    }
</script>
