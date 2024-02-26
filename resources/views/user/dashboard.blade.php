@extends("layouts.user_overview")

@section("user_content")
<div class="user-content">

    @if($errors->any())
    <div style="margin-bottom: 1rem;" class="label label-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('error'))
    <div style="margin-bottom: 1rem;" class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div style="margin-bottom: 1rem;" class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif



    <div class="user-data row">
        <div class="col-sm-6 col-lg-3">
            <div class="user-box">

                <?php
                    use App\Models\User;
                    if($plan->id == 4) : ?>
                <div class="inner">
                    <h3><?php
                        echo strtoupper("Tier 3") ?></h3>
                    <p><?php echo strtoupper($plan->name) ?> Plan</p>
                </div>
                <?php elseif($plan->id == 3) : ?>
                <div class="inner">
                    <h3><?php
                        echo strtoupper("Tier 2") ?></h3>
                    <p><?php echo strtoupper($plan->name) ?> Plan</p>
                </div>
                <?php elseif($plan->id == 2) : ?>
                <div class="inner">
                    <h3><?php
                        echo strtoupper("Tier 1") ?></h3>
                    <p><?php echo strtoupper($plan->name) ?> Plan</p>
                </div>
                <?php else : ?>
                    <div class="inner">
                        <h3><?php
                            echo strtoupper("Starter") ?></h3>
                        <p><?php echo strtoupper($plan->name) ?> Plan</p>
                    </div>
                <?php endif; ?>


                <a class="small-box-footer" href="<?php echo url("user/plan") ?>">
                      My Current Plan
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="user-box">
                <div class="inner">
                    <h3>₦<?php echo number_format($wallet->referralWallet, 2) ?></h3>
                    <p>Referral Bonus Wallet</p>
                </div>
                <a class="small-box-footer" href="<?php echo url("user/transactions") ?>">
                    More Info
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="user-box">
                <div class="inner">
                    <h3>₦<?php echo number_format($wallet->resaleWallet, 2) ?></h3>
                    <p>Level Bonus Wallet</p>
                </div>
                <a class="small-box-footer" href="<?php echo url("user/transactions") ?>">
                    More Info
                </a>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">

    </div>

    <div class="row">
        <div class="user-side-container col-sm-4">
            <div class="user-side-content">
                <div class="user-image-div">
                    <?php
                    $photoUrl = asset('storage/' . $user->photoUrl);

                    $changeUrl = asset("user/settings/change_picture");

                    if (!$photoUrl || strlen($photoUrl) == 0) {
                        echo "<a class='center-block' style='background-color: #f8c300; color: #000; text-align: center;' href='$changeUrl' ><span style='font-size: 60px; line-height: 25px multiple'><span class='fa fa-user-plus'></span></span><br><span>Add Photo</span></a>";
                    } else {
                        echo "<a href='$changeUrl'><img width='130px' height='130px' class='center-block' src='$photoUrl'></a>";
                    }
                    ?>
                </div>
                <div class="user-name-div">
                    <h3><?php echo strtoupper("$user->firstName $user->lastName")
                        ?></h3>
                    <p>

                    </p>
                </div>
                <div class="user-info-div">
                    <div class="user-info">
                        <p class="pull-left"><span class="fa fa-user"></span> Member Since</p>
                        <p class="pull-right"><?php echo date("F d, Y", strtotime($user->userEntranceDate)) ?></p>
                        <div class="clearfix"></div>
                    </div>
                    <div class="user-info">
                        <p class="pull-left"><span class="fa fa-users"></span> My Referrals</p>
                        <p class="pull-right"><?php echo number_format($referralcount);
                                                ?></p>
                        <div class="clearfix"></div>
                    </div>
                  
                    <div class="user-info">
                        <p class="pull-left"><span class="fa fa-users"></span> Total Balance</p>
                        <p class="pull-right">₦<?php echo number_format($wallet->getBackOfficeBalance(), 2)
                                                ?></p>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="upgrade-div">
                <div class="upgrade-heading">
                    <h4>referral Info.</h4>
                </div>
                @if($referral)
                <div class="upgrade-content">
                    <div class="upgrade-para">
                        <div class="col-xs-5">
                            <p>referral:</p>
                        </div>
                        <div class="col-xs-7">
                            <p><?php echo ucfirst($referral->firstName) . " " . ucfirst($referral->lastName)
                                ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="upgrade-para">
                        <div class="col-xs-5">
                            <p>Phone:</p>
                        </div>
                        <div class="col-xs-7">
                            <p><?php echo $referral->phoneNumber
                                ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="upgrade-para">
                        <div class="col-xs-5">
                            <p>Email:</p>
                        </div>
                        <div class="col-xs-7">
                            <p><?php echo $referral->email
                                ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @endif
            </div>
            <div class="upgrade-div">
                <div style="padding: 10px" class="upgrade-content">
                    <div class="upgrade-para">
                        <a href="<?php echo url("help") ?>" class="btn btn-primary btn-block"><span class="fa fa-envelope"></span> CONTACT SUPPORT</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="user-main-container col-sm-8">
            <div class="list-group">
                <div class="list-group-item active">
                    <h4 style="text-transform: uppercase" class="list-group-item-heading">
                        REFER YOUR FRIENDS
                    </h4>
                </div>
                <div class="list-group-item">
                    <div class="referral-code">
                        <p style="margin-bottom: 10px; font-size: 1em;">Share this referral link and earn a referral bonus when anybody registers with your referral link</p>
                        <div class="referral-code-div">
                            <form class="spec">
                                <div class="input-group">
                                    <input id="referralField" readonly="" value="<?php echo strtolower($user->pageUrl)
                                                                                    ?>" type="text" class="form-control">
                                    <span class="input-group-btn"><button type="submit" id="copyBtn" class="btn btn-primary">
                                            Copy
                                        </button></span>
                                </div>
                            </form>
                        </div>
                        <div class="btn-group">
                            <a target="_blank" href="<?php echo App\Helper\Helper::referralUrl($user->userName)
                                                        ?>" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo strtolower($user->pageUrl)
                                                                                                    ?>" class="btn btn-twitter"><span class="fa fa-twitter"></span></a>
                            <a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo strtolower($user->pageUrl)
                                                                                            ?>" class="btn btn-instagram"><span class="fa fa-instagram"></span></a>
                            <a target="_blank" href="https://plus.google.com/share?url=<?php echo strtolower($user->pageUrl)
                                                                                        ?>" class="btn btn-google"><span class="fa fa-google-plus"></span></a>
                            <a target="_blank" href="whatsapp://send?text=Use%20MY%20Referral%20Code%20to%20Register%20On%20Paulona%20Websitelink:%20<?php echo strtolower($user->pageUrl)
                                                                                                                                                        ?>" class="btn btn-whatsapp"><span class="fa fa-whatsapp"></span></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="list-group">
                <div class="list-group-item active">
                    <h4 style="text-transform: uppercase" class="list-group-item-heading">
                        MY REFERRALS (<?php echo $referralcount; ?>)
                    </h4>
                </div>


                <div class="list-heading list-group-item <?php echo ($referralcount == 0) ? 'hidden' : ''; ?>">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Username</th>
                                <th>Phone No.</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <?php if ($referralcount == 0) : ?>
                            <tbody>
                                <tr>
                                    No Referal Record Yet
                                </tr>
                                <!-- Your empty table rows here -->
                            </tbody>
                        <?php else : ?>
                            <tbody>
                                <?php foreach ($referrals as $key => $referral) : ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?>.</td>
                                        <td><?php echo $referral->userName ?></td>
                                        <td><?php echo $referral->phoneNumber ?></td>
                                        <td><?php echo ($referral->status == User::$USER_PENDING) ? '<p class="label label-warning">Pending</p>' : '<p class="label label-success">Activated</p>'; ?></td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        <?php endif; ?>
                    </table>
                    <div class="text-center">
                        <a href={{route("user_referrals")}} class="btn btn-primary">
                            All Referrals
                        </a>
                    </div>
                </div>





            </div>

            <div class="list-group">
                <div class="list-group-item active">
                    <h4 style="text-transform: uppercase" class="list-group-item-heading">
                        WRITE A REVIEW
                    </h4>
                </div>
                <div class="list-group-item">
                    <p style="font-size: 1em">Tell us what you think about Paulano Graceland so we can know how to serve you better.</p>
                    <form action="{{ route("update_review") }}" method="post" class="login-form spec" style="padding-top: 1em" role="form">
                        @csrf
                        <div class="col-sm-2">
                            <label for="reviewField" class="control-label">Enter Your Review</label>
                        </div>
                        <div class="col-sm-7">
                            <div style="width: 100%" class="input-group">
                                <textarea name="review" id="reviewField" class="form-control" rows="4"></textarea>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <input type="submit" value="SUBMIT REVIEW" class="btn btn-primary">
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
