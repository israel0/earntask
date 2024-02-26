@extends("layouts.user_overview")

@section("user_content")
    <br>
    <div class="user-content">
        <div class="row">
            <div class="container">
                <div class="col-ms-12">
                    <div class="login-container">
                        <div class="login-form-div">
                            <div class="list-group">
                                <div class="list-group-item active">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                                MY REFERRALS ({{ $referralcount }})
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="table-search" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>

                                <div class="list-heading list-group-item">
                                    <table class="table table-responsive" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Username</th>
                                                <th>Phone No.</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($referralcount > 0)
                                                @foreach($referrals as $key => $referral)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $referral->userName }}</td>
                                                        <td>{{ $referral->phoneNumber }}</td>
                                                        <td>{!! ($referral->status == App\Models\User::$USER_PENDING) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Activated</p>' !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <div class="text-center">
                                    {{ $referrals->links('vendor.pagination.bootstrap-4') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- 
    <script>
        $(document).ready(function() {
            var dataTable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("search-referral-data") }}',
                    data: function (d) {
                        d.username = $('#table-search').val();
                    }
                },
                columns: [
                    { data: 'userName', name: 'userName' },
                    { data: 'phoneNumber', name: 'phoneNumber' },
                    { data: 'status', name: 'status' },
                ]
            });

            $('#table-search').on('input', function () {
                dataTable.ajax.reload();
            });
        });
    </script> --}}

    @include('js.index')
@stop
