$(document).ready(function () {
    $(document).on('click', '.notification-item', function (e) {
        var itemElem = $(this);
        var id = $(this).data('id');
        $.ajax({
            url: '/notifications/default/mark-read',
            method: 'POST',
            dataType: 'json',
            cache: false,
            data: {
                id: id
            },
            success: function (response) {
                console.log(response);
                if (response.success == true){
                    itemElem.hide();
                    var count = $('#notifications-count').text();
                    $('#notifications-count').text(parseInt(count)-1);
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })
})