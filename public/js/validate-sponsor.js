$("#referralForm #referralNameField").on("focus", function (e) {
    clearInputreferralFeedBack("#referralForm", "#referralNameField");
});

$("#referralForm #referralNameField").on("focusout", function (e) {
    referralAjaxValidation();
});

var referralConstant = 0;

function referralAjaxValidation() {
    var referralName = $("#referralForm #referralNameField").val();
    if (!validatereferralName()) {
        referralConstant = 0;
        return false;
    }
    $.ajax({
        url: "/user/validate-referral.php",
        dataType: 'json',
        data: "referralName=" + referralName,
        type: 'POST',
        success: function (response) {
            $("#referralForm #referralNameField").get(0).disabled = false;
            if (response.responseCode == 1) {
                addreferralSuccess("#referralForm", "#referralNameField", response.firstName + " " + response.lastName);
                referralConstant = 1;
            } else if (response.responseCode == 0) {
                addreferralError("#referralForm", "#referralNameField", "referral does not exist.");
                referralConstant = 0;
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            addreferralError("#referralForm", "#referralNameField", "");
            referralConstant = 0;
            $("#referralForm #referralNameField").get(0).disabled = false;
        }
    });
    $("#referralForm #referralNameField").get(0).disabled = true;
    addreferralLoading("#referralForm", "#referralNameField");
}
function validatereferralName() {
    var referralName = $("#referralForm").find("#referralNameField").val();
    if (isEmpty(referralName)) {
        addreferralError("#referralForm", "#referralNameField", "Please Fill out this field");
        return false;
    } else if (!isLetterOrNumber(referralName)) {
        addreferralError("#referralForm", "#referralNameField", "Invalid referral Name. No special characters and spaces allowed.");
        return false;
    } else if (!validateLength(referralName, 4, 20)) {
        addreferralError("#referralForm", "#referralNameField", "referral Name should contain 4 - 20 characters without spaces");
        return false;
    } else {
        return true;
    }
}

$('#referralForm').on('submit', function (e) {
    var error = 0;
    if (!validatereferralName()) {
        if (error == 0) {
            var position = ($("#referralForm #referralNameField").offset().top) - 10;
            scrollTo(0, position);
        }
        error++;
    }
    if (error == 0) {
        return true;
    } else {
        return false;
    }
});