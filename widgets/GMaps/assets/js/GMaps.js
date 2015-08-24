/**
 * GMaps
 *
 * @author Guiherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 *
 */

(function ($) {
    
    var map;
    var input;
    var geometry = null;
    var settings = {
        editable: false,
        points: [],
        mapsOptions: {
            zoom: 8,
            center: [-30.0393227,-51.2325482]
        },
        markerOptions: {
        },
        circleOptions: {
          fillColor: '#337AB7',
          strokeColor: "#337AB7"
        },
        polygonOptions: {
          fillColor: '#337AB7',
          strokeColor: "#337AB7"
        },
        rectangleOptions: {
          fillColor: '#337AB7',
          strokeColor: "#337AB7"
        },
        polylineOptions: {
          strokeColor: "#337AB7"
        }
    };
    
    var methods = {
        init: function ($this) {
            mapDOM = $("<div>").addClass("maps");
            input = $this;
            input.after(mapDOM);
            map = new google.maps.Map(mapDOM[0], $.extend({mapTypeId: google.maps.MapTypeId.SATELLITE},settings.mapsOptions));
            
            if (settings.editable)
            {
                var drawingManager = new google.maps.drawing.DrawingManager({
                  drawingControl: true,
                  drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [
                      google.maps.drawing.OverlayType.MARKER,
                      //google.maps.drawing.OverlayType.CIRCLE,
                      google.maps.drawing.OverlayType.POLYGON,
                      google.maps.drawing.OverlayType.POLYLINE,
                      //google.maps.drawing.OverlayType.RECTANGLE
                    ]
                  },
                  markerOptions:    $.extend({draggable: true},settings.markerOptions),
                  circleOptions:    $.extend({editable: true},settings.circleOptions),
                  polygonOptions:   $.extend({editable: true},settings.polygonOptions),
                  rectangleOptions: $.extend({editable: true},settings.rectangleOptions),
                  polylineOptions:  $.extend({editable: true},settings.polylineOptions)
                });
                google.maps.event.addListener(drawingManager, "circlecomplete", methods.drawCompleted);
                google.maps.event.addListener(drawingManager, "markercomplete", methods.drawCompleted);
                google.maps.event.addListener(drawingManager, "polygoncomplete", methods.drawCompleted);
                google.maps.event.addListener(drawingManager, "polylinecomplete", methods.drawCompleted);
                drawingManager.setMap(map);
            }
            input.change(methods.updateMap);
            input.change();
        },
        //Se mudar o mapa gráfico, atualiza o input escondido
        updateBox: function(){
            
            var value = "";
            if (geometry instanceof google.maps.Polygon || geometry instanceof google.maps.Polyline)
            {
                var path = geometry.getPath().getArray();
                for(var idx in path)
                    value += path[idx].lat()+" "+path[idx].lng()+",";
                if (geometry instanceof google.maps.Polygon)
                {
                    value += path[0].lat()+" "+path[0].lng();
                    value = "POLYGON(("+value+"))";
                }
                if (geometry instanceof google.maps.Polyline)
                    value = "LINESTRING("+value+")";
            }
            if (geometry instanceof google.maps.Marker)
            {
                var position = geometry.getPosition();
                value = "POINT("+position.lat()+ " " +position.lng()+")";
            }
            
            input.val(value);
            
        },
        // Se mudar o input escondido, atualiza o mapa gráfico
        updateMap: function(){
            var value = input.val();
            value = value.replace("\n","");
            while(value.indexOf("  ") != -1)
                value = value.replace("  "," ");
            if(value.trim() === "")
            {
                if (geometry != null)
                    geometry.setPath(new google.maps.MVCArray());
                return;
            }
            var showType = value.substring(0,value.indexOf("("));
            value = value.substring(value.lastIndexOf("(")+1,value.indexOf(")"));
            var points = value.split(",");
            var path = new google.maps.MVCArray();
            var bounds = new google.maps.LatLngBounds();
            for(var idx in points)
            {
                var pt = points[idx].trim().split(" ");
                var point = new google.maps.LatLng(pt[0],pt[1]);
                path.push(point);
                bounds.extend(point);
            }
            if (geometry != null)
                geometry.setMap(null);
            if (showType == "POLYGON" || showType == "LINESTRING")
            {
                if (showType == "POLYGON")
                {
                    geometry = new google.maps.Polygon($.extend(settings.polygonOptions,{
                        editable: settings.editable
                    }));
                }
                if (showType == "LINESTRING")
                {
                    geometry = new google.maps.Polyline($.extend(settings.polygonOptions,{
                        editable: settings.editable
                    }));
                }
                geometry.setMap(map);
                geometry.setPath(path);
                google.maps.event.addListener(path, "set_at", methods.updateBox);
                google.maps.event.addListener(path, "insert_at", methods.updateBox);
                google.maps.event.addListener(path, "remove_at", methods.updateBox);
            }
            if (showType == "POINT")
            {
                geometry = new google.maps.Marker($.extend(settings.polygonOptions,{
                    draggable: settings.editable
                }));
                geometry.setMap(map);
                geometry.setPosition(path.getAt(0));
                google.maps.event.addListener(geometry, "position_changed", methods.updateBox);
            }
            if (!bounds.isEmpty())
                map.fitBounds(bounds);
            
            
        }, 
        
        drawCompleted: function (newGeometry){
            if (geometry != null)
                geometry.setMap(null);
            geometry = newGeometry;
            if (geometry instanceof google.maps.Marker)
            {
                google.maps.event.addListener(geometry, "position_changed", methods.updateBox);
            }
            else
            {
                var path = geometry.getPath();
                google.maps.event.addListener(path, "set_at", methods.updateBox);
                google.maps.event.addListener(path, "insert_at", methods.updateBox);
                google.maps.event.addListener(path, "remove_at", methods.updateBox);
                
            }
            methods.updateBox();
        }
    };
    
    var publicMethods = {
        updateMap: function(coords){
            input.val(coords.toUpperCase());
            input.change();
            
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
            input.val(value);
            input.change();
            
            return true;
        },
        clear: function(){
            input.val("");
            input.change();
        }
    };
    
    $.fn.gmaps = function (options) {
        if (publicMethods[options])
        {
            return publicMethods[options].apply(this,Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof options === 'object' || ! options ) 
        {
            $.extend(settings,options);
            var center = settings.mapsOptions.center;
            settings.mapsOptions.center = new google.maps.LatLng(center[0], center[1]);
            methods.init(this);
            return this;
        }
    }

})(jQuery);