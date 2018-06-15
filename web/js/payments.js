function calculateReward() {
    var totalReward = 0;
    $.each($('.select-order:checked'), function (indx, elem) {
        totalReward += $(elem).data('reward');
    })

    $('.reward-amount').text(totalReward + ' руб.');
}

$(document).ready(function(){
    $(document).on('change', '.select-order', function () {
        calculateReward();
    });

    $(document).on('click', '.do-payment', function (event) {
        event.preventDefault();
        var creatorId = $(this).data('creator');
        var creatorType = $(this).data('type');

        $.ajax({
            url: '/payments/payment-modal',
            type: 'get',
            dataType: 'html',
            cache: false,
            data: {
                creatorId: creatorId,
                creatorType: creatorType
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

    $(document).on('change', 'input[name=select-all]', function () {
        var checked = $(this).prop('checked');
        $('.select-order').prop('checked', checked);
        calculateReward();
    })

    $(document).on('click', '#paid', function (event) {
        event.preventDefault();
        var orders = [];
        var sum = 0;
        var creatorType = $('input[name=creatorType]').val();
        var creatorId = $('input[name=creatorId]').val();
        var paymentSystemId = $('input[name=paymentSystemId]').val();

        $.each($('.select-order:checked'), function (indx, elem) {
            orders.push($(elem).val());
            sum += $(elem).data('reward');
        })

        $.ajax({
            url: '/payments/mark-paid',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                orders: orders,
                sum: sum,
                creatorType: creatorType,
                creatorId: creatorId,
                paymentSystemId: paymentSystemId
            },
            success: function (response) {
                console.log(response);
                location.reload();
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })
})