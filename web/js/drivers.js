$(document).ready(function () {
    /*
     * Назначение машины, водителю таксопарка
     */
    $(document).on('click', '.set-driver-car', function () {
        if (!confirm('Назначить этот автомобиль?')){
            return false;
        }

        var carId = $(this).data('car');
        var driverId = $('input[name=driverId]').val();

        $.ajax({
            url: '/ajax/taxis-set-driver-car',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                driverId: driverId,
                carId: carId
            },
            success: function (response) {
                if (response.success == false){
                    if (typeof response.error != 'undefined'){
                        $('#modal-errors #errors-list').html(response.error);
                        $('#modal-errors').show();
                    }
                } else {
                    $('.modal#common-modal').modal('toggle');
                    location.reload();
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    /*
     * Открепление водителя таксопарка от машины
     */
    $(document).on('click', '.unset-driver-car', function (event) {
        event.preventDefault();
        var carId = $(this).data('car');

        $.ajax({
            url: '/ajax/taxis-unset-driver-car',
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                carId: carId
            },
            success: function (response) {
                if (response.success == false){
                    if (typeof response.error != 'undefined'){
                        alert(response.error);
                    }
                } else {
                    location.reload();
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    $(document).on('click', '#reload-driver-location', function () {
        var driverId = $(this).data('driver');
        console.log('SEND REQUEST FOR DRIVER ' + driverId);
        $.ajax({
            url: '/ajax/whereis-driver',
            type: 'get',
            dataType: 'json',
            cache: false,
            data: {
                driverId: driverId
            },
            beforeSend: function () {
                $('#driver-locations-map-wrap').block({
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
                $('#driver-locations-map-wrap').unblock();
                if (response.success == false){
                    if (typeof response.error != 'undefined'){
                        alert(response.error);
                    }
                } else {
                    binds['drivers_location']($('#driver-locations-map-wrap'));
                }
            },
            error: function (error) {
                $('#driver-locations-map-wrap').unblock();
                console.error(error.responseText);
            }
        })
    })

    $('[name=apply-params]').on('click', function(){
        binds['drivers_location']($('#driver-locations-map-wrap'));
    })
})