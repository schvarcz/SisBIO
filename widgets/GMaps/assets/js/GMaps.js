/* global google */

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
    var geometries = new google.maps.MVCArray();
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
    var iterations =0;
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
            var value = methods.GoogleGeometryToWkt();
            input.val(value);
            $(".coordsInfo").val(value);
        },
        // Se mudar o input escondido, atualiza o mapa gráfico
        updateMap: function(){
            var value = input.val();
            $(".coordsInfo").val(value);
            value = value.replace("\n","");
            while(value.indexOf("  ") !== -1)
                value = value.replace("  "," ");
            
            if(value.trim() === "")
            {
                //Limpa desenhos.
                geometries.forEach(function(geo){
                    geo.setMap(null);
                });
                return;
            }
            
            geometry = methods.wktToGoogleGeometry(value);
            var geometryMap;
            
            switch(geometry.getType())
            {
                case "Point":
                    geometryMap = new google.maps.Marker($.extend(settings.polygonOptions,{
                        draggable: settings.editable
                    }));
                    geometryMap.setMap(map);
                    geometryMap.setPosition(geometry.get());
                    google.maps.event.addListener(geometryMap, "position_changed", methods.updateBox);
                    google.maps.event.addListener(geometryMap, "rightclick", methods.removeMarker);
                    geometries.push(geometryMap);
                    break;
                case "LineString":
                    geometryMap = new google.maps.Polyline($.extend(settings.polygonOptions,{
                        editable: settings.editable
                    }));
                    geometryMap.setMap(map);
                    geometryMap.setPath(geometry.getArray());
                    var path = geometryMap.getPath();
                    google.maps.event.addListener(path, "set_at", methods.updateBox);
                    google.maps.event.addListener(path, "insert_at", methods.updateBox);
                    google.maps.event.addListener(path, "remove_at", methods.updateBox);
                    google.maps.event.addListener(geometryMap, "rightclick", methods.removeVertex);
                        geometries.push(geometryMap);
                    break;
                case "Polygon":
                    geometryMap = new google.maps.Polygon($.extend(settings.polygonOptions,{
                        editable: settings.editable
                    }));
                    geometryMap.setMap(map);
                    geometryMap.setPaths(methods.linearRing2Array(geometry));
                    var path = geometryMap.getPath();
                    google.maps.event.addListener(path, "set_at", methods.updateBox);
                    google.maps.event.addListener(path, "insert_at", methods.updateBox);
                    google.maps.event.addListener(path, "remove_at", methods.updateBox);
                    google.maps.event.addListener(geometryMap, "rightclick", methods.removeVertex);
                    geometries.push(geometryMap);
                    break;
                case "MultiPoint":
                    geometry.getArray().forEach(function(point){
                        
                        geometryMap = new google.maps.Marker($.extend(settings.polygonOptions,{
                            draggable: settings.editable
                        }));
                        geometryMap.setMap(map);
                        geometryMap.setPosition(point);
                        google.maps.event.addListener(geometryMap, "position_changed", methods.updateBox);
                        google.maps.event.addListener(geometryMap, "rightclick", methods.removeMarker);
                        geometries.push(geometryMap);
                    });
                    break;
                case "MultiLineString":
                    geometry.getArray().forEach(function(lineString){
                        
                        geometryMap = new google.maps.Polyline($.extend(settings.polygonOptions,{
                            editable: settings.editable
                        }));
                        geometryMap.setMap(map);
                        geometryMap.setPath(lineString.getArray());
                        var path = geometryMap.getPath();
                        google.maps.event.addListener(path, "set_at", methods.updateBox);
                        google.maps.event.addListener(path, "insert_at", methods.updateBox);
                        google.maps.event.addListener(path, "remove_at", methods.updateBox);
                        google.maps.event.addListener(geometryMap, "rightclick", methods.removeVertex);
                        geometries.push(geometryMap);
                    });
                    break;
                case "MultiPolygon":
                    
                    geometry.getArray().forEach(function(polygon){
                            geometryMap = new google.maps.Polygon($.extend(settings.polygonOptions,{
                                editable: settings.editable
                            }));
                            geometryMap.setMap(map);
                            geometryMap.setPaths(methods.linearRing2Array(polygon));
                            var path = geometryMap.getPath();
                            google.maps.event.addListener(path, "set_at", methods.updateBox);
                            google.maps.event.addListener(path, "insert_at", methods.updateBox);
                            google.maps.event.addListener(path, "remove_at", methods.updateBox);
                            google.maps.event.addListener(geometryMap, "rightclick", methods.removeVertex);
                            geometries.push(geometryMap);
                    });
                    break;
            }
            var bounds = new google.maps.LatLngBounds();
            function extendBounds(point){
                if(!(point instanceof google.maps.LatLng))
                {
                    point.getArray().forEach(extendBounds);
                }
                else
                {
                    bounds = bounds.extend(point);
                }
            }
            if(!(geometry instanceof google.maps.Data.Point))
            {
                if(geometry instanceof google.maps.Data.Polygon)
                    methods.linearRing2Array(geometry).getArray().forEach(extendBounds);
                else
                    geometry.getArray().forEach(extendBounds);
            }
            else
            {
                map.setCenter(geometry.get());
            }
            
            if (!bounds.isEmpty())
                map.fitBounds(bounds);
        }, 
        drawCompleted: function (newGeometry){
            
            if (newGeometry instanceof google.maps.Marker)
            {
                google.maps.event.addListener(newGeometry, "position_changed", methods.updateBox);
                google.maps.event.addListener(newGeometry, "rightclick", methods.removeMarker);
            }
            else
            {
                //Para quando editar uma linha ou poligono, atualizar o campo texto.
                var path = newGeometry.getPath();
                google.maps.event.addListener(path, "set_at", methods.updateBox);
                google.maps.event.addListener(path, "insert_at", methods.updateBox);
                google.maps.event.addListener(path, "remove_at", methods.updateBox);
                google.maps.event.addListener(newGeometry, "rightclick", methods.removeVertex);
                
            }
            geometries.push(newGeometry);
            methods.updateBox();
        },
        removeMarker: function (mev){
            this.setMap(null);
            var index = 0;
            var toErase = this;
            geometries.forEach(function(el){
                if(el === toErase)
                    geometries.removeAt(index);
                index++;
            });
            methods.updateBox();
        },
        removeVertex: function (mev){
            if (mev.vertex !== null) {
              this.getPath().removeAt(mev.vertex);
              if(this.getPath().getLength() ===0)
              {
                  this.setMap(null);
                  var index = 0;
                  var toErase = this;
                  geometries.forEach(function(el){
                      if(el === toErase)
                          geometries.removeAt(index);
                      index++;
                  });
              }
              methods.updateBox();
            }
        },
        linearRing2Array: function(geometry){
            var ar = geometry.getArray();
            var ret = new google.maps.MVCArray();
            for(var i=0; i<ar.length;i++)
            {
                ret.push( new google.maps.MVCArray(ar[0].getArray()) );
            }
            return ret;
        },
        
        wktToGoogleGeometry: function(value){
            /*
             * Point(1 1)
             * LineString(1 1, 2 2)
             * Polygon((1 1, 2 2, 3 3))
             * Polygon((1 1, 2 2, 3 3), (5 5, 6 6, 7 7))
             * MultiPoint((1 1),(2 2))
             * MultiLineString((1 1, 2 2, 3 3), (5 5, 6 6, 7 7))
             * MultiPolygon( ((1 1, 2 2, 3 3), (5 5, 6 6, 7 7)), ((1 1, 2 2, 3 3), (5 5, 6 6, 7 7)) )
             */
            var showType = value.substring(0,value.indexOf("("));
            var path = methods.wktPointsToMVCArray(showType,value);            
            var geometry = null;
            if (showType === "POINT")
            {
                geometry = new google.maps.Data.Point(path[0]);
            }
            if (showType === "LINESTRING")
            {
                geometry = new google.maps.Data.LineString(path);
            }
            if (showType === "POLYGON")
            {
                geometry = new google.maps.Data.Polygon(path);
            }
            
            
            if (showType === "MULTIPOINT")
            {
                geometry = new google.maps.Data.MultiPoint(path);
            }
            if (showType === "MULTILINESTRING")
            {
                geometry = new google.maps.Data.MultiLineString(path);
            }
            if (showType === "MULTIPOLYGON")
            {
                geometry = new google.maps.Data.MultiPolygon(path);
            }
            
            return geometry;
        },
        GoogleGeometryToWkt:function(){
            geometry = methods.geometryMap2GeometryData();
            var wkt = "";
            if(geometry instanceof google.maps.Data.Point)
            {
                wkt = "Point";
            }
            if(geometry instanceof google.maps.Data.LineString)
            {
                wkt = "LineString";
            }
            if(geometry instanceof google.maps.Data.Polygon)
            {
                wkt = "Polygon";
            }
            
            
            if(geometry instanceof google.maps.Data.MultiPoint)
            {
                wkt = "MultiPoint";
            }
            if(geometry instanceof google.maps.Data.MultiLineString)
            {
                wkt = "MultiLineString";
            }
            if(geometry instanceof google.maps.Data.MultiPolygon)
            {
                wkt = "MultiPolygon";
            }
            if(wkt !== "")
                wkt += methods.MVCArrayToWktPoints(geometry);
            return wkt;
        },
        geometryMap2GeometryData: function(){
            var ret = null;
            var ele = geometries.getAt(0);
            
            if (geometries.getLength() === 1)
            {
                if (ele instanceof google.maps.Marker)
                {
                    ret = new google.maps.Data.Point(ele.getPosition());
                }
                if (ele instanceof google.maps.Polyline)
                {
                    ret = new google.maps.Data.LineString(ele.getPath().getArray());
                }
                if (ele instanceof google.maps.Polygon)
                {
                    ret = new google.maps.Data.Polygon( methods.MVCArrayToArrays( methods.closePolygon(ele.getPaths()) ) );
                }
            }
            else if(geometries.getLength() > 1)
            {
                if (ele instanceof google.maps.Marker)
                {
                    var points = new google.maps.MVCArray();
                    geometries.forEach(function(marker){
                        points.push( marker.getPosition() );
                    });
                    ret = new google.maps.Data.MultiPoint(points.getArray());
                    
                }
                if (ele instanceof google.maps.Polyline)
                {
                    var lines = new google.maps.MVCArray();
                    geometries.forEach(function(polyLine){
                        lines.push( polyLine.getPath().getArray());
                    });
                    ret = new google.maps.Data.MultiLineString(lines.getArray());
                }
                if (ele instanceof google.maps.Polygon)
                {
                    var polygons = new google.maps.MVCArray();
                    geometries.forEach(function(polygon){
                        polygons.push( methods.MVCArrayToArrays( methods.closePolygon(polygon.getPaths()) ) );
                    });
                    ret = new google.maps.Data.MultiPolygon(polygons.getArray());
                } 
            }
            return ret;
        },
        formatLatLng: function(pt){
            return pt.lng()+" " + pt.lat();
        },

        wktPointsToMVCArray: function(geoType,value){
            value = value.substring(value.indexOf("(")+1,value.lastIndexOf(")"));
            
            var path = new google.maps.MVCArray();
            if(value.indexOf("(") === -1)
            {
                //Importa pontos
                var points = value.split(",");
                for(var idx in points)
                {
                    var pt = points[idx].trim().split(" ");
                    var point = new google.maps.LatLng(pt[1],pt[0]);
                    path.push(point);
                }
            }
            else
            {
                var regex = new RegExp(/\(((\(((\-?[0-9]+\.[0-9]+)\s(\-?[0-9]+\.[0-9]+)(\,\s*)?)+\)(\,\s*)*)+)\)/g); //É só eu, ou quando se vê uma expressão Regex da vontade de chorar?
                var regexPart;
                if(regexPart = regex.exec(value))
                {
                    regex.lastIndex = 0;
                    while(regexPart = regex.exec(value))
                    {
                        path.push(methods.wktPointsToMVCArray(geoType,regexPart[0]));
                        regex.lastIndex = regexPart.index+1;
                    }
                }
                else
                {
                    
                    var regex = new RegExp(/\((((\-?[0-9]+\.[0-9]+)\s(\-?[0-9]+\.[0-9]+)(\,\s*)?)+)\)/g); //É só eu, ou quando se vê uma expressão Regex da vontade de chorar?
                    while(regexPart = regex.exec(value))
                    {
                        path.push(methods.wktPointsToMVCArray(geoType,regexPart[0]));
                        regex.lastIndex = regexPart.index+1;
                    }
                }
            }
            return path.getArray();
        },
        MVCArrayToWktPoints: function(geo){
            var ret = "";
            var array = new google.maps.MVCArray();
            
            if (geo instanceof google.maps.Data.Point)
                array.push(geo.get());
            else if(geo instanceof google.maps.Data.LineString)
                array = new google.maps.MVCArray(geo.getArray());
            else if (geo instanceof google.maps.Data.Polygon)
                array = methods.linearRing2Array(geo);
            else if (geo instanceof google.maps.Data.MultiPoint)
            {
                var pts = new google.maps.MVCArray(geo.getArray());
                
                pts.forEach(function(pt){
                    array.push(new google.maps.Data.Point(pt));
                });
            }
            else if (geo instanceof google.maps.Data.MultiLineString)
                array = new google.maps.MVCArray(geo.getArray());
            else if (geo instanceof google.maps.Data.MultiPolygon)
                array = new google.maps.MVCArray(geo.getArray());
            else if(geo instanceof Array)
                array = new google.maps.MVCArray(geo);
            
            array.forEach(function(pt){
                if (ret !== "")
                    ret += ", ";

                if (pt instanceof google.maps.LatLng)
                {
                    ret += methods.formatLatLng(pt);
                    return;
                }
                if (pt instanceof google.maps.Data.Point)
                {
                    ret += methods.formatLatLng(pt.get());
                    return;
                }
                pt = pt.getArray();
                ret += methods.MVCArrayToWktPoints(pt);
            });
            return "("+ret+")";
        },
        MVCArrayToArrays: function(array){
            var ret = [];
            array.forEach(function(pt){
                if (pt instanceof google.maps.MVCArray)
                    ret.push(methods.MVCArrayToArrays(pt));
                else
                    ret.push(pt);
            });
            return ret;
        },
        closePolygon: function(array){
            var arrayLength = array.getLength();
            if (arrayLength > 0 && iterations < 10)
            {
                iterations++;
                if (array.getAt(0) instanceof google.maps.MVCArray)
                    array.forEach(methods.closePolygon);
                else if (! array.getAt(0).equals(array.getAt(arrayLength-1)))
                    array.push( array.getAt(0) );
            }
            return array;
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
    };

})(jQuery);