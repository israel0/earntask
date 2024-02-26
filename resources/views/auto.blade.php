@extends("layouts.auth_overview")

@section("auth_content")
<div class="login-content content background">
    <div class="main-container container">
        <div class="col-sm-offset-3 col-sm-6">
            <div id="result-content"></div>
        </div>
    </div>
</div>
<script>
    var start = <?php echo $start ?>;
    var limit = <?php echo $limit ?>;
    var limitCount = 0;
    referralName = "akinsola";
    autoRegister(referralName);

    function autoRegister(referralName) {
        var csrf_token = "{{csrf_token()}}"
        var url = "http://127.0.0.1:8000/auto_reg/" + referralName + "/" + start;
        console.log(url);
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                "X-CSRF-Token": csrf_token,
            },
            success: function(response) {
                $("#result-content").append("<p style='padding: 1em; margin-bottom: 0.5em; background-color: #12326b; color: #fff'>" + response + "</p>");
                limitCount++;
                if (limitCount < limit) {
                    start++;
                    autoRegister(referralName);
                } else {
                    $("#result-content").append("<p style='padding: 1em; margin-bottom: 0.5em; background-color: #f00; color: #fff'>Finished with " + referralName + "</p>");
                }
            },
            timeout: 1200000, // Timeout after 6 seconds
            error: function(jqXHR, textStatus, errorThrown) {
                alert("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
                //show error message
            }
        });
    }
</script>
@stop
