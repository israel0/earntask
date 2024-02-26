@extends("layouts.user_overview")
@section("user_content")
<div class="user-content">
    <div class="container">
        <div class="user-data row">
            <div class="login-container">
                <div class="login-form-div">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">Bank Transfer</a></li>
                    </ul>

                    <div class="tab-content">

                        <div id="home" class="tab-pane fade in active">
                            <div class="user-main-container col-ms-12">
                                <div class="list-group">

                                    <div class="list-group-item active">
                                        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                            Withdraw Via Bank Transfer
                                        </h4>
                                    </div>

                                    <div class="list-group-item">
                                        <form action="{{ route('make_withdraw')}}" method="post">
                                            @csrf
                                            @if(session('error'))
                                            <div style="margin-bottom: 1rem;" class="label label-danger">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                            @if(session('success'))
                                            <div style="margin-bottom: 1rem;" class="label label-success">
                                                {{ session('success') }}
                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="genderField" class="control-label">Choose Wallet </label>
                                                    <select value="{{old('wallet')}}" name="wallet" class="form-control" data-style="btn btn-primary" title="Withdraw From" id="withdrawTo">
                                                        @foreach($wallets as $wallet)
                                                        <option {{old("wallet") == $wallet['value'] ? 'selected' : ''}} value="{{ $wallet["value"] }}"> {{ $wallet['name'] ." (NGN ". number_format($wallet["amount"]).")"}} </option>
                                                        @endforeach
                                                    </select>
                                                    <div>
                                                        @error('wallet')
                                                        <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="emailField" class="control-label">Withdrawal Amount</label>
                                                    <div class="input-group">
                                                        <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                                <span class="glyphicon glyphicon-dollar"></span>
                                                            </a></span>
                                                        <input name="amount" type="text" id="amount" class="form-control" placeholder="Input Withdrawal Amount" value="{{old('amount')}}">
                                                        <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                                    </div>
                                                    <div>
                                                        @error('amount')
                                                        <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>



                                            <br>


                                            <div class="list-group-item active">
                                                <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                                    BANK INFORMATION
                                                </h4>
                                            </div>
                                            <div class="list-group-item">

                                                <div class="row">
                                                    <div class="form-group has-feedback">
                                                        <div class="col-sm-4">
                                                            <label for="firstNameField" class="control-label">Bank Name</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                                        <span class="fa fa-bank"></span>
                                                                    </a></span>
                                                                <input value="{{ !empty(old('bankName')) ? old('bankName') : $user->bankName}}" name="bankName" type="text" id="bankNameField" class="form-control" placeholder="">
                                                                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                                            </div>
                                                            <div>
                                                                @error('bankName')
                                                                <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4">
                                                            <label for="lastNameField" class="control-label">Account Name</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                                        <span class="fa fa-bank"></span>
                                                                    </a></span>
                                                                <input value="{{ !empty(old('bankAccountName')) ? old('bankAccountName') : $user->bankAccountName}}" name="bankAccountName" type="text" id="bankAccountNameField" class="form-control" placeholder="">
                                                                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                                            </div>
                                                            <div>
                                                                @error('bankAccountName')
                                                                <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <label for="lastNameField" class="control-label">Account Number</label>
                                                            <div class="input-group">
                                                                <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                                        <span class="fa fa-bank"></span>
                                                                    </a></span>
                                                                <input value="{{ !empty(old('bankAccountNumber')) ? old('bankAccountNumber') : $user->bankAccountNumber}}" name="bankAccountNumber" type="text" id="bankAccountNumberField" class="form-control" placeholder="">
                                                                <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                                            </div>
                                                            <div>
                                                                @error('bankAccountNumber')
                                                                <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <br>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label for="pin" class="control-label">Transaction Pin</label>
                                                        <div class="input-group">
                                                            <span class="input-group-btn"><a type="button" class="btn btn-primary">
                                                                    <span class="fa fa-lock"></span>
                                                                </a></span>
                                                            <input name="pin" type="password" id="pin" class="form-control" placeholder="">
                                                            <span class="form-control-feedback glyphicon" aria-hidden="true"></span>
                                                        </div>
                                                        <div>
                                                            @error('pin')
                                                            <div style="font-size: 10px" class="label label-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div> -->
                                                <br>
                                                <div class="row">
                                                    <div>
                                                        <div style="margin-bottom: 0" class="form-group">
                                                            <div class="flex">
                                                                <input type="submit" value="WITHDRAW" class="btn btn-primary">
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                        <br> <br> <br>
                                        <div class="user-main-container col-ms-12">
                                            <div class="list-group">

                                                <div class="list-group-item active">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                                                MY WITHDRAWALS (<?php

                                                                                use App\Models\Transaction;

                                                                                echo $withdrawalcount;  ?>)
                                                            </h4>
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
                                                                <th>S/N</th>
                                                                <th>Date Withdrawn</th>
                                                                <th>Amount</th>
                                                                <th>Withdrawn From:</th>
                                                                <th>Bank Name</th>
                                                                <th>Bank Account Name</th>
                                                                <th>Bank Account Number</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>

                                                            <?php foreach ($withdrawals as $key => $withdrawal) {
                                                                switch ($withdrawal->wallet) {
                                                                    case Transaction::$REFERRAL_WALLET:
                                                                        $walletStr = "Referral Wallet";
                                                                        break;
                                                                    case Transaction::$MATRIX_WALLET:
                                                                        $walletStr = "Matrix Wallet";
                                                                        break;
                                                                    case Transaction::$STAGE_BONUS_WALLET:
                                                                        $walletStr = "Stage Bonus Wallet";
                                                                        break;
                                                                    case Transaction::$STEP_OUT_WALLET:
                                                                        $walletStr = "Stepout Wallet";
                                                                        break;
                                                                    case Transaction::$GROUP_BONUS_WALLET:
                                                                        $walletStr = "Group Bonus Wallet";
                                                                        break;
                                                                    default:
                                                                        $walletStr = "N/A";
                                                                }
                                                            ?>
                                                                <tr>
                                                                    <td> <?php echo $key + 1; ?> </td>
                                                                    <td>{{ ($withdrawal->updated_at != null || !empty($withdrawal->updated_at)) ? date("F d, Y", strtolower(strtotime($withdrawal->updated_at))) : "Not Withdrawn Yet" }}</td>
                                                                    <td style="width: 200px"> &#8358; {{ $withdrawal->amount }}</td>
                                                                    <td><?php echo $walletStr ?></td>
                                                                    <td> {{ $withdrawal->bankName }} </td>
                                                                    <td> {{ $withdrawal->bankAccountName }} </td>
                                                                    <td> {{ $withdrawal->bankAccountNumber }} </td>
                                                                    <td> <?php echo ($withdrawal->withdrawalStatus == App\Models\Withdrawal::$WITHDRAW_AVAILABLE) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Paid</p>' ?></td>
                                                                </tr>
                                                            <?php } ?>

                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="text-center">
                                                    <?php echo $withdrawals->links('vendor.pagination.bootstrap-4'); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('js.index')
@stop