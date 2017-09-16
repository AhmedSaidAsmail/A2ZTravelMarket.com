$(document).ready(function () {
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
    // old
    $(window).scroll(function () {
        var nav = $(".main-header-holder");
        var height = $(window).scrollTop();
        if (height > 450) {
            nav.addClass('fixed-main-nav');
        } else {
           nav.removeClass('fixed-main-nav');
        }


    });
    $(".responsive-menu-icon").click(function () {
        var menuBar = $("#main-nav");
        var links = $(".main-nav-item");
        if (links.position().left >= 0) {
            menuBar.css("left", "0px");
            links.css("left", "-80%");
            $("body").css("overflow-y", "scroll");
            $(this).removeClass('menu-active');
        } else {
            menuBar.css("left", "80%");
            links.css("left", "0px");
            $("body").css("overflow-y", "hidden");
            $(this).addClass('menu-active');
        }
    });
    //main nav
    //welcome search 
    $("input#welcome-search").keyup(function () {
        var inputVal = $(this).val();
        var form = $(this).closest('form');
        var link = form.attr('action');
        $.ajax({
            type: "get",
            url: link,

            data: {text: inputVal},
            success: function (response) {
                $("#search-result").show();
                $("#search-result").html(response);
            }

        });
    });
    $("iframe#youtube").each(function () {
        var parentDiv = $(this).closest("div");
        var selfWidth = parentDiv.width();
        $(this).attr("width", selfWidth);
    });

    //transfer form 
    $("#dist_from").change(function () {
        var form = $("#getDestFrom");
        form.submit();
    });
    $("#dist_from_2").change(function () {
        var form = $("#getDestFrom");
        form.submit();
    });
    $("#getDestFrom").submit(function (event) {
        event.preventDefault();
        var dist_from;
        if ($("#dist_from").length) {
            dist_from = $("#dist_from").val();
        } else {
            dist_from = $("#dist_from_2").val();
        }
        var link = $(this).attr("action");
        var dist_to = $("#dist_to");
        var loading_img = $(".loading-small");
        loading_img.show();
        $.ajax({
            url: link,
            type: "get",
            data: {dist_from: dist_from},
            success: function (response) {
                dist_to.html(response);
                loading_img.fadeOut();
            }

        });

    });
    $("#transfer-type").change(function () {
        var itValue = $(this).val();
        var pax_no = $(this).closest("form").find("#pax_no");
        if (itValue === "type_limousine") {
            pax_no.attr("value", 1);
            pax_no.attr("min", 1);
            pax_no.attr("max", 3);
        } else if (itValue === "type_van") {
            pax_no.attr("value", 4);
            pax_no.attr("min", 4);
            pax_no.attr("max", 9);
        } else if (itValue === "type_coaster") {
            pax_no.attr("value", 10);
            pax_no.attr("min", 10);
            pax_no.attr("max", 16);
        } else if (itValue === "type_bus") {
            pax_no.attr("value", 17);
            pax_no.attr("min", 17);
            pax_no.attr("max", 45);
        }
    });
    $("a.select-transfer").click(function (event) {
        event.preventDefault();
        var div = $(".form-under-transfer");
        var val = $(this).attr("href");
        var form = $("#form-transfer");
        var transfer_type = form.find('[name="transfer_type"]');
        var pax_no = form.find("#pax_no");
        if (val === "type_limousine") {
            pax_no.attr("value", 1);
            pax_no.attr("min", 1);
            pax_no.attr("max", 3);
        } else if (val === "type_van") {
            pax_no.attr("value", 4);
            pax_no.attr("min", 4);
            pax_no.attr("max", 9);
        } else if (val === "type_coaster") {
            pax_no.attr("value", 10);
            pax_no.attr("min", 10);
            pax_no.attr("max", 16);
        } else if (val === "type_bus") {
            pax_no.attr("value", 17);
            pax_no.attr("min", 17);
            pax_no.attr("max", 45);
        }
        transfer_type.val(val);
        div.removeClass('form-transfer-hide');
        div.addClass('form-transfer-show');
        maxValue(pax_no);

    });
    $("#one-way").change(function () {
        var form = $("#form-transfer");
        var times_input = form.find('[name="transfer_times"]');
        var departure_date = form.find("#departure_date");
        if ($(this).is(":checked"))
        {
            times_input.val(1);
            departure_date.prop('disabled', true);
            departure_date.val("");
        } else {
            times_input.val(2);
            departure_date.prop('disabled', false);
        }
    });
    $("#choose_times").change(function () {
        var form = $("#form-transfer");
        var times_input = $(this).val();
        var departure_date = form.find("#departure_date");
        if (parseInt(times_input) === 1) {
            departure_date.prop('disabled', true);
            departure_date.val("");
        } else {
            departure_date.prop('disabled', false);
        }
    });
    $("#pax_no").keyup(function () {
        maxValue($(this));
    });
    //booking form 
    $("#first_amount").keyup(function () {
        // first Price
        var itVal = parseFloat($(this).val());
        var itPrice = parseFloat($(this).closest('form').find('#first-price').text());
        //second Price
        var secVal = parseFloat($("#second_amount").val());
        var secPrice = parseFloat($(this).closest('form').find('#sec-price').text());
        // count total
        var totalSpan = $(this).closest('form').find('#total');
        var totalPrice = (itVal * itPrice) + (secVal * secPrice);
        totalSpan.html(totalPrice.toFixed(2));


    });
    $("#second_amount").keyup(function () {
        // first Price
        var itVal = parseFloat($(this).val());
        var itPrice = parseFloat($(this).closest('form').find('#sec-price').text());
        //second Price
        var secVal = parseFloat($("#first_amount").val());
        var secPrice = parseFloat($(this).closest('form').find('#first-price').text());
        // count total
        var totalSpan = $(this).closest('form').find('#total');
        var totalPrice = (itVal * itPrice) + (secVal * secPrice);
        totalSpan.html(totalPrice.toFixed(2));


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
// old function
function maxValue(input) {
    var value = input.val();
    var max = input.attr('max');
    if (parseInt(value) > parseInt(max)) {
        input.val(max);
    }
}