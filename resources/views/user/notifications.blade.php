@extends("layouts.user_overview")

@section("user_content")
<br>
<div class="user-content">
    <div class="row">
    <div class="container">
            <div class="list-group">
                 <div class="row">
                        <div class="col-sm-11">

                            <?php if($notificationcount == 0) : ?>
                            <div class="login-container">
                                <div class="login-form-div">
                                    <div class="list-group-item active">
                                        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                                 You Don't Have New Notification Yet
                                        </h4>
                                    </div>
                                    <div class="list-group-item">
                                        <p class="card-text"> We currently don't have any new notifications for you. Rest assured, we'll keep you informed as soon as there are updates or activities that require your attention. In the meantime, feel free to explore other features or settings on our platform. If you have any questions or need assistance, our support team is here to help. Thank you for using our services!</p>
                                    </div>
                                    <div class="list-group-item active">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <small class="text-muted"> <?php echo date("F d, Y", strtotime( now() )) ?></small>
                                            </div>
                                            <div class="col-sm-1">
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else : ?>
                         <?php

                            App\Helper\Helper::ReadNotification();
                            foreach($notifications as $key => $notification) : ?>

                            <br>

                            <div class="login-container">
                                <div class="login-form-div">
                                    <div class="list-group-item active">
                                        <h4 style="text-transform: uppercase" class="list-group-item-heading">
                                                 <?php echo $notification->title ?>
                                        </h4>
                                    </div>
                                    <div class="list-group-item">
                                        <p class="card-text"> <?php echo $notification->notification ?></p>
                                    </div>
                                    <div class="list-group-item active">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <small class="text-muted"> <?php echo date("F d, Y", strtotime($notification->created_at)) ?></small>
                                            </div>
                                            <div class="col-sm-1">
                                            <form method="POST" action="{{ route('delete_notification',["id" =>$notification->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">DELETE</button>
                                            </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                 </div>

                 <div class="text-center">
                    <?php echo $notifications->links('vendor.pagination.bootstrap-4'); ?>
         </div>
            </div>
        </div>
    </div>
</div>
@include('js.index')
@stop
