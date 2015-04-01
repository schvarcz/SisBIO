/**
 * GMaps
 *
 * @author Guiherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 *
 */

(function ($) {
    $.fn.gmaps = function (options) {
        settings = $.extend(settings, options);
        var center = settings.mapsOptions.center;
        settings.mapsOptions.center = new google.maps.LatLng(center[0], center[1]);
        console.log(settings);
        methods.init(this);
        return this;
    }
    var settings = {
        editable: false,
        showType: "POLYGON",
        points: [],
        mapsOptions: {
            zoom: 8,
            center: [-30.0393227,-51.2325482]
        },
        polygonOptions: {
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        }
    };
    var map;
    var polygon;
    methods = {
        /** 
         * Editar polygon
         * Mostrar polygons
         * Add ponto
         * Mostrar nuvem de pontos
         */
        init: function ($this) {
            mapDOM = $("<div>").addClass("maps");
            $this.after(mapDOM);
            map = new google.maps.Map(mapDOM[0], settings.mapsOptions);
            if (settings.showType == "POLYGON")
            {
                polygon = new google.maps.Polygon($.extend(settings.polygonOptions,{
                    editable: settings.editable
                }));
                polygon.setMap(map);
                if (settings.editable)
                {
                    google.maps.event.addListener(map, "click", methods.addPoint2Polygon);
                    google.maps.event.addListener(polygon, "mouseup", methods.updateBox);
                }
            }
            $this.change(methods.updateMap);
            $this.change();
        },
        showPolygon: function () {

        },
        addPoint: function () { 

        },
        addPoint2Polygon: function (e) {
            var path = polygon.getPath();
            console.log(path.getArray());
            path.push(e.latLng);
            polygon.setPath(path);
            methods.updateBox();
        },
        updateBox: function(){
            var path = polygon.getPath().getArray();
            var value = "";
            for(var idx in path)
                value += path[idx].lat()+" "+path[idx].lng()+",";
            value += path[0].lat()+" "+path[0].lng()+",";
            value = settings.showType+"(("+value.substr(0,value.length-1)+"))";
            $(polygon.getMap().getDiv()).prev().val(value);
            
        },
        updateMap: function(){
            var value = $(this).val();
            if(value.trim() == "")
                return;
            value = value.substring(value.lastIndexOf("(")+1,value.indexOf(")"));
            var points = value.split(",");
            var path = new google.maps.MVCArray();
            for(var idx in points)
            {
                var pt = points[idx].split(" ");
                path.push(new google.maps.LatLng(pt[0],pt[1]));
            }
            polygon.setPath(path);
        }
    };

})(jQuery);