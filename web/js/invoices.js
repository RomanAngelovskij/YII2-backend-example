$(document).ready(function () {
    $(document).on('click', '#add-item-to-invoice', function (event) {
        var invoiceId = $('[name=invoiceId]').val();
        var itemId = $('[name=itemId]').val();

        $.ajax({
            url: '/ajax/invoices-add-item',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                invoiceId: invoiceId,
                itemId: itemId
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0){
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    })
                    $('#status-modal-errors #errors-list').html(errorsList);
                    $('#status-modal-errors').show();
                } else {
                    $('.modal#common-modal').modal('toggle');
                    binds['invoiceitems']($('#invoice-items-tbl'));
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    $(document).on('change', '.invoice-item input.count, .invoice-item input.price', function () {
        var val = $(this).val();
        if (val < 1){
            $(this).val(1);
        }

        var itemId = $(this).closest('.invoice-item').data('item');
        var countElement = $(this).closest('.invoice-item').find('.count');
        var priceElement = $(this).closest('.invoice-item').find('.price');
        var count = $(countElement).is('input') ? $(countElement).val() : $(countElement).text();
        var price = $(priceElement).is('input') ? $(priceElement).val() : $(priceElement).text();

        $.ajax({
            url: '/ajax/change-item',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                itemId: itemId,
                count: count,
                price: price
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0){
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList +=  error + "\n";
                    })
                    alert(errorsList);
                } else {
                    binds['invoiceitems']($('#invoice-items-tbl'));
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
        
        calculateInvoiceTotals();
    })

    $(document).on('click', '#save-invoice', function (event) {
        event.preventDefault();
        var invoiceNum = $(this).data('invoice');

        if (confirm('После сохранения, вы не сможете редактировать счет. Сохранить?')){
            $.ajax({
                url: '/ajax/save-invoice',
                type: 'post',
                dataType: 'json',
                cache: false,
                data: {
                    invoiceNum: invoiceNum,
                },
                success: function (response) {
                    console.log(response);
                    if (response.errors.length > 0){
                        var errorsList = '';
                        $.each(response.errors, function (index, error) {
                            errorsList +=  error + "\n";
                        })
                        alert(errorsList);
                    } else {
                        binds['invoiceitems']($('#invoice-items-tbl'));
                    }
                },
                error: function (error) {
                    console.error(error.responseText);
                }
            })
        }
    })

    $(document).on('click', '#set-paid-invoice', function (event) {
        var invoiceId = $('[name=invoiceId]').val();
        var date = $('#paid-date').val();

        $.ajax({
            url: '/ajax/invoice-set-paid',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                invoiceId: invoiceId,
                date: date
            },
            success: function (response) {
                console.log(response);
                if (response.errors.length > 0){
                    var errorsList = '';
                    $.each(response.errors, function (index, error) {
                        errorsList += '<li>' + error + '</li>';
                    })
                    $('#status-modal-errors #errors-list').html(errorsList);
                    $('#status-modal-errors').show();
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
})

function calculateInvoiceTotals() {
    var invoiceTotal = 0;
    var invoiceNds = 0;
    var invoiceTotalPay = 0;
    $.each($('tr.invoice-item'), function (indx, row) {
        var price = $(row).find('.price').is('input') ? $(row).find('.price').val() : $(row).find('.price').text();
        var count = $(row).find('.count').is('input') ? $(row).find('.count').val() : $(row).find('.count').text();
        var total = parseFloat(price)*parseInt(count);
        invoiceTotal += total;
        invoiceTotalPay += total;
        $(row).find('.total').text(number_format(total, 2, '.'));
    })

    $('.invoice-total').text(number_format(invoiceTotal, 2, '.'));
    $('.invoice-nds').text(number_format(invoiceTotal/100*18, 2, '.'));
    $('.invoice-total-pay').text(number_format(invoiceTotalPay, 2, '.'));
}