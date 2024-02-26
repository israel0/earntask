@extends("layouts.admin_overview")

@section("user_content")
<div class="user-content">
    <div class="container">
        <div class="user-data row">
            <div class="login-container">
                <div class="login-form-div">
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
                                        <form method="get" action="" class="" role="form">
                                            <input value="<?php echo (isset($username)) ? "$username" : "" ?>" name="username" type="text" class="form-control" id="table-search" placeholder="Search...">
                                        </form>
                                    </div>
                                </div>
                            </div>


                            <div class="list-heading list-group-item">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Username</th>
                                            <th>Date Withdrawn</th>
                                            <th>Amount</th>
                                            <th>Withdrawn From</th>
                                            <th>Bank Name</th>
                                            <th>Bank Account Name</th>
                                            <th>Bank Account Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($withdrawals as $key => $withdrawal) {
                                            $processUrl = url("admin/process_withdrawal/$withdrawal->id");
                                            $amount = number_format($withdrawal->amount);
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
                                                <td> <?php echo $key + 1; ?>.</td>
                                                <td> {{ $withdrawal->userName }} </td>
                                                <td>{{ date("F d, Y", strtotime($withdrawal->created_at)) }}</td>
                                                <td> &#8358; {{ number_format($withdrawal->amount) }}</td>
                                                <td><?php echo $walletStr ?></td>
                                                <td> {{ $withdrawal->bankName }} </td>
                                                <td> {{ $withdrawal->bankAccountName }} </td>
                                                <td> {{ $withdrawal->bankAccountNumber }} </td>
                                                <td> <?php echo ($withdrawal->withdrawalStatus == App\Models\Withdrawal::$WITHDRAW_AVAILABLE) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Paid</p>' ?></td>
                                                <td> <?php echo ($withdrawal->withdrawalStatus == App\Models\Withdrawal::$WITHDRAW_AVAILABLE) ? "<a data-username='$withdrawal->userName' data-amount='$amount' class='activateBtn btn btn-primary' href='$processUrl'>Process</a>" : '' ?></td>
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
<script>
    var activateBtn = $(".activateBtn");
    activateBtn.on("click", function(e) {
        var userName = $(this).attr("data-username");
        var amount = $(this).attr("data-amount");
        var result = confirm(`Are you sure you want to process this withdrawal of ₦${amount} made by ${userName}?`);
        if (!result) {
            e.preventDefault();
            return false;
        }
    });
</script>
@stop