$('#distances-form .city-search').autocomplete({
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
                            lat: item.lat,
                            lng: item.lng,
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
        var cityIdElementId = $(this).data('elem');
        $('#' + cityIdElementId).val(ui.item.id);
        $('[name=' + cityIdElementId +'_lat]').val(ui.item.lat);
        $('[name=' + cityIdElementId +'_lng]').val(ui.item.lng);
        processRoutePoints();
        routeMap.geoObjects.removeAll();
        multiRoute = new ymaps.multiRouter.MultiRoute({
            referencePoints: routePoints,
            params: {
                results: 3
            }
        }, {
            boundsAutoApply: true
        });
        routeMap.geoObjects.add(multiRoute);
    },
    change: function (event, ui) {
    },
    minLength: 2,
    delay: 200
});

/*
 * Поиск дистанций
 */
$('#distances-form-search .city-search').autocomplete({
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
        $('.city-b-search').show();
        var cityIdElementId = $(this).data('elem');
        $('#' + cityIdElementId).val(ui.item.id);
    },
    change: function (event, ui) {
    },
    minLength: 2,
    delay: 200
});

/*
 * Удаление id города из hidden поля
 */
$('#distances-form .city-search').on('change', function () {
    var cityIdElementId = $(this).data('elem');
    var value = $(this).val();

    if (value.length == 0){
        $('#' + cityIdElementId).val('');
    }
})

$(document).ready(function () {
    if ($('[name=city_a_lng]').length > 0){
        processRoutePoints();
    }
})

function processRoutePoints(){
    routePoints = [[$('[name=city_a_lat]').val(), $('[name=city_a_lng]').val()], [$('[name=city_b_lat]').val(), $('[name=city_b_lng]').val()]];
}

