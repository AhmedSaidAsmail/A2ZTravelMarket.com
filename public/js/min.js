$(document).ready(function () {
    $("#attraction_search").keyup(function () {
        var itValue = $(this).val();
        var label = $(this).closest('.sp-eddition-2').find('label');
        var ulResults = $("ul.search-results");
        var link = $(this).attr('data-get');
        if (itValue.length) {
            label.addClass('small');
            ulResults.show();
            $.ajax({
                type: "get",
                url: link,
                data: {text: itValue},
                success: function (response) {
                    ulResults.html(response);
                }
            });
        } else {
            label.removeClass('small');
            ulResults.hide();
        }
    });
    $("input.email-autocompelete-off").focus(function () {
        $(this).attr("readonly", false);
    });
    $("a#login_now").click(function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        var login_area = $(".login-area");
        var login_box = login_area.find(".login-box-2");
        login_box.removeClass('bounceOutUp');
        login_area.css("height", $(document).height());
        login_area.show();
        login_box.addClass('bounceInDown');
    });
    $("#close-login").click(function () {
        var login_area = $(".login-area");
        var login_box = login_area.find(".login-box-2");
        login_box.removeClass('bounceInDown');
        login_box.addClass('bounceOutUp');
        login_area.delay(500).fadeOut();
    });
    $(".footer-show-toggle").click(function () {
        var div = $('.footer-toggle');
        if (div.height() > 0) {
            div.removeClass('toggle-on');
            div.addClass('toggle-off');
            $(this).html('<i class="fa fa-arrow-circle-up"></i> Show more');
        } else {
            div.removeClass('toggle-off');
            div.addClass('toggle-on');
            $(this).html('<i class="fa fa-arrow-circle-down"></i> Show less');
        }

    });
    function togglePrice(element) {
        var parentDiv = element.closest('.select-travelers-hidden');
        var it_div = parentDiv.closest('div[class^=col-md]');
        var prev_div = it_div.prev();
        var next_div = it_div.next();
        var datepicker = $('#tour_date').data('Zebra_DatePicker');
        // actions
        parentDiv.toggleClass('select-off select-on');
        $(this).toggleClass('fa-caret-down fa-caret-up');
        it_div.toggleClass('col-md-4 col-md-6');
        prev_div.toggleClass('col-md-4 col-md-3');
        next_div.toggleClass('col-md-4 col-md-3');
//        $('#tour_date').css('width',prev_div.width());
    }
    $(".price-toggle").click(function () {
        togglePrice($(this));

    });
    $(document).click(function (a) {
        if (!$(a.target).closest("div.select-travelers-hidden").length)
            if ($("div.select-travelers-holder").is(":visible"))
                togglePrice($(".price-toggle"));
    });
    $("i.fa-plus-sp").click(function () {
        var itsInput = $(this).closest('div').find('input');
        var itsName = itsInput.attr('name');
        var itsValue = parseFloat(itsInput.val());
        var itsMin = itsInput.attr('min');
        var itsSpan = $("#" + itsName);
        var newValue = itsValue + 1;
        itsSpan.show();
        itsInput.val(newValue);
        itsSpan.find('label').html(newValue);
    });
    $("i.fa-minus-sp").click(function () {
        var itsInput = $(this).closest('div').find('input');
        var itsName = itsInput.attr('name');
        var itsValue = parseFloat(itsInput.val());
        var itsMin = parseFloat(itsInput.attr('min'));
        var itsSpan = $("#" + itsName);
        if (itsValue > itsMin) {
            var newValue = itsValue - 1;
            itsSpan.show();
            itsInput.val(newValue);
            itsSpan.find('label').html(newValue);
        }
        if (newValue === 0) {
            itsSpan.hide();
        }

    });

    $("#go-to-book").click(function () {
        $('html, body').animate({
            scrollTop: $("#choose-plane").offset().top
        }, 500);
    });
    var count = $("div#item-tour").length;
    $("div#item-tour:gt(9)").hide();
    if (count > 10) {
        $("#show-more").show();
        if ((count - 10) < 10) {
            $("#show-more").find("span").html(count - 10);
        }

    } else {
        $("#show-more").hide();
    }
    $("#show-more").click(function () {
        var datatStart = $(this).attr('data-start');
        var showTo = parseFloat(datatStart) + 10;
        $("div#item-tour:lt(" + showTo + ")").show();
        $(this).attr('data-start', showTo);
        if (count <= showTo) {
            $(this).hide();
        }
        if (count < showTo + 10) {
            $(this).find("span").html(count - showTo);
        }
    });
    // top destention
    var count_dest = $("div#top_dest").length;
    $("div#top_dest:gt(11)").hide();
    $("#top_dest_show").click(function () {
        var datatStart = $(this).attr('data-start');
        var showTo = parseFloat(datatStart) + 12;
        $("div#top_dest:lt(" + showTo + ")").show();
        $(this).attr('data-start', showTo);
        if (count_dest <= showTo) {
            $(this).hide();
        }
    });
    // top destention end
    // top Attraction
    var count_attr = $("div#top_attr").length;
    $("div#top_attr:gt(11)").hide();
    $("#top_attr_show").click(function () {
        var datatStart = $(this).attr('data-start');
        var showTo = parseFloat(datatStart) + 12;
        $("div#top_attr:lt(" + showTo + ")").show();
        $(this).attr('data-start', showTo);
        if (count_attr <= showTo) {
            $(this).hide();
        }
    });
    // top Attraction end
    $("form#choose-plane").submit(function (event) {
        event.preventDefault();
        var date = $(this).find("input[name=date]").val();
        var loadingDiv = $(".ftech-data-loading");
        var resultDiv = $("#all-plane-prices");
        loadingDiv.show();
        if (!date.length) {
            alert('Date field is required');
            loadingDiv.hide();
            return false;
        }
        $.ajax({
            url: $(this).attr('action'),
            type: 'post',
            data: $(this).serialize(),
            success: function (response) {
                loadingDiv.fadeOut().delay(500);
                resultDiv.html(response);
                toggleClass();
                anotherDate();
            }

        });
    });
    $("a.review-sort").click(function (event) {
        event.preventDefault();
        var allLinks = $(".review-sort");
        var itValue = $(this).attr('data-key');
        var itInput = $(this).closest('.row').find('input[name=visit_sort]');
        allLinks.removeClass('it-selected');
        $(this).addClass('it-selected');
        itInput.attr('value', itValue);
    });
    $(window).scroll(function () {
        var nav = $(".main-header-holder");
        var height = $(window).scrollTop();
        if (height > 450) {
            nav.addClass('fixed-main-nav');
        } else {
            nav.removeClass('fixed-main-nav');
        }


    });
});
function toggleClass() {
    $("span#active-plane").click(function () {
        var allDivs = $("#all-plane-prices").find('.price-plane-avaiable');
        var Div = $(this).closest('.price-plane-avaiable');
        allDivs.removeClass('price-active').addClass('price-not-active');
        Div.removeClass('price-not-active').addClass('price-active');
    });
}
function anotherDate() {
    $("a#another-date").click(function (event) {
        event.preventDefault();
        var date = $(this).attr('data-date');
        var form = $("form#choose-plane");
        var dateInput = form.find('input[name=date]');
        dateInput.val(date);
        form.trigger('submit');
    });
}
