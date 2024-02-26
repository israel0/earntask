@extends("layouts.user_overview")

@section("user_content")
<div class="user-content">
    <div class="list-group">
        <div style="padding-bottom: 2px;" class="list-group-item active">
            <div class="genealogy-info">
                <table style="margin-bottom: 0; font-size: 0.8em;" class="table">
                    <tbody>
                        <tr>
                            <th class="<?php echo ($stage->stage_id == null || $stage->stage_id == 0) ? "active" : "" ?>">FEEDER</th>
                            <th class="<?php echo ($stage->stage_id == 1) ? "active" : "" ?>">STAGE 1</th>
                            <th class="<?php echo ($stage->stage_id == 2) ? "active" : "" ?>">STAGE 2</th>
                            <th class="<?php echo ($stage->stage_id == 3) ? "active" : "" ?>">STAGE 3</th>
                        </tr>
                        <tr>
                            <td>
                                <img style="display: inline-block" width="36" class="img-responsive img-rounded" src="<?php echo url("images/user0.png"); ?>">
                                <p><a href="<?php echo url("user/genealogy/0") ?>" class="btn btn-xs btn-primary">View</a></p>
                            </td>
                            <td>
                                <img style="display: inline-block" width="36" class="img-responsive img-rounded" src="<?php echo url("images/user1.png"); ?>">
                                <p><a href="<?php echo url("user/genealogy/1") ?>" class="btn btn-xs btn-primary">View</a></p>
                            </td>
                            <td>
                                <img style="display: inline-block" width="36" class="img-responsive img-rounded" src="<?php echo url("images/user2.png"); ?>">
                                <p><a href="<?php echo url("user/genealogy/2") ?>" class="btn btn-xs btn-primary">View</a></p>
                            </td>
                            <td>
                                <img style="display: inline-block" width="36" class="img-responsive img-rounded" src="<?php echo url("images/user3.png"); ?>">
                                <p><a href="<?php echo url("user/genealogy/3") ?>" class="btn btn-xs btn-primary">View</a></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="list-group-item">
            <div id="genealogy-content" class="genealogy-content">
            </div>
        </div>
    </div>
    <script>
        var emptyImageUrl = "<?php echo url("images/no_user.jpg") ?>";
        var userImageUrl = "<?php echo url("images/user.png") ?>";
        var genealogyString = '<?php echo json_encode($genealogyData) ?>';
        var json = JSON.parse(genealogyString);
        console.log(JSON.stringify(json));
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo url("js/jquery.orgchart.js") ?>"></script>
    <script>
        $('#genealogy-content').orgchart({
            'data': json,
            'pan': true,
            'zoom': true,
            'depth': <?php echo ($stage->stage_id == null || $stage->stage_id == 0) ? 3 : 3 ?>,
            //'nodeContent':'stage',
            'exportButton': true,
            'exportFilename': 'My Downlines',
            'createNode': function($node, data) {
                //id_arr = $("li").attr('id');
                var userType = data.data.userType;
                if (userType == -1) {
                    var img = data.data.image;
                    $node.children('.title').html('<img src="' + img + '" width="50%" height="50%">');
                } else {
                    var img = data.data.image;
                    var firstName = data.data.firstName;
                    var lastName = data.data.lastName;
                    var userName = data.name;
                    $node.children('.title').html('<p style="">' + firstName + ' ' + lastName + '</p><p style="">' + userName + '</p><img style="border-radius: 50%" src="' + img + '" width="50%" height="50%">');
                }
            }
        });
        if ($(window).width() < 1000) {
            $("#genealogy-content").width($("#genealogy-content").find(".orgchart table").width());
        }
    </script>
</div>
@stop