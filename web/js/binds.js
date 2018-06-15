$(document).ready(function(){
    $.each($('[data-bind]'), function(indx, elem){
        var bind = $(elem).data('bind');
        binds[bind](elem);
    })
})

var binds = {
    route: function (elem) {
        var orderId = $(elem).data('order');
        $.ajax({
            url: '/binds/order/route',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                orderId: orderId,
            },
            beforeSend: function () {
                $(elem).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function (response) {
                $(elem).unblock();
                $(elem).html(response);
            },
            error: function (error) {
                $(elem).unblock();
                $(elem).html('Ошибка загрузки. Детали в консоли');
                console.error(error.responseText);
            }
        })
    },
    drivers_location: function (elem) {
        var driverId = $(elem).data('driver');
        var startDate = $(elem).data('from');
        var finishDate = $(elem).data('to');

        $.ajax({
            url: '/binds/drivers/location',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                id: driverId,
                startDate: startDate,
                finishDate: finishDate
            },
            beforeSend: function () {
                $(elem).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function (response) {
                $(elem).unblock();
                $(elem).html(response);
            },
            error: function (error) {
                $(elem).unblock();
                $(elem).html('Ошибка загрузки. Детали в консоли');
                console.error(error.responseText);
            }
        })
    },
    invoiceitems: function(elem){
        var invoiceId = $(elem).data('invoice');

        $.ajax({
            url: '/binds/invoices/items',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                invoiceId: invoiceId,
            },
            beforeSend: function () {
                $(elem).block({
                    message: '<i class="icon-spinner2 spinner"></i>',
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait',
                        'box-shadow': '0 0 0 1px #ddd'
                    },
                    css: {
                        border: 0,
                        padding: 0,
                        backgroundColor: 'none'
                    }
                });
            },
            success: function (response) {
                $(elem).unblock();
                $(elem).html(response);
            },
            error: function (error) {
                $(elem).unblock();
                $(elem).html('Ошибка загрузки. Детали в консоли');
                console.error(error.responseText);
            }
        })
    }
}