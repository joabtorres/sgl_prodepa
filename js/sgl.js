/* fundo_tela_login - Moda background da tag body se existi container tela_login*/
function fundo_tela_login() {
    if(document.getElementById('tela_login')){
        $('body').css('background-color', '#EBEFF2');
    }
}
/*
* @author Joab Torres Alencar
* @description Está função submite o forumlário de buscar rápida que está no menu principal
* Menu principal 
*/
function submit_form_navbar(){
    if(document.nSearchSGL){
        document.nSearchSGL.submit();
    }
}

$(document).ready(function(){
    fundo_tela_login();
});

/**
 * PÁGINA CADASTRAR UNIDADE - MAPA
 */

if (document.getElementById("view-mapa-unidade")) {
    var map;
    function initialize() {
        var latlng = new google.maps.LatLng(-4.2639141, -55.998396);

        var options = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("view-mapa-unidade"), options);
    }
    initialize();
    
    function carregaPonto(latitude, longitude) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude, longitude),
            title: "Cliente!",
            zoom:16,
            map: map
        });
    }
    carregaPonto(latitude,longitude);
}

//Google Map
$(document).ready(function () {
    if (document.getElementById("viewMapa")) {
        var map;
        var marker;
        function initialize() {
            var latlng = new google.maps.LatLng(-4.2639141, -55.998396);
            var options = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("viewMapa"), options);

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true
            });

            marker.setPosition(latlng);
        }

        initialize();
        function carregarNoMapa(endereco) {
            geocoder.geocode({'address': endereco + ', Brasil', 'region': 'BR'}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();

                        $('#iEndereco').val(results[0].formatted_address);
                        $('#iLatitude').val(latitude);
                        $('#iLongitude').val(longitude);

                        var location = new google.maps.LatLng(latitude, longitude);
                        marker.setPosition(location);
                        map.setCenter(location);
                        map.setZoom(16);
                    }
                }
            });
        }

        $("#btiEndereco").click(function () {
            if ($(this).val() != "")
                carregarNoMapa($("#iEndereco").val());
        });

        $("#iEndereco").blur(function () {
            if ($(this).val() != "")
                carregarNoMapa($(this).val());
        });

        google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#iEndereco').val(results[0].formatted_address);
                        $('#iLatitude').val(marker.getPosition().lat());
                        $('#iLongitude').val(marker.getPosition().lng());
                    }
                }
            });
        });
    }

});