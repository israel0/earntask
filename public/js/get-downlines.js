$.ajax({
    url: getDownlineUrl,
    dataType: 'json',
    type: 'GET',
    success: function (response) {        
        var leftDownlines = response.left;
        var rightDownlines = response.right;
        var totalDownlines = response.total;
        $("#left-downlines").html(leftDownlines);
        $("#right-downlines").html(rightDownlines);
    },
    timeout: 120000, // Timeout after 6 seconds
    error: function (jqXHR, textStatus, errorThrown) {
        console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
        //show error message                    
        $("#left-downlines").html("<span class='fa fa-times-circle'></span>");
        $("#right-downlines").html("<span class='fa fa-times-circle'></span>");
    }
});