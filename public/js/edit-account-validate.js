$("#edit-account-form #userNameField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#userNameField");
});

$("#edit-account-form #emailField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#emailField");
});

$("#edit-account-form #firstNameField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#firstNameField");
});

$("#edit-account-form #lastNameField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#lastNameField");
});

$("#edit-account-form #dobField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#dobField");
});

$("#edit-account-form #addressField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#addressField");
});

$("#edit-account-form #stateField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#stateField");
});

$("#edit-account-form #countryField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#countryField");
});

$("#edit-account-form #phoneNumberField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#phoneNumberField");
});

$("#edit-account-form #bankNameField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#bankNameField");
});

$("#edit-account-form #bankAccountNameField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#bankAccountNameField");
});

$("#edit-account-form #bankAccountNumberField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#bankAccountNumberField");
});

$("#edit-account-form #bankBranchField").on("focus", function (e) {
    clearInputFeedBack("#edit-account-form", "#bankBranchField");
});

$('#edit-account-form').on('submit', function (e) {
    var error = 0;
    if (!validateFirstName()) {
        if (error == 0) {
            var position = ($("#edit-account-form #firstNameField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateLastName()) {
        if (error == 0) {
            var position = ($("#edit-account-form #lastNameField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateGender()) {
        if (error == 0) {
            var position = ($("#edit-account-form #genderField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateDateOfBirth()) {
        if (error == 0) {
            var position = ($("#edit-account-form #dobField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateAddress()) {
        if (error == 0) {
            var position = ($("#edit-account-form #addressField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateState()) {
        if (error == 0) {
            var position = ($("#edit-account-form #stateField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateCountry()) {
        if (error == 0) {
            var position = ($("#edit-account-form #countryField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validatePhoneNumber()) {
        if (error == 0) {
            var position = ($("#edit-account-form #phoneNumberField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateEmail()) {
        if (error == 0) {
            var position = ($("#edit-account-form #emailField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateBankName()) {
        if (error == 0) {
            var position = ($("#edit-account-form #bankNameField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateBankAccountName()) {
        if (error == 0) {
            var position = ($("#edit-account-form #bankAccountNameField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateBankAccountNumber()) {
        if (error == 0) {
            var position = ($("#edit-account-form #bankAccountNumberField").offset().top) - 90;
            scrollTo(0, position);
        }
        error++;
    }
    if (!validateBankBranch()) {
        if (error == 0) {
            var position = ($("#edit-account-form #bankBranchField").offset().top) - 90;
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
    var firstName = $("#edit-account-form").find("#firstNameField").val();
    if (isEmpty(firstName)) {
        addError("#edit-account-form", "#firstNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(firstName, 3, 100)) {
        addError("#edit-account-form", "#firstNameField", "Invalid First Name");
        return false;
    } else if (!isLetter(firstName)) {
        addError("#edit-account-form", "#firstNameField", "Enter valid first name.");
        return false;
    } else {
        addSuccess("#edit-account-form", "#firstNameField");
        return true;
    }
}

function validateLastName() {
    var lastName = $("#edit-account-form").find("#lastNameField").val();
    if (isEmpty(lastName)) {
        addError("#edit-account-form", "#lastNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(lastName, 3, 100)) {
        addError("#edit-account-form", "#lastNameField", "Invalid Last Name");
        return false;
    } else if (!isLetter(lastName)) {
        addError("#edit-account-form", "#lastNameField", "Enter valid last name.");
        return false;
    } else {
        addSuccess("#edit-account-form", "#lastNameField");
        return true;
    }
}

function validateAddress() {
    var address = $("#edit-account-form").find("#addressField").val();
    if (isEmpty(address)) {
        addError("#edit-account-form", "#addressField", "Please fill out this field");
        return false;
    } else if (!validateLength(address, 3, 100)) {
        addError("#edit-account-form", "#addressField", "Invalid Address. 3 - 100 characters allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#addressField");
        return true;
    }
}

function validateState() {
    var state = $("#edit-account-form").find("#stateField").val();
    if (isEmpty(state)) {
        addError("#edit-account-form", "#stateField", "Please fill out this field");
        return false;
    } else if (!validateLength(state, 3, 20) || !validateName(state)) {
        addError("#edit-account-form", "#stateField", "Invalid State. 3 -20 characters allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#stateField");
        return true;
    }
}

function validateGender() {
    var gender = $("#edit-account-form").find("#genderField").val();
    if (isEmpty(gender)) {
        addSelectError("#edit-account-form", "#genderField", "Please choose your gender.");
        addDangerButtonToSelectFields("#edit-account-form", "#genderField");
        return false;
    } else {
        addSelectSuccess("#edit-account-form", "#genderField");
        addSuccessButtonsToSelectFields("#edit-account-form", "#genderField");
        return true;
    }
}

function validateCountry() {
    var country = $("#edit-account-form").find("#countryField").val();
    if (isEmpty(country)) {
        addSelectError("#edit-account-form", "#countryField", "Please choose your country.");
        addDangerButtonToSelectFields("#edit-account-form", "#countryField");
        return false;
    } else {
        addSelectSuccess("#edit-account-form", "#countryField");
        addSuccessButtonsToSelectFields("#edit-account-form", "#countryField");
        return true;
    }
}

function validatePhoneNumber() {
    var phoneNumber = $("#edit-account-form").find("#phoneNumberField").val();
    if (isEmpty(phoneNumber)) {
        addError("#edit-account-form", "#phoneNumberField", "Please fill out this field");
        return false;
    } else if (!validateNumber(phoneNumber)) {
        addError("#edit-account-form", "#phoneNumberField", "Invalid Phone Number. Only numbers allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#phoneNumberField");
        return true;
    }
}

function validateDateOfBirth() {
    var dateOfBirth = $("#edit-account-form").find("#dobField").val();
    if (isEmpty(dateOfBirth)) {
        addError("#edit-account-form", "#dobField", "Please fill out this field");
        return false;
    } else {
        addSuccess("#edit-account-form", "#dobField");
        return true;
    }
}

function validateBankName() {
    var bankName = $("#edit-account-form").find("#bankNameField").val();
    if (isEmpty(bankName)) {
        addError("#edit-account-form", "#bankNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(bankName, 3, 50) || !validateName(bankName)) {
        addError("#edit-account-form", "#bankNameField", "Invalid Bank Name. 3 - 50 alphabetical characters allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#bankNameField");
        return true;
    }
}

function validateBankAccountName() {
    var bankAccountName = $("#edit-account-form").find("#bankAccountNameField").val();
    if (isEmpty(bankAccountName)) {
        addError("#edit-account-form", "#bankAccountNameField", "Please fill out this field");
        return false;
    } else if (!validateLength(bankAccountName, 5, 100) || !validateName(bankAccountName)) {
        addError("#edit-account-form", "#bankAccountNameField", "Invalid Bank Account Name. 5 - 100 alphabetical characters allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#bankAccountNameField");
        return true;
    }
}

function validateBankAccountNumber() {
    var bankAccountNumber = $("#edit-account-form").find("#bankAccountNumberField").val();
    if (isEmpty(bankAccountNumber)) {
        addError("#edit-account-form", "#bankAccountNumberField", "Please fill out this field");
        return false;
    } else if (!isPosInteger(bankAccountNumber)) {
        addError("#edit-account-form", "#bankAccountNumberField", "Invalid Bank Account Number. Only numbers allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#bankAccountNumberField");
        return true;
    }
}
function validateBankBranch() {
    var bankBranch = $("#edit-account-form").find("#bankBranchField").val();
    if (isEmpty(bankBranch)) {
        addError("#edit-account-form", "#bankBranchField", "Please fill out this field");
        return false;
    } else if (!validateLength(bankBranch, 3, 20) || !validateName(bankBranch)) {
        addError("#edit-account-form", "#bankBranchField", "Invalid Bank Branch. 3 - 20 alphabetical characters allowed");
        return false;
    } else {
        addSuccess("#edit-account-form", "#bankBranchField");
        return true;
    }
}

function validateTermCheck() {
    var termCheck = $("#edit-account-form").find("#termCheck").get(0);
    if (!termCheck.checked) {
        $("#edit-account-form").find("#termCheck").parents(".form-group").removeClass("has-success");
        $("#edit-account-form").find("#termCheck").parents(".form-group").addClass("has-error");
        return false;
    } else {
        $("#edit-account-form").find("#termCheck").parents(".form-group").removeClass("has-error");
        $("#edit-account-form").find("#termCheck").parents(".form-group").addClass("has-success");
        return true;
    }
}

function validateEmail() {
    var email = $("#edit-account-form").find("#emailField").val();
    if (isEmpty(email)) {
        addError("#edit-account-form", "#emailField", "Please Fill out this field");
        return false;
    } else if (!checkEmail(email)) {
        addError("#edit-account-form", "#emailField", "Invalid Email Address.");
        return false;
    } else {
        addSuccess("#edit-account-form", "#emailField");
        return true;
    }
}

function validateUsername() {
    var username = $("#edit-account-form").find("#userNameField").val();
    if (isEmpty(username)) {
        addError("#edit-account-form", "#userNameField", "Please Fill out this field");
        return false;
    } else if (!isLetterOrNumber(username)) {
        addError("#edit-account-form", "#userNameField", "Invalid Username. No special characters and spaces allowed.");
        return false;
    } else if (!validateLength(username, 4, 20)) {
        addError("#edit-account-form", "#userNameField", "Username should contain 4 - 20 characters without spaces");
        return false;
    } else {
        addSuccess("#edit-account-form", "#userNameField");
        return true;
    }
}

function validatereferralName() {
    var referralName = $("#edit-account-form").find("#referralNameField").val();
    if (isEmpty(referralName)) {
        addreferralError("#edit-account-form", "#referralNameField", "Please Fill out this field");
        return false;
    } else if (!isLetterOrNumber(referralName)) {
        addreferralError("#edit-account-form", "#referralNameField", "Invalid referral Name. No special characters and spaces allowed.");
        return false;
    } else if (!validateLength(referralName, 4, 20)) {
        addreferralError("#edit-account-form", "#referralNameField", "referral Name should contain 4 - 20 characters without spaces");
        return false;
    } else {
        return true;
    }
}

function validatePassword() {
    var password = $("#edit-account-form").find("#passwordField").val();
    if (!validateLength(password, 6, 20)) {
        addError("#edit-account-form", "#passwordField", "Password should contain 6 - 20 characters");
        return false;
    } else {
        addSuccess("#edit-account-form", "#passwordField");
        return true;
    }
}

function validateConfirmPassword() {
    var password = $("#edit-account-form").find("#passwordField").val();
    var reEnterPassword = $("#edit-account-form").find("#confirmPasswordField").val();
    if (password != reEnterPassword) {
        addError("#edit-account-form", "#confirmPasswordField", "Passwords don't match");
        return false;
    } else {
        addSuccess("#edit-account-form", "#confirmPasswordField");
        return true;
    }
}
function validateTransactionPassword() {
    var password = $("#edit-account-form").find("#transactionPasswordField").val();
    if (!validateLength(password, 6, 20)) {
        addError("#edit-account-form", "#transactionPasswordField", "Transaction Password should contain 6 - 20 characters");
        return false;
    } else {
        addSuccess("#edit-account-form", "#transactionPasswordField");
        return true;
    }
}

function validateConfirmTransactionPassword() {
    var transactionPassword = $("#edit-account-form").find("#transactionPasswordField").val();
    var confirmTransactionPassword = $("#edit-account-form").find("#confirmTransactionPasswordField").val();
    if (transactionPassword != confirmTransactionPassword) {
        addError("#edit-account-form", "#confirmTransactionPasswordField", "Transaction Passwords don't match");
        return false;
    } else {
        addSuccess("#edit-account-form", "#confirmTransactionPasswordField");
        return true;
    }
}