$(".load-downline").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-uri");
    console.log(url);
    addDownlines(url, $(this));
});

$(".load-messages").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-uri");
    console.log(url);
    addMessages(url, $(this));
});

$(".load-notification").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-uri");
    console.log(url);
    addNotifications(url, $(this));
});

$(".load-transaction").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-uri");
    console.log(url);
    addTransaction(url, $(this));
});

function addDownlines(url, jqObject) {
    var data = "ajaxSubmit=true";
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {
            jqObject.removeClass("hidden");
            $(".user-content .loading").addClass("hidden");
            if (response == "Error 403") {                
                $(".user-content .loading").addClass("hidden");
                window.location.href = loginUrl;
            } else {              
                $(".user-content .list-group table tbody").append(response);
                $(".user-content .load-downline").off("click");
                $(".user-content .load-downline").on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-uri");
                    addDownlines(url, $(this));
                });
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("hidden");
            $(".user-content .loading").addClass("hidden");
        }
    });
    jqObject.addClass("hidden");
    $(".user-content .loading").removeClass("hidden");
}

function addNotifications(url, jqObject) {
    var data = "ajaxSubmit=true";    
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {
            if (response == "Error 403") {
                jqObject.removeClass("hidden");
                $(".user-content .loading").addClass("hidden");
                window.location.href = loginUrl;
            } else {
                jqObject.remove();
                $(".user-content .loading").remove();                
                $(".user-content").append(response);
                $(".user-content .load-notification").off("click");
                $(".user-content .load-notification").on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-uri");
                    addNotifications(url, $(this));
                });
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("hidden");
            $(".user-content .loading").addClass("hidden");
        }
    });
    jqObject.addClass("hidden");
    $(".user-content .loading").removeClass("hidden");
}

function addMessages(url, jqObject) {
    var data = "ajaxSubmit=true";        
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {            
            if (response == "Error 403") {
                jqObject.removeClass("hidden");
                $(".user-content .loading").addClass("hidden");
                window.location.href = loginUrl;
            } else {
                jqObject.remove();
                $(".user-content .loading").remove();                
                $(".user-content .list-group").append(response);
                $(".user-content .load-messages").off("click");
                $(".user-content .load-messages").on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-uri");
                    addMessages(url, $(this));
                });
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("hidden");
            $(".user-content .loading").addClass("hidden");
        }
    });
    jqObject.addClass("hidden");
    $(".user-content .loading").removeClass("hidden");
}

function addTransaction(url, jqObject) {
    var data = "ajaxSubmit=true";
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {
            if (response == "Error 403") {
                jqObject.removeClass("hidden");
                $(".user-content .loading").addClass("hidden");
                window.location.href = loginUrl;
            } else {
                jqObject.remove();
                $(".user-content .loading").remove();
                $(".user-content table tbody").append(response);
                $(".user-content .load-transaction").off("click");
                $(".user-content .load-transaction").on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-uri");
                    addTransaction(url, $(this));
                });
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("hidden");
            $(".user-content .loading").addClass("hidden");
        }
    });
    jqObject.addClass("hidden");
    $(".user-content .loading").removeClass("hidden");
}

function addWithdrawal(url, jqObject) {
    var data = "ajaxSubmit=true";
    $.ajax({
        url: url,
        data: data,
        type: 'POST',
        success: function (response) {
            if (response == "Error 403") {
                jqObject.removeClass("hidden");
                $(".admin-content .loading").addClass("hidden");
                window.location.href = loginUrl;
            } else {
                jqObject.remove();
                $(".admin-content .loading").remove();
                $(".admin-content table tbody").append(response);
                $(".admin-content .load-withdrawal").off("click");
                $(".admin-content .load-withdrawal").on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-uri");
                    addTransaction(url, $(this));
                });
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("hidden");
            $(".admin-content .loading").addClass("hidden");
        }
    });
    jqObject.addClass("hidden");
    $(".admin-content .loading").removeClass("hidden");
}