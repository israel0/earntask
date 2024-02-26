
$(".subLink").on("click", function (e) {
    e.preventDefault();
    var listGroup = $(this).parent();
    var spanDiv = listGroup.find("span.fa");
    var subList = listGroup.find("ul");
    if (spanDiv.hasClass("fa-arrow-right")) {
        subList.slideDown("slow");
        spanDiv.removeClass("fa-arrow-right");
        spanDiv.addClass("fa-arrow-down");
        $(this).css({
            "text-decoration": "none"
        });
    } else {
        spanDiv.removeClass("fa-arrow-down");
        spanDiv.addClass("fa-arrow-right");
        subList.slideUp("slow");
    }
});
$(".sub-arrow").on("click", function (e) {
    e.preventDefault();
    var listGroup = $(this).parents(".list-group-item");
    var spanDiv = $(this);
    var subList = listGroup.find("ul");
    if (spanDiv.hasClass("fa-arrow-right")) {
        subList.slideDown("slow");
        spanDiv.removeClass("fa-arrow-right");
        spanDiv.addClass("fa-arrow-down");
    } else {
        spanDiv.removeClass("fa-arrow-down");
        spanDiv.addClass("fa-arrow-right");
        subList.slideUp("slow");
    }
});
$(".menu-link").on("click", function (e) {
    e.preventDefault();
    var menuNav = $("#menuNav");
    menuNav.slideToggle("slow");
});