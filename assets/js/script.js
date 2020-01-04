$(document).ready(function () {
    AOS.init({disable: "mobile"}), $("[data-bs-hover-animate]").mouseenter(function () {
        var n = $(this);
        n.addClass("animated " + n.attr("data-bs-hover-animate"))
    }).mouseleave(function () {
        var n = $(this);
        n.removeClass("animated " + n.attr("data-bs-hover-animate"))
    })
});

$(document).ready(function () {
    function n() {
        $(window).scrollTop() > 150 ? $(".navbar.navbar-fixed-top").addClass("navchange") : $(".navbar.navbar-fixed-top").removeClass("navchange")
    }

    $(".navbar").length > 0 && $(window).on("scroll load resize", function () {
        n()
    }), $(".dropdown").on("show.bs.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(!0, !0).slideDown(300)
    }), $(".dropdown").on("hide.bs.dropdown", function () {
        $(this).find(".dropdown-menu").first().stop(!0, !0).slideUp(300)
    })
});