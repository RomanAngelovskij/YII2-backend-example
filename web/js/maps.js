var routeMap;
var multiRoute;

function initShowRoute() {
    console.log('1');
    /**
     * Создаем мультимаршрут.
     * Первым аргументом передаем модель либо объект описания модели.
     * Вторым аргументом передаем опции отображения мультимаршрута.
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRoute.xml
     * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml
     */
    multiRoute = new ymaps.multiRouter.MultiRoute({
        // Описание опорных точек мультимаршрута.
        referencePoints: routePoints,
        // Параметры маршрутизации.
        params: {
            // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
            results: 3
        }
    }, {
        // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
        boundsAutoApply: true
    });

    // Создаем кнопки для управления мультимаршрутом.
    var trafficButton = new ymaps.control.Button({
        data: {content: "Учитывать пробки"},
        options: {selectOnClick: true}
    });

    // Объявляем обработчики для кнопок.
    trafficButton.events.add('select', function () {
        /**
         * Задаем параметры маршрутизации для модели мультимаршрута.
         * @see https://api.yandex.ru/maps/doc/jsapi/2.1/ref/reference/multiRouter.MultiRouteModel.xml#setParams
         */
        multiRoute.model.setParams({avoidTrafficJams: true}, true);
    });

    trafficButton.events.add('deselect', function () {
        multiRoute.model.setParams({avoidTrafficJams: false}, true);
    });

    // Создаем карту с добавленными на нее кнопками.
    routeMap = new ymaps.Map('order-detail-map', {
        center: [44.948055555556, 34.104166666667],
        zoom: 7,
        controls: [trafficButton]
    }, {
        buttonMaxWidth: 300
    });

    // Добавляем мультимаршрут на карту.
    routeMap.geoObjects.add(multiRoute);
}

function initEditPointMap() {
    pointMap = new ymaps.Map("order-edit-point-map", {
        center: point,
        zoom: 17,
        controls: ['zoomControl']
    }, {
        searchControlResults: 5
    });

    // Создадим экземпляр элемента управления «поиск по карте»
    // с установленной опцией провайдера данных для поиска по организациям.
    var searchControl = new ymaps.control.SearchControl({
        options: {
            provider: 'yandex#search',
            suppressYandexSearch: true,
            useMapBounds: true
        }
    });
    //pointMap.controls.add(searchControl);

    pointPlacemark = new ymaps.Placemark(
        point,
        {hintContent: '', balloonContent: ''},
        {draggable: true}
    );

    pointMap.geoObjects.add(pointPlacemark);
}

/*
 * Построение маршрутов водителей
 */
function initShowDriversLocation() {
    if (typeof myMap != 'undefined') {
        myMap.destroy();
    }
    myMap = new ymaps.Map('drivers-location-map', {
        center: [lastLocation.lat, lastLocation.lng],
        zoom: 12,
        controls: []
    }, {
        buttonMaxWidth: 300
    });
    /*
     * Если надо показать маршрут движения водителя
     */
    if (showRoute) {
        var multiRoute = new ymaps.multiRouter.MultiRoute({
            // Описание опорных точек мультимаршрута.
            referencePoints: processDriverLocations(driverLocations),
            // Параметры маршрутизации.
            params: {
                // Ограничение на максимальное количество маршрутов, возвращаемое маршрутизатором.
                results: 1
            }
        }, {
            // Автоматически устанавливать границы карты так, чтобы маршрут был виден целиком.
            boundsAutoApply: true
        });

        // Добавляем мультимаршрут на карту.
        myMap.geoObjects.add(multiRoute);
    }

    myMap.geoObjects.add(new ymaps.Placemark([lastLocation.lat, lastLocation.lng], {
        balloonContent: '<strong>Дата:</strong> ' + lastLocation.date + '<br>' + '<strong>Время:</strong> ' + lastLocation.time
    }, {
        preset: 'islands#icon',
        iconColor: '#0095b6',
        zIndex: 1000000,
    }))
}

/*
 * Карта с заказами в статусе "Поиск водителя"
 */
function ordersMarketMap() {
    var myMap = new ymaps.Map('orders-market-map', {
            center: [44.948055555556, 34.104166666667],
            zoom: 8,
        }, {
            searchControlProvider: 'yandex#search'
        }),
        objectManager = new ymaps.ObjectManager({
            // Чтобы метки начали кластеризоваться, выставляем опцию.
            clusterize: true,
            // ObjectManager принимает те же опции, что и кластеризатор.
            gridSize: 32,
            clusterDisableClickZoom: true
        });

    // Чтобы задать опции одиночным объектам и кластерам,
    // обратимся к дочерним коллекциям ObjectManager.
    objectManager.objects.options.set('preset', 'islands#greenDotIcon');
    objectManager.clusters.options.set('preset', 'islands#greenClusterIcons');
    myMap.geoObjects.add(objectManager);

    $.ajax({
        url: "/ajax/orders-market",
        cache: false
    }).done(function (data) {
        objectManager.add(data);
    });

}
/*
 * Создание массива точек маршрута водителя
 */
function processDriverLocations(driverLocations) {
    var result = [];
    $.each(driverLocations, function (indx, point) {
        result.push([point.lat, point.lng])
    })

    return result;
}

if (typeof doShowRouteMap !== 'undefined') {
    ymaps.ready(initShowRoute);
}

if (typeof doShowOrdersMarketMap !== 'undefined') {
    ymaps.ready(ordersMarketMap);
}

if (typeof doShowDistancesFormMap !== 'undefined') {
    ymaps.ready(initShowRoute);
}

if (typeof doShowCitiesFormMap !== 'undefined') {
    ymaps.ready(initCitiesFormMap);
}

if (typeof doShowCitiesCreateFormMap !== 'undefined') {
    // ymaps.ready(initCitiesCreateFormMap);
}


function initCitiesFormMap() {
    var point = [
        $('#cities-lat').val() || 44.948055555556,
        $('#cities-lng').val() || 34.104166666667
    ];

    myMap = new ymaps.Map("order-edit-point-map", {
        center: point,
        zoom: 10,
        controls: ['zoomControl']
    }, {
        searchControlResults: 5
    });
    pointPlacemark = new ymaps.Placemark(
        point,
        {hintContent: '', balloonContent: ''},
        {draggable: true}
    );
    myMap.geoObjects.add(pointPlacemark);
    pointPlacemark.events.add('dragend', function (event) {
        var coords = this.geometry.getCoordinates();
        $('#cities-lat').val(coords[0]);
        $('#cities-lng').val(coords[1]);
    }, pointPlacemark);


}

function recalculateRouteLength(route, callback) {
    var moveList = [],
        summa,
        way,
        segments;
    // Получаем массив путей.
    for (var i = 0; i < route.getPaths().getLength(); i++) {
        way = route.getPaths().get(i);
        segments = way.getSegments();
        for (var j = 0; j < segments.length; j++) {
            moveList.push(segments[j].getLength());
        }
    }
    summa = moveList.reduce(function (a, b) {
        return a + b;
    }, 0)
    callback(Math.round(summa / 1000));
}