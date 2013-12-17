$(function() {



    $("#sidebar a.dropdown-toggle").click(function() {
        var e = $(this).next(".submenu");
        var t = $(this).children(".arrow");
        e.toggle('fast', function() {
            if ($(this).is(":hidden")) {
                t.attr("class", "arrow icon-angle-right");

            } else {
                t.attr("class", "arrow icon-angle-down");
            }
        });
    });

    // $("#sidebar.sidebar-collapsed #sidebar-collapse > i").attr("class", "icon-double-angle-right");


    $("#sidebar-collapse").click(function() {
        $.cookie('istarbar', 'sidebar-collapsed', {expires: 7,path:'/'});
        $("#sidebar").toggleClass("sidebar-collapsed");
        if ($("#sidebar").hasClass("sidebar-collapsed")) {
            $("#sidebar-collapse > i").attr("class", "icon-double-angle-right");
        } else {
            $("#sidebar-collapse > i").attr("class", "icon-double-angle-left");
            $.cookie('istarbar', null, {expires: 7,path:'/'});
        }

    });

    $("#sidebar .nav > li.active > a > .arrow").removeClass("icon-angle-right").addClass("icon-angle-down");

    if ($("#sidebar").hasClass("sidebar-fixed")) {
        $('#theme-setting > ul > li > a[data-target="sidebar"] > i').attr("class", "icon-check green");

    }
    if ($("#navbar").hasClass("navbar-fixed")) {
        $('#theme-setting > ul > li > a[data-target="navbar"] > i').attr("class", "icon-check green");
    }


    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $("#btn-scrollup").fadeIn();
        } else {
            $("#btn-scrollup").fadeOut();
        }
    });
    $("#btn-scrollup").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

// widget tools

jQuery('.widget .tools .icon-chevron-down, .widget .tools .icon-chevron-up').click(function () {
    var el = jQuery(this).parents(".widget").children(".widget-body");
    if (jQuery(this).hasClass("icon-chevron-down")) {
        jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
        el.slideUp(200);
    } else {
        jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
        el.slideDown(200);
    }
});

jQuery('.widget .tools .icon-remove').click(function () {
    jQuery(this).parents(".widget").parent().remove();
});



//    popovers

$('.popovers').popover();

// scroller





});