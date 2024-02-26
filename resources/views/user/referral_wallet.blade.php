@extends("layouts.user_overview")

@section("user_content")
    <div class="user-content">
        <div class="container">
        <div class="user-data row">
            <div class="login-container">
                <div class="login-form-div">
                      <nav>
                        <ul class="nav nav-tabs">
                            <li ><a href="{{ route("user_transactions") }}">Matrix Wallet</a></li>
                            <li><a  href="{{ route("stage_bonus_wallet")}}">Stage Bonus Wallet</a></li>
                            <li><a  href="{{ route("stepout_wallet")}}">StepOut Wallet</a></li>
                            <li><a  href="{{ route("group_bonus_wallet")}}">Group Bonus Wallet</a></li>
                            <li class="active"><a  href="{{ route("referral_wallet") }}">Referral Bonus Wallet</a></li>
                        </ul>
                      </nav>

                        <div class="tab-content">

                         
                            <div id="home" class="tab-pane fade in active">
                                <div class="user-main-container col-ms-12">
                                    <div class="list-group">
                                        <div class="list-group-item active">
                                            <div class="row">
                                                <div class="col-md-8">

                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" id="table-search" placeholder="Search...">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="list-heading list-group-item">
                                            <table class="table table-responsive">
                                                <thead>
                                                <tr>
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col" class="w-50">Comments</th>
                                                    <th scope="col">Credit</th>
                                                    <th scope="col">Debit</th>
                                                </tr>
                                                </thead>

                                                @if($referralWalletCount == 0)
                                                <tbody>
                                                </tbody>
                                                @else
                                                <tbody>
                                                    @foreach($referralWallets as $key => $referralWallet)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ date("F d, Y", strtotime($referralWallet->created_at)) }}</td>
                                                            <td style="width: 200px">{{ $referralWallet->comment }}</td>
                                                            <td> &#8358; {{ ($referralWallet->type == 2) ? $referralWallet->amount : 0 }} </td>
                                                            <td> &#8358;{{ $referralWallet->type == 1 ? $referralWallet->amount : 0}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                @endif

                                            </table>
                                        </div>

                                        <div class="text-center">
                                            {{ $referralWallets->links('vendor.pagination.bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Add other tab panes as needed -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('js.index')

@stop
