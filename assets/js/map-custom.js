(function($) {
    "use strict";
    var map=jQuery('#map');
    var mapIcon=map.data('map-icon');
    var mapLatitute=map.data('map-latitute');
    var mapLongitute=map.data('map-longitude');
    var mapZoom=map.data('map-zoom');
    $("#map").gMap( {
        scrollwheel:false,
        latitude:mapLatitute,
        longitude:mapLongitute,
        markers:[ {
            latitude: mapLatitute, 
            longitude: mapLongitute,
        }, ],
        icon: {
            image: mapIcon, iconsize: [26, 46], iconanchor: [12, 46]
        }, 
        zoom:mapZoom
    });
})(jQuery);