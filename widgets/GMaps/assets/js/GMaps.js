/**
 * GMaps
 *
 * @author Guiherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 *
 */

(function ($) {
    
    var map;
    var geometry = null;
    var settings = {
        editable: false,
        showType: "POLYGON",
        points: [],
        mapsOptions: {
            zoom: 8,
            center: [-30.0393227,-51.2325482],
            mapTypeId: google.maps.MapTypeId.SATELLITE
        },
        polygonOptions: {
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35
        }
    };
    
    var methods = {
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
                geometry = new google.maps.Polygon($.extend(settings.polygonOptions,{
                    editable: settings.editable
                }));
                geometry.setMap(map);
                if (settings.editable)
                {
                    google.maps.event.addListener(map, "click", methods.addPoint2Polygon);
                    google.maps.event.addListener(geometry, "mouseup", methods.updateBox);
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
            var path = geometry.getPath();
            path.push(e.latLng);
            geometry.setPath(path);
            methods.updateBox();
        },
        updateBox: function(){
            var path = geometry.getPath().getArray();
            var value = "";
            for(var idx in path)
                value += path[idx].lat()+" "+path[idx].lng()+",";
            value += path[0].lat()+" "+path[0].lng()+",";
            if (settings.showType == "POLYGON")
                value = settings.showType+"(("+value.substr(0,value.length-1)+"))";
            if (settings.showType == "LINESTRING")
                value = settings.showType+"("+value.substr(0,value.length-1)+")";
            $(geometry.getMap().getDiv()).prev().val(value);
            
        },
        updateMap: function(){
            var value = $(geometry.getMap().getDiv()).prev().val();
            if(value.trim() === "")
            {
                geometry.setPath(new google.maps.MVCArray());
                return;
            }
            settings.showType = value.substring(0,value.indexOf("("));
            value = value.substring(value.lastIndexOf("(")+1,value.indexOf(")"));
            var points = value.split(",");
            var path = new google.maps.MVCArray();
            var bounds = new google.maps.LatLngBounds();
            for(var idx in points)
            {
                var pt = points[idx].split(" ");
                var point = new google.maps.LatLng(pt[1],pt[0]);
                path.push(point);
                bounds.extend(point);
            }
            if (geometry != null)
                geometry.setMap(null);
            if (settings.showType == "POLYGON")
            {
                geometry = new google.maps.Polygon($.extend(settings.polygonOptions,{
                    editable: settings.editable
                }));
                geometry.setMap(map);
                if (settings.editable)
                {
                    google.maps.event.addListener(map, "click", methods.addPoint2Polygon);
                    google.maps.event.addListener(geometry, "mouseup", methods.updateBox);
                }
                geometry.setPath(path);
            }
            if (settings.showType == "LINESTRING")
            {
                geometry = new google.maps.Polyline($.extend(settings.polygonOptions,{
                    editable: settings.editable
                }));
                geometry.setMap(map);
                if (settings.editable)
                {
                    google.maps.event.addListener(map, "click", methods.addPoint2Polygon);
                    google.maps.event.addListener(geometry, "mouseup", methods.updateBox);
                }
                geometry.setPath(path);
            }
            if (settings.showType == "POINT")
            {
                geometry = new google.maps.Marker($.extend(settings.polygonOptions,{
                    editable: settings.editable
                }));
                geometry.setMap(map);
//                if (settings.editable)
//                {
//                    google.maps.event.addListener(map, "click", methods.addPoint2Polygon);
//                    google.maps.event.addListener(geometry, "mouseup", methods.updateBox);
//                }
                geometry.setPosition(path.getAt(0));
            }
            if (!bounds.isEmpty())
                map.fitBounds(bounds);
            
        }
    };
    
    var publicMethods = {
        updateMap: function(coords){
            var value = "";
            coords = coords.split("\n");
            var firstCoord = "NaN";
            for(var idx in coords)
            {
                var coord = coords[idx].split(",");
                coord[0] = parseFloat(coord[0]);
                coord[1] = parseFloat(coord[1]);
                if(isNaN(coord[0]) || isNaN(coord[1]))
                    continue;
                
                value += coord[0]+" "+coord[1]+",";
                
                if (isNaN(firstCoord))
                    firstCoord = value;
                
            }
            if (!isNaN(firstCoord))
            {
                value += firstCoord;
                value = value.substr(0,value.length-1);
                value = settings.showType+"(("+value+"))";
            }
            $(geometry.getMap().getDiv()).prev().val(value);
            $(geometry.getMap().getDiv()).prev().change();
            
            return true;
        },
        updateMapByArray: function(type,coords){
            var value = "";
            for(var idx in coords)
            {
                var coord = coords[idx];
                value += coord[0]+" "+coord[1]+",";
            }
            value = value.substr(0,value.length-1);
            value = type+"(("+value+"))";
            console.log(value);
            $(geometry.getMap().getDiv()).prev().val(value);
            $(geometry.getMap().getDiv()).prev().change();
            
            return true;
        },
        clear: function(){
            $(geometry.getMap().getDiv()).prev().val("");
            $(geometry.getMap().getDiv()).prev().change();
        }
    };
    
    $.fn.gmaps = function (options) {
        if (publicMethods[options])
        {
            return publicMethods[options].apply(this,Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) 
        {
            settings = $.extend(options,settings);
            var center = settings.mapsOptions.center;
            settings.mapsOptions.center = new google.maps.LatLng(center[0], center[1]);
            methods.init(this);
            return this;
        }
    }

})(jQuery);