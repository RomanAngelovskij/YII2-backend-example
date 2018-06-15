var autocompleteCitySearchOptions = {
    source: function (request, response) {
        $.ajax({
            url: "/autocomplete/city-search",
            type: "get",
            dataType: "json",
            cache: false,
            data: {
                query: request.term
            },
            success: function (data) {
                if (typeof data.error != 'undefined') {
                    alert(data.error['msg']);
                } else {
                    response($.map(data.cities, function (item) {
                        return {
                            label: item.name + ' (' + item.region + ')',
                            value: item.name + ' (' + item.region + ')',
                            id: item.id
                        }
                    }));
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        });
    },
    select: function (event, ui) {
        var cityIdElementIndex = $(this).data('index');
        $('[name="NewOrder[route][city][' + cityIdElementIndex + ']"]').val(ui.item.id);
    },
    change: function (event, ui) {
    },
    minLength: 2,
    delay: 200
};

function fillStatusActionWrap() {
    var orderId = $('input[name=orderId]').val();
    var statusId = $('select[name=statusId]').val();
    $.ajax({
        url: '/orders/status-action-wrap',
        type: 'get',
        dataType: 'html',
        cache: false,
        data: {
            orderId: orderId,
            statusId: statusId
        },
        success: function (response) {
            $('.modal#payment .modal-content .status-actions-wrap').html(response);
        },
        error: function (error) {
            console.error(error.responseText);
        }
    })
}

$(document).ready(function () {
    /*
     * Datepicker init
     */
    $('.daterange-basic').daterangepicker({
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'DD.MM.YYYY'
            }
        },
        function (start, end) {
            $('.daterange-ranges span').html(start.format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + end.format('DD.MM.YYYY'));
            $('input[name=startDate]').val(start.format('DD.MM.YYYY'));
            $('input[name=finishDate]').val(end.format('DD.MM.YYYY'));
        });

    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2017',
            maxDate: '12/31/2020',
            dateLimit: {days: 60},
            ranges: {
                'Сегодня': [moment(), moment()],
                'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                'Текущий месяц': [moment().startOf('month'), moment().endOf('month')],
                'Предыдущий месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                format: 'DD.MM.YYYY'
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600',
            cancelClass: 'btn-small btn-default'
        },
        function (start, end) {
            $('.daterange-ranges span').html(start.format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + end.format('DD.MM.YYYY'));
            $('input[name=startDate]').val(start.format('DD.MM.YYYY'));
            $('input[name=finishDate]').val(end.format('DD.MM.YYYY'));
        }
    );

    // Display date format
    $('.daterange-ranges span').html(moment().subtract(29, 'days').format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + moment().format('DD.MM.YYYY'));

    /*
     * Окно смены статуса
     */
    $(document).on('click', '.status-modal', function (event) {
        event.preventDefault();

        var orderId = $(this).data('order');

        $.ajax({
            url: '/orders/status-modal',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                orderId: orderId
            },
            success: function (response) {
                $('.modal#payment .modal-content').html(response);
                $('.modal#payment').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    /*
     * Выбор в селекте другого статуса
     */
    $(document).on('change', 'select[name=statusId]', function () {
        fillStatusActionWrap();
    })

    /*
     * Сохранение выбранного статуса
     */
    $(document).on('click', '#do-change-status', function () {
        $('#status-modal-errors').hide();
        var orderId = $('input[name=orderId]').val();
        var statusId = $('select[name=statusId]').val();
        var statusData = $('#status-form').serialize();

        $.ajax({
            url: '/orders/save-status',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                orderId: orderId,
                statusId: statusId,
                statusData: statusData
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0) {
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    })
                    $('#status-modal-errors #errors-list').html(errorsList);
                    $('#status-modal-errors').show();
                } else {
                    $('.modal#payment').modal('toggle');
                    $('#orders-filter-form').trigger('submit');
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        });
    })

    /*
     * Окно изменения времени заказа
     */
    $(document).on('click', '.datetime-modal', function (event) {
        event.preventDefault();

        var orderId = $(this).data('order');

        $.ajax({
            url: '/orders/datetime-modal',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                orderId: orderId
            },
            success: function (response) {
                $('.modal#payment .modal-content').html(response);
                $('.modal#payment').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    /*
     * Сохранение нового времени заказа
     */
    $(document).on('click', '#do-change-datetime', function () {
        $('#status-modal-errors').hide();
        var orderId = $('input[name=orderId]').val();
        var datetime = $('input[name=datetime]').val();

        $.ajax({
            url: '/orders/save-datetime',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                orderId: orderId,
                datetime: datetime
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0) {
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    });
                    $('#datetime-modal-errors #errors-list').html(errorsList);
                    $('#datetime-modal-errors').show();
                } else {
                    $('.modal#payment').modal('toggle');
                    $('#orders-filter-form').trigger('submit');
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    /*
     * Покупка заказа
     */
    $(document).on('click', '#buy-order-modal #buy-order', function () {
        $('#modal-errors').hide();
        var orderId = $('[name=orderId]').val();
        var carId = $('[name=carId]').val();

        $.ajax({
            url: '/order/buy',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                orderId: orderId,
                carId: carId
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0) {
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    });
                    $('#modal-errors #errors-list').html(errorsList);
                    $('#modal-errors').show();
                } else {
                    $('#order_row_' + orderId + ' [data-modal="orderbuy"]').remove();
                    $('.modal#common-modal').modal('toggle');
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    $(document).on('click', '#change-car-modal #change-car', function () {
        $('#modal-errors').hide();
        var orderId = $('[name=orderId]').val();
        var carId = $('[name=carId]').val();

        $.ajax({
            url: '/order/change-car',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                orderId: orderId,
                carId: carId
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0) {
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    });
                    $('#modal-errors #errors-list').html(errorsList);
                    $('#modal-errors').show();
                } else {
                    $('.modal#common-modal').modal('toggle');
                    window.location.reload();
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    $('.modal#payment').on('hidden.bs.modal', function () {
        $('#anytime-both').AnyTime_noPicker();
    })

    /*
     * Добавление точки в маршрут
     */
    $('#add-route-point').on('click', function (event) {
        event.preventDefault();
        var pointsCnt = $('.point-row:last').data('index');
        $.ajax({
            url: '/order/point-row-html',
            type: 'get',
            dataType: 'html',
            data: {
                num: parseInt(pointsCnt)
            },
            success: function (data) {
                $('#point-row-' + pointsCnt).after(data);
                $('#order-form .city-search').autocomplete(autocompleteCitySearchOptions)
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    /*
     * Уджаление точки маршрута
     */
    $(document).on('click', '.remove-point', function (event) {
        event.preventDefault();
        $(this).closest('.point-row').remove();
    })

    /*
     * Поиск города
     */
    $(document).ready(function () {
        $('#order-form .city-search').autocomplete(autocompleteCitySearchOptions)
    })

    $('input#neworder-childseats.switch').on('switchChange.bootstrapSwitch', function (event, state) {
        state ? $('.child-seats-number-wrap').show() : $('.child-seats-number-wrap').hide();
    });
})