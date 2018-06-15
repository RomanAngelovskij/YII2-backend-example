$(document).on('click', '[data-modal]', function(event){
    event.preventDefault();
    var bind = $(this).data('modal');
    modalBinds[bind]($(this));
})

var modalBinds = {
    /*
     * Редактирование точки маршрута для заказа
     */
    editorderpoint: function (elem) {
        var pointId = $(elem).data('point');
        $.ajax({
            url: '/modals/order/edit-point',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                pointId: pointId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },
    setdrivercar: function (elem) {
        var driverId = $(elem).data('driver');
        $.ajax({
            url: '/modals/taxis/set-driver-car',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                driverId: driverId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },
    orderbuy: function (elem) {
        var orderId = $(elem).data('order');
        $.ajax({
            url: '/modals/order/buy',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                orderId: orderId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },
    additemtoinvoice: function (elem) {
        var invoiceId = $(elem).data('invoice');

        $.ajax({
            url: '/modals/invoices/add-item',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                invoiceId: invoiceId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },
    setpaidinvoice: function (elem) {
        var invoiceId = $(elem).data('invoice');

        $.ajax({
            url: '/modals/invoices/set-paid',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                invoiceId: invoiceId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },
    changecartaxis: function (elem) {
        var orderId = $(elem).data('order');

        $.ajax({
            url: '/modals/order/change-car',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                orderId: orderId
            },
            success: function (response) {
                $('.modal#common-modal .modal-content').html(response);
                $('.modal#common-modal').modal('toggle');
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    },

}