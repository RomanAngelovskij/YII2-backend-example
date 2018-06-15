$(document).ready(function () {
    /*
     * Добавление тэга
     */
    $('[name=city-tags]').on('beforeItemAdd', function (event) {
        var cityId = $('[name=city-id]').val();
        var tag = event.item;

        $.ajax({
            url: '/geo/add-city-tag',
            method: 'post',
            dataType: 'json',
            cache: false,
            data: {
                tag: tag,
                cityId: cityId
            },
            success: function (response) {
                console.log(response);
                if (response.success == false){
                    alert(response.error);
                    event.cancel = true;
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })

    $('[name=city-tags]').on('beforeItemRemove', function (event) {
        var cityId = $('[name=city-id]').val();
        var tag = event.item;

        $.ajax({
            url: '/geo/remove-city-tag',
            method: 'post',
            dataType: 'json',
            cache: false,
            data: {
                tag: tag,
                cityId: cityId
            },
            success: function (response) {
                console.log(response);
                if (response.success == false){
                    alert(response.error);
                    event.cancel = true;
                }
            },
            error: function (error) {
                console.error(error.responseText);
            }
        })
    })
})