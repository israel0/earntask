$(".buyBtn").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-uri");
    addToCart(url, $(this));
});

$(".saveBtn").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-save");
    saveProduct(url, $(this));
});

$(".unSaveBtn").on("click", function (e) {
    e.preventDefault();
    var url = $(this).attr("data-unsave");
    unSaveProduct(url, $(this));
});

function addToCart(url, jqObject) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response) {
            jqObject.removeClass("disabled");
            if (response.error == 1) {
                return;
            }
            if (response.total > 0) {
                $("#cartInfo").removeClass("hidden");
                $("#cartInfo").html(response.total);
            }
            var title = jqObject.attr("data-name");
            $("#cartTitle").html("<b>" + title + "</b> has been added to your cart successfully. <br> Total Quantities: " + response.quantities);
            $("#cartNotification").modal();
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("disabled");
        }
    });
    jqObject.addClass("disabled");
}

function saveProduct(url, jqObject) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response) {
            jqObject.removeClass("disabled");
            if (!response.login) {
                window.location.href = loginUrl;
            }
            if (response.error == 1) {
                return;
            }
            if (response.total > 0) {
                $("#savedInfo").removeClass("hidden");
                $("#savedInfo").html(response.total);
            }
            if (response.success == 1) {
                jqObject.removeClass("btn-primary");
                jqObject.addClass("btn-danger");
                jqObject.find(".saveText").html("UNSAVE");
                jqObject.removeClass("saveBtn");
                jqObject.addClass("unSaveBtn");
                jqObject.off("click");
                jqObject.on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-unsave");
                    unSaveProduct(url, jqObject);
                });
            }

        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("disabled");
        }
    });
    jqObject.addClass("disabled");
}

function unSaveProduct(url, jqObject) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        success: function (response) {
            jqObject.removeClass("disabled");
            if (!response.login) {
                window.location.href = loginUrl;
            }
            if (response.error == 1) {
                return;
            }
            if (response.total > 0) {
                $("#savedInfo").removeClass("hidden");
                $("#savedInfo").html(response.total);
            } else {
                $("#savedInfo").addClass("hidden");
                $("#savedInfo").html(response.total);
            }
            if (response.success == 1) {
                jqObject.removeClass("btn-danger");
                jqObject.addClass("btn-primary");
                jqObject.find(".saveText").html("SAVE");
                jqObject.removeClass("unSaveBtn");
                jqObject.addClass("saveBtn");
                jqObject.off("click");
                jqObject.on("click", function (e) {
                    e.preventDefault();
                    var url = $(this).attr("data-save");
                    saveProduct(url, jqObject);
                });
            }

        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            jqObject.removeClass("disabled");
        }
    });
    jqObject.addClass("disabled");
}