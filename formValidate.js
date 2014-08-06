$(document).ready(function() {
    var account_name = "cgll";

    createDropdown(account_name);

    var map = L.map('map').setView([45.403108, -84.672363], 5);
    var mapquest = new MQ.mapLayer();
    mapquest.addTo(map);

    var drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);
    var drawControl = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems,
            edit: false
        },
        position: 'topright',
        draw: {
            polyline: false,
            polygon: false,
            rectangle: false,
            circle: false
        }
    });
    map.addControl(drawControl);

    map.on('draw:created', function (e) {
        var type = e.layerType,
            layer = e.layer;

        if (type === 'marker') {
            layer.bindPopup('Coordinates listed below');
        }
        var lat = layer._latlng.lat;
        var lng = layer._latlng.lng;
        drawnItems.addLayer(layer);

        $('#latitude').val(lat);
        $('#longitude').val(lng);

    });
//----------------------------------------------------------------
    var map2 = L.map('map2').setView([45.403108, -84.672363], 5);
    var mapquest2 = new MQ.mapLayer();
    mapquest2.addTo(map2);

    var drawnItems2 = new L.FeatureGroup();
    map2.addLayer(drawnItems2);
    var drawControl2 = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems2,
            edit: false
        },
        position: 'topright',
        draw: {
            polyline: false,
            polygon: false,
            rectangle: false,
            circle: false
        }
    });
    map2.addControl(drawControl2);

    map2.on('draw:created', function (e) {
        var type = e.layerType,
            layer = e.layer;

        if (type === 'marker') {
            layer.bindPopup('Coordinates listed below');
        }
        var lat = layer._latlng.lat;
        var lng = layer._latlng.lng;
        drawnItems2.addLayer(layer);

        $('#latitude2').val(lat);
        $('#longitude2').val(lng);

    });
//----------------------------------------------------------------

    var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    var osm = new L.TileLayer(osmUrl);
    var map3 = L.map('map3').setView([45.403108, -84.672363], 5);
    var mapquest3 = new MQ.mapLayer();
    mapquest3.addTo(map3);

    var drawnItems3 = new L.FeatureGroup();
    map3.addLayer(drawnItems3);
    var drawControl3 = new L.Control.Draw({
        edit: {
            featureGroup: drawnItems3,
            edit: false
        },
        position: 'topright',
        draw: {
            polyline: false,
            polygon: false,
            rectangle: false,
            circle: false
        }
    });
    map3.addControl(drawControl3);

    map3.on('draw:created', function (e) {
        var type = e.layerType,
            layer = e.layer;

        if (type === 'marker') {
            layer.bindPopup('Coordinates listed below');
        }
        var lat = layer._latlng.lat;
        var lng = layer._latlng.lng;
        drawnItems3.addLayer(layer);

        $('#latitude3').val(lat);
        $('#longitude3').val(lng);

    });
    $('#stew').on('click', function(){
        L.Util.requestAnimFrame(map.invalidateSize,map,!1,map._container);
    });
    $('#inst').on('click', function(){
        L.Util.requestAnimFrame(map2.invalidateSize,map2,!1,map2._container);
    });
    $('#work').on('click', function(){
        L.Util.requestAnimFrame(map3.invalidateSize,map3,!1,map3._container);
    });

//----------------------------------------------------------------  
    $('.mapUpdate').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'The name is not valid',
                validators: {
                    notEmpty: {
                        message: 'The name field is required and cannot be empty'
                    },
                    stringLength: {
                        min: 1,
                        max: 50,
                        message: 'The name must be less than 50 characters long'
                    }
                    ,regexp: {
                        regexp: /^[a-zA-Z0-9_ ]+$/,
                        message: 'The name can only consist of alphabetical, number and underscore'
                    }
                }
            },
            photolink: {
                validators: {
                    notEmpty: {
                        message: 'The photo link field is required and cannot be empty. Note: must start with http://'
                    }
                }
            },
            location: {
                validators: {
                    notEmpty: {
                        message: 'Location is required'
                    }
                }
            }
        }
    });
});

//Dropdown creation


function createDropdown(account_input){
    var sql_input = 'SELECT name from institution ORDER BY name';
    $.ajax({ 
        async: false, 
        url: 'http://' + account_input + '.cartodb.com/api/v2/sql/?q=' + sql_input, 
        dataType: "json", 
        success: function(data) {

            $.each(data.rows, function(index, val) {
                
                $('#institutionName').append('<option value="' + val.name + '">' + val.name + '</option>');

            });
        } 
    });
}