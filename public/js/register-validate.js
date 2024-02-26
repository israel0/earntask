$("#register-form #userNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#userNameField");
});

$("#register-form #referralNameField").on("focus", function (e) {
    clearInputreferralFeedBack("#register-form", "#referralNameField");
});

$("#register-form #referralNameField").on("focusout", function (e) {
    referralAjaxValidation();
});

$("#register-form #emailField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#emailField");
});

$("#register-form #passwordField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#passwordField");
});

$("#register-form #confirmPasswordField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#confirmPasswordField");
});

$("#register-form #referralNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#referralNameField");
});

$("#register-form #firstNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#firstNameField");
});

$("#register-form #lastNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#lastNameField");
});

$("#register-form #middleNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#middleNameField");
});

$("#register-form #dobField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#dobField");
});

$("#register-form #addressField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#addressField");
});

$("#register-form #stateField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#stateField");
});

$("#register-form #countryField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#countryField");
});

$("#register-form #phoneNumberField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#phoneNumberField");
});

$("#register-form #transactionPasswordField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#transactionPasswordField");
});

$("#register-form #confirmTransactionPasswordField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#confirmTransactionPasswordField");
});

$("#register-form #bankNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#bankNameField");
});

$("#register-form #bankAccountNameField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#bankAccountNameField");
});

$("#register-form #bankAccountNumberField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#bankAccountNumberField");
});

$("#register-form #bankBranchField").on("focus", function (e) {
    clearInputFeedBack("#register-form", "#bankBranchField");
});

var referralConstant = 0;

function referralAjaxValidation() {
    referralConstant = 0;
    var referralName = $("#register-form #referralNameField").val();
    if (!validatereferralName()) {
        referralConstant = 0;
        return false;
    }
    $.ajax({
        url: validatereferralUrl,
        dataType: 'json',
        data: "referralName=" + referralName,
        headers: {
            "X-CSRF-Token": csrf_token,
        },
        type: 'POST',
        success: function (response) {
            $("#register-form #referralNameField").get(0).disabled = false;
            if (response.responseCode == 1) {
                addreferralSuccess("#register-form", "#referralNameField", response.firstName + " " + response.lastName);
                referralConstant = 1;
            } else if (response.responseCode == 0) {
                addreferralError("#register-form", "#referralNameField", "referral does not exist.");
                referralConstant = 0;
            }
        },
        timeout: 120000, // Timeout after 6 seconds
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("Error, textStatus: " + textStatus + " errorThrown: " + errorThrown);
            //show error message            
            addreferralError("#register-form", "#referralNameField", "");
            referralConstant = 0;
            $("#register-form #referralNameField").get(0).disabled = false;
        }
    });
    $("#register-form #referralNameField").get(0).disabled = true;
    addreferralLoading("#register-form", "#referralNameField");
}

$('#register-form').on('submit', function (e) {       
    var error = 0;
    if (!validatereferralName()) {
        if (error == 0) {
            var position = ($("#register-form #referralNameField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateFirstName()) {
        if (error == 0) {
            var position = ($("#register-form #firstNameField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateLastName()) {
        if (error == 0) {
            var position = ($("#register-form #lastNameField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    // if (!validateMiddleName()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #middleNameField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateGender()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #genderField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateDateOfBirth()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #dobField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateAddress()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #addressField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateState()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #stateField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateCountry()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #countryField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    if (!validatePhoneNumber()) {
        if (error == 0) {
            var position = ($("#register-form #phoneNumberField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateUsername()) {
        if (error == 0) {
            var position = ($("#register-form #userNameField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateEmail()) {
        if (error == 0) {
            var position = ($("#register-form #emailField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validatePassword()) {
        if (error == 0) {
            var position = ($("#register-form #passwordField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateConfirmPassword()) {
        if (error == 0) {
            var position = ($("#register-form #confirmPasswordField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateTransactionPassword()) {
        if (error == 0) {
            var position = ($("#register-form #transactionPasswordField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateConfirmTransactionPassword()) {
        if (error == 0) {
            var position = ($("#register-form #confirmTransactionPasswordField").offset().top) - 70;
            scrollTo(0, position);
        }
        error++;
    }
    // if (!validateBankName()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #bankNameField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateBankAccountName()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #bankAccountNameField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    // if (!validateBankAccountNumber()) {
    //     if (error == 0) {
    //         var position = ($("#register-form #bankAccountNumberField").offset().top) - 70;
    //         scrollTo(0, position);
    //     }
    //     error++;
    // }
    if (!validateTermCheck()) {        
        if (error == 0) {
            var position = ($("#register-form #termCheck").offset().top) - 70;
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

function validateFirstName() {
    var firstName = $("#register-form").find("#firstNameField").val();
    if (isEmpty(firstName)) {
        addError("#register-form", "#firstNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(firstName, 3, 100)) {
        addError("#register-form", "#firstNameField", "Invalid First Name");
        return false;
    } else {
        addSuccess("#register-form", "#firstNameField");
        return true;
    }
}

function validateLastName() {
    var lastName = $("#register-form").find("#lastNameField").val();
    if (isEmpty(lastName)) {
        addError("#register-form", "#lastNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(lastName, 3, 100)) {
        addError("#register-form", "#lastNameField", "Invalid Last Name");
        return false;
    } else {
        addSuccess("#register-form", "#lastNameField");
        return true;
    }
}

function validateMiddleName() {
    var middleName = $("#register-form").find("#middleNameField").val();
    if (isEmpty(middleName)) {
        addError("#register-form", "#middleNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(middleName, 3, 100)) {
        addError("#register-form", "#middleNameField", "Invalid Middle Name");
        return false;
    } else {
        addSuccess("#register-form", "#middleNameField");
        return true;
    }
}

function validateAddress() {
    var address = $("#register-form").find("#addressField").val();
    if (isEmpty(address)) {
        addError("#register-form", "#addressField", "Please fill out this field");
        return false;
    } else if (!validateLength(address, 3, 100)) {
        addError("#register-form", "#addressField", "Invalid Address. 3 - 100 characters allowed");
        return false;
    } else {
        addSuccess("#register-form", "#addressField");
        return true;
    }
}

function validateState() {
    var state = $("#register-form").find("#stateField").val();
    if (isEmpty(state)) {
        addError("#register-form", "#stateField", "Please fill out this field");
        return false;
    } else if (!validateLength(state, 3, 20)) {
        addError("#register-form", "#stateField", "Invalid State. 3 -20 characters allowed");
        return false;
    } else {
        addSuccess("#register-form", "#stateField");
        return true;
    }
}

function validateGender() {
    var gender = $("#register-form").find("#genderField").val();
    if (isEmpty(gender)) {
        addSelectError("#register-form", "#genderField", "Please choose your gender.");
        addDangerButtonToSelectFields("#register-form", "#genderField");
        return false;
    } else {
        addSelectSuccess("#register-form", "#genderField");
        addSuccessButtonsToSelectFields("#register-form", "#genderField");
        return true;
    }
}

function validateCountry() {
    var country = $("#register-form").find("#countryField").val();
    if (isEmpty(country)) {
        addSelectError("#register-form", "#countryField", "Please choose your country.");
        addDangerButtonToSelectFields("#register-form", "#countryField");
        return false;
    } else {
        addSelectSuccess("#register-form", "#countryField");
        addSuccessButtonsToSelectFields("#register-form", "#countryField");
        return true;
    }
}

function validatePhoneNumber() {
    var phoneNumber = $("#register-form").find("#phoneNumberField").val();
    if (isEmpty(phoneNumber)) {
        addError("#register-form", "#phoneNumberField", "Please fill out this field");
        return false;
    } else if (!validateNumber(phoneNumber)) {
        addError("#register-form", "#phoneNumberField", "Invalid Phone Number. Only numbers allowed");
        return false;
    } else {
        addSuccess("#register-form", "#phoneNumberField");
        return true;
    }
}

function validateDateOfBirth() {
    var dateOfBirth = $("#register-form").find("#dobField").val();
    if (isEmpty(dateOfBirth)) {
        addError("#register-form", "#dobField", "Please fill out this field");
        return false;
    } else if (!checkDate(dateOfBirth)) {
        addError("#register-form", "#dobField", "Invalide date formate: Formate should be 'dd/mm/yyyy'");
        return false;
    } else {
        addSuccess("#register-form", "#dobField");
        return true;
    }
}

function validateBankName() {
    var bankName = $("#register-form").find("#bankNameField").val();
    if (isEmpty(bankName)) {
        addError("#register-form", "#bankNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(bankName, 3, 50)) {
        addError("#register-form", "#bankNameField", "Invalid Bank Name. 3 - 50 alphabetical characters allowed");
        return false;
    } else {
        addSuccess("#register-form", "#bankNameField");
        return true;
    }
}

function validateBankAccountName() {
    var bankAccountName = $("#register-form").find("#bankAccountNameField").val();
    if (isEmpty(bankAccountName)) {
        addError("#register-form", "#bankAccountNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(bankAccountName, 5, 100) || !validateName(bankAccountName)) {
        addError("#register-form", "#bankAccountNameField", "Invalid Bank Account Name. 5 - 100 alphabetical characters allowed");
        return false;
    } else {
        addSuccess("#register-form", "#bankAccountNameField");
        return true;
    }
}

function validateBankAccountNumber() {
    var bankAccountNumber = $("#register-form").find("#bankAccountNumberField").val();
    if (isEmpty(bankAccountNumber)) {
        addError("#register-form", "#bankAccountNumberField", "Please fill out this field");
        return false;
    } else if (!isPosInteger(bankAccountNumber)) {
        addError("#register-form", "#bankAccountNumberField", "Invalid Bank Account Number. Only numbers allowed");
        return false;
    } else {
        addSuccess("#register-form", "#bankAccountNumberField");
        return true;
    }
}

function validateTermCheck() {
    var termCheck = $("#register-form").find("#termCheck").get(0);
    if (!termCheck.checked) {
        $("#register-form").find("#termCheck").parents(".form-group").removeClass("has-success");
        $("#register-form").find("#termCheck").parents(".form-group").addClass("has-error");
        return false;
    } else {
        $("#register-form").find("#termCheck").parents(".form-group").removeClass("has-error");
        $("#register-form").find("#termCheck").parents(".form-group").addClass("has-success");
        return true;
    }
}

function validateEmail() {
    var email = $("#register-form").find("#emailField").val();
    if (isEmpty(email)) {
        addError("#register-form", "#emailField", "Please Fill out this field");
        return false;
    } else if (!checkEmail(email)) {
        addError("#register-form", "#emailField", "Invalid Email Address.");
        return false;
    } else {
        addSuccess("#register-form", "#emailField");
        return true;
    }
}

function validateUsername() {
    var username = $("#register-form").find("#userNameField").val();
    if (isEmpty(username)) {
        addError("#register-form", "#userNameField", "Please Fill out this field");
        return false;
    } else if (!isLetterOrNumber(username)) {
        addError("#register-form", "#userNameField", "Invalid Username. No special characters and spaces allowed.");
        return false;
    } else if (!validateLength(username, 4, 20)) {
        addError("#register-form", "#userNameField", "Username should contain 4 - 20 characters without spaces");
        return false;
    } else {
        addSuccess("#register-form", "#userNameField");
        return true;
    }
}

function validatereferralName() {
    var referralName = $("#register-form").find("#referralNameField").val();
    if (isEmpty(referralName)) {
        addreferralError("#register-form", "#referralNameField", "Please Fill out this field");
        return false;
    } else if (!isLetterOrNumber(referralName)) {
        addreferralError("#register-form", "#referralNameField", "Invalid referral Name. No special characters and spaces allowed.");
        return false;
    } else if (!validateLength(referralName, 3, 20)) {
        addreferralError("#register-form", "#referralNameField", "referral Name should contain 3 - 20 characters without spaces");
        return false;
    } else {
        return true;
    }
}

function validatePassword() {
    var password = $("#register-form").find("#passwordField").val();    
    if (!checkPassword(password)) {
        addError("#register-form", "#passwordField", "Password must be 6 - 20 characters");
        return false;
    } else {
        addSuccess("#register-form", "#passwordField");
        return true;
    }
}

function validateConfirmPassword() {
    var password = $("#register-form").find("#passwordField").val();
    var reEnterPassword = $("#register-form").find("#confirmPasswordField").val();
    if (password != reEnterPassword) {
        addError("#register-form", "#confirmPasswordField", "Passwords don't match");
        return false;
    } else {
        addSuccess("#register-form", "#confirmPasswordField");
        return true;
    }
}
function validateTransactionPassword() {
    var transactionPin = $("#register-form").find("#transactionPasswordField").val();
    if (!checkPin(transactionPin)) {
        addError("#register-form", "#transactionPasswordField", "Transaction Pin must be a 4 digit number");
        return false;
    } else {
        addSuccess("#register-form", "#transactionPasswordField");
        return true;
    }
}

function validateConfirmTransactionPassword() {
    var transactionPin = $("#register-form").find("#transactionPasswordField").val();
    var confirmTransactionPin = $("#register-form").find("#confirmTransactionPasswordField").val();
    if (transactionPin != confirmTransactionPin) {
        addError("#register-form", "#confirmTransactionPasswordField", "Transaction Pins don't match");
        return false;
    } else {
        addSuccess("#register-form", "#confirmTransactionPasswordField");
        return true;
    }
}