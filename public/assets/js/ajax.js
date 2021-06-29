$(function() {

    // $.ajax({
    //     type: "GET",
    //     dataType: "json",
    //     method: "GET",
    //     async: false,
    //     cache: false,
    //     url: "http://localhost:8000/api/client",
    //     success: function(data){
    //     $.each(data.client, function (i, client) {
    //         $('<option>').attr({
    //             value: client['id'],
    //         }).text('[' + client['id'] +'] ' + client['name']).appendTo('#client select');
    //     });

    // }});

    var enabledDays = [];

    $.ajax({
    type: "GET",
    dataType: "json",
    method: "GET",
    async: false,
    cache: false,
    url: "api/date",
    success: function(data){
    $.each(data.date, function (i, d) {
        var date = new Date(d).toISOString().slice(0, 10);
        enabledDays.push(date);
    });

    }});

    function onSelectHandler(date, context) {
        /**
         * @date is an array which be included dates(clicked date at first index)
         * @context is an object which stored calendar interal data.
         * @context.calendar is a root element reference.
         * @context.calendar is a calendar element reference.
         * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
         * @context.storage.events is all events associated to this date
         */

        var $element = context.element;
        var $calendar = context.calendar;
        var $time = $('.time').show();
        var text = '';

        if (date[0] !== null) {
            text +=
            date[0].format('YYYY-MM-DD');
        }

        if (date[0] !== null && date[1] !== null) {
            text += ' ~ ';
        }
        else if (date[0] === null && date[1] == null) {
            text += 'nothing';
        }

        if (date[1] !== null) {
            text += date[1].format('YYYY-MM-DD');
        }


        var formattedDate = "";
        formattedDate += '<div class="date" id="formatted-date">';
        formattedDate += '<span class="binds"></span>';
        formattedDate += '<span class="month">' + moment(date[0]).format('MMMM') + '</span>';
        formattedDate += '<h1 class="day">' + moment(date[0]).format('D') + '</h1>';
        formattedDate += '</div> ';

        $('form #time').remove();
        $('#date').remove();
        $('<input>').attr({
            type: 'hidden',
            name: 'date',
            id: 'date',
        }).val(text).insertAfter('#haircut');

        if ( $('form #date').val() == "nothing") {
            $('form #date').remove();
            $('#morning').hide();
            $('#aftermoon').hide();
        }

        $('.time a').remove();
        $('#formatted-date').remove();

        if ( text && text != "nothing" ) {

            $.ajax({
                type: "GET",
                dataType: "json",
                data:{date: text},
                url: "api/booking?date=",
                beforeSend: function() {
                    $('#loading').show();
                    $('#morning').hide();
                    $('#aftermoon').hide();
                },
                success: function(data){

                    $('.time a').remove();
                    $('#formatted-date').remove();

                    $(formattedDate).insertBefore('#morning');

                    $.each(data.time, function (i, val) {

                        if ( val > "11:30") {
                            $('#aftermoon').show();
                        }

                        if ( val <= "11:30" ) {
                            $("<a class=\"button is-light mr-2 mb-2 neco\">" + val  + "</a>").insertAfter("#morning");
                        } else {
                            $("<a class=\"button is-light mr-2 mb-2 neco\">" + val  + "</a>").insertAfter("#aftermoon");
                        }

                        $('.time a').click( function(event) {
                            event.preventDefault();
                            event.stopImmediatePropagation();

                            $(this).siblings().removeClass('is-active');
                            $(this).addClass('is-active');

                            $('#time').remove();
                            $('<input>').attr({
                                type: 'hidden',
                                name: 'time',
                                id: 'time',
                            }).val($(this).text()).insertAfter('#date');

                            $('#calendar').hide();
                            $('.time').hide();

                            $('#back').fadeIn();


                            $('#back-1').hide();

                            $('#booking-inputs').fadeIn();

                            $('#back').click( function() {
                                $('#calendar').fadeIn();
                                $('.time').fadeIn();
                                $('#back').hide();
                                $('#back-1').fadeIn();
                                $('#booking-inputs').hide();
                            });

                        });


                    });
                },
                complete: function() {
                    $('#loading').hide();
                    $('#morning').show();
                },
            });

        }

    }

    $('#calendar').pignoseCalendar({
        lang: 'sk',
        theme: 'dark',
        format: 'DD. MM. YYYY',
        maxDate: '1970-05-05',
        enabledDates: enabledDays,
        week: 1,
        select: onSelectHandler,
    });

});

