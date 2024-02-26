<?php

use App\Models\plan;

$firstName = "";
$lastName = "";
$userName = "";
$user = auth()->user();
$registrationFee = 0;
if ($user) {
    $userName = $user->userName;
    $firstName = $user->firstName;
    $lastName = $user->lastName;
    $planObj = plan::find($user->plan);
    if ($planObj) $registrationFee = $planObj->registrationFee;
}
?>
<div id="activationInfo" class="notification-dialog modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div style="background-color: #222; color: #fff; border: none; border-bottom: solid 1px #303030" class="modal-header">
                <button style="background: none; opacity: 0.8" type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span class="badge" style="background-color: #f8c300; color: #000;">&times;</span>
                </button>
                <h4>ACTIVATE YOUR ACCOUNT</h4>
            </div>
            <div style="background: #222; color: #fff; border: none" class="modal-body">
                <p>To complete your registration, you are required to pay the total sum of ₦{{number_format($registrationFee)}} to the bank details below.</p>
                <br>
                <p>Bank: Keystone Bank</p>
                <p>Account Name: Paulano Graceland Nigeria Limited</p>
                <p>Account Number: 1013163470.</p>
                <br>
                <p>Please send a text message containing your Username and the account name you made payment with or teller number if you made bank payment to 0915 160 1046.</p>                    
            </div>
            <div style="background: #222; color: #fff; border: none" class="modal-footer">
                <p><a data-dismiss="modal" class="btn btn-primary">OK</a> <button data-dismiss="modal" class="btn btn-danger">CANCEL</button></p>
            </div>
        </div>
    </div>
</div>