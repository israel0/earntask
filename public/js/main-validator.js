// JavaScript Document

function addSelectError(formID, inputID, errorMsg) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    helpBlock.html(errorMsg);
    helpBlock.css("color", "#A94442");
}

function addSelectSuccess(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    helpBlock.html("");
}

function clearSelectFeedBack(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    helpBlock.html("");
}

function addError(formID, inputID, errorMsg) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    var feedback = formGroupParent.find(".form-control-feedback");
    formGroupParent.removeClass("has-success");
    formGroupParent.addClass("has-error");
    helpBlock.html(errorMsg);
    feedback.removeClass("glyphicon-ok");
    feedback.addClass("glyphicon-remove");
    feedback.removeClass("fa-circle-o-notch fa-spin");
}

function addreferralError(formID, inputID, errorMsg) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    var feedback = formGroupParent.find(".referral-feedback");
    formGroupParent.removeClass("has-success");
    formGroupParent.addClass("has-error");
    helpBlock.html(errorMsg);
    feedback.removeClass("glyphicon glyphicon-ok");
    feedback.removeClass("fa fa-circle-o-notch fa-spin");
    feedback.removeClass("glyphicon glyphicon-remove");
    feedback.addClass("glyphicon glyphicon-remove");
}

function addHelpText(formID, inputID, helpText) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var helpBlock = formGroupParent.find(".help-block");
    helpBlock.html(helpText);
}

function addSuccess(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".form-control-feedback");
    var helpBlock = formGroupParent.find(".help-block");
    formGroupParent.removeClass("has-error");
    formGroupParent.addClass("has-success");
    feedback.removeClass("glyphicon-remove");
    feedback.addClass("glyphicon-ok");
    helpBlock.html("");
}

function addreferralSuccess(formID, inputID, helpText) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".referral-feedback");
    var helpBlock = formGroupParent.find(".help-block");
    formGroupParent.removeClass("has-error");
    formGroupParent.addClass("has-success");
    feedback.removeClass("glyphicon glyphicon-remove");
    feedback.removeClass("fa fa-circle-o-notch fa-spin");
    feedback.addClass("glyphicon glyphicon-ok");
    console.log(helpBlock.size() + " " + helpText);
    helpBlock.html(helpText);
}

function addLoading(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".form-control-feedback");
    feedback.removeClass("glyphicon-remove");
    feedback.removeClass("glyphicon-ok");
}

function addreferralLoading(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".referral-feedback");
    feedback.removeClass("glyphicon glyphicon-remove");
    feedback.removeClass("glyphicon glyphicon-ok");
    feedback.addClass("fa fa-circle-o-notch fa-spin");
}

function clearInputFeedBack(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".form-control-feedback");
    var helpBlock = formGroupParent.find(".help-block");
    formGroupParent.removeClass("has-success");
    formGroupParent.removeClass("has-error");
    feedback.removeClass("glyphicon-ok");
    feedback.removeClass("glyphicon-remove");
    feedback.removeClass("fa-circle-o-notch fa-spin");
    helpBlock.html("");
}

function clearInputreferralFeedBack(formID, inputID) {
    var formGroupParent = $(formID).find(inputID).parents(".form-group");
    var feedback = formGroupParent.find(".referral-feedback");
    var helpBlock = formGroupParent.find(".help-block");
    formGroupParent.removeClass("has-success");
    formGroupParent.removeClass("has-error");
    feedback.removeClass("glyphicon glyphicon-remove");
    feedback.removeClass("glyphicon glyphicon-ok");
    feedback.removeClass("fa fa-circle-o-notch fa-spin");
    feedback.addClass("glyphicon glyphicon-remove");
    helpBlock.html("");
}

function addDangerButtonToSelectFields(formID, selectID) {
    var buttonGroupParent = $(formID).find(selectID).parents(".btn-group");
    var button = buttonGroupParent.find(".btn");
    button.off("focus");
    button.on("focus", function (e) {
        button.addClass("btn-primary");
        button.removeClass("btn-primary");
        button.removeClass("btn-danger");
        clearSelectFeedBack(formID, selectID);
    });
    button.removeClass("btn-primary");
    button.removeClass("btn-primary");
    button.addClass("btn-danger");
}

function addSuccessButtonsToSelectFields(formID, selectID) {
    var buttonGroupParent = $(formID).find(selectID).parents(".btn-group");
    var button = buttonGroupParent.find(".btn");
    button.off("focus");
    button.on("focus", function (e) {
        button.addClass("btn-primary");
        button.removeClass("btn-primary");
        button.removeClass("btn-danger");
    });
    button.removeClass("btn-primary");
    button.addClass("btn-primary");
    button.removeClass("btn-danger");
}

function clearButtonsToSelectFields(formID, selectID) {
    var buttonGroupParent = $(formID).find(selectID).parents(".btn-group");
    var button = buttonGroupParent.find(".btn");
    button.addClass("btn-primary");
    button.removeClass("btn-primary");
    button.removeClass("btn-danger");
}

function isEmpty(str) {
    if (str == null || str.length == 0 || str == "") {
        return true;
    } else {
        return false;
    }
}
function isPosInteger(str) {
    str = str.toString();
    for (i = 0; i < str.length; i++) {
        var strChar = str.charAt(i);
        if (strChar < "0" || strChar > "9") {
            return false;
        }
    }
    return true;
}
function isLetter(str) {
    var str = new String(str);
    str = str.toLowerCase();
    for (i = 0; i < str.length; i++) {
        var strChar = str.charAt(i);
        if (strChar < "a" || strChar > "z") {
            return false;
        }
    }
    return true;
}

function validateName($str) {
    var re = /^[a-zA-Z\s]+$/;
    return re.test($str);
}

function isLetterOrNumber(str) {
    var str = new String(str);
    str = str.toLowerCase();
    for (i = 0; i < str.length; i++) {
        var strChar = str.charAt(i);
        if ((strChar < "a" || strChar > "z") && (strChar < "0" || strChar > "9")) {
            return false;
        }
    }
    return true;
}

function validateNumber(str) {
    var str = new String(str);
    str = str.toLowerCase();
    for (i = 0; i < str.length; i++) {
        var strChar = str.charAt(i);
        if ((strChar != "+") && (strChar < "0" || strChar > "9")) {
            return false;
        }
    }
    return true;
}

function validateLength(str, minlength, maxlength) {
    if (str.length < minlength || str.length > maxlength) {
        return false;
    }
    return true;
}

function checkDate(date) {
    var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
    return pattern.test(date);
}

function checkEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function checkPassword(password) {
    var re = /^.{6,20}$/;
    return re.test(password);
}

function checkPin(pin) {
    var re = /^\d{4}$/;
    return re.test(pin);
}