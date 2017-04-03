var BASE_URL = 'http://sgl.prodepa.pc';

/* fundo_tela_login - Moda background da tag body se existi container tela_login*/
function fundo_tela_login() {
    if (document.getElementById('tela_login')) {
        $('body').css('background-color', '#EBEFF2');
    }
}

/*
 * @author Joab Torres Alencar
 * @description Está função submite o forumlário de buscar rápida que está no menu principal
 * Menu principal 
 */
function submit_form_navbar() {
    if (document.nSearchSGL) {
        document.nSearchSGL.submit();
    }
}

$(document).ready(function () {
    fundo_tela_login();
});
/*
 * @author Joab Torres Alencar
 *  Alterando filtro no cadastro da cidade (núcleo ou área de atuação);
 */
if (document.getElementById("form-cidade")) {

    function oculta_nucleo(element) {
        if ($(element).val() === "Núcleo") {
            $("#icadNucleo").attr("disabled", 'disable');
        } else {
            $("#icadNucleo").removeAttr("disabled");
        }
    }
}

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
            zoom: 16,
            map: map
        });
    }
    carregaPonto(latitude, longitude);
}

/*
 * @author Joab Torres <joabtorres1508@gmail.com>
 * Está função executa quando é selecionado uma cidade via select e consulta o json 'ap.json' e carrega uns options no select do AP
 * @public selectCidade()
 */


function selectCidade() {
    var valor = $("#iCidade").val();
    $.getJSON(BASE_URL + '/assets/json/ap.json', function (ap) {
        var resultado = '';
        for (var x  in ap[valor]) {
            if (ap[valor][x]['cod'] == selectAp) {
                resultado += '<option value="' + ap[valor][x]['cod'] + '" selected="true">' + ap[valor][x]['nome'] + '</option>';
            } else {
                resultado += '<option value="' + ap[valor][x]['cod'] + '">' + ap[valor][x]['nome'] + '</option>';
            }
        }
        $("#iAP").html(resultado);
    });
}

$(document).ready(function () {
    //seleciona ap da cidade
    selectCidade();
    //oculta o arlert de mensagem
    $("[data-hide]").on("click", function () {
        $("#alert-msg").toggle().addClass('oculta');
    });

    //Mapa de marcação geografica
    if (document.getElementById("viewMapa")) {
        var map;
        var marker;

        function initialize() {
            if (getLatitude != null && getLongitude != null) {
                var latlng = new google.maps.LatLng(getLatitude, getLongitude);
            } else {
                var latlng = new google.maps.LatLng(-4.2639141, -55.998396);
            }
            var options = {
                zoom: 13,
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
                        $('#iLatitude').val(latitude);
                        $('#iLongitude').val(longitude);

                        var location = new google.maps.LatLng(latitude, longitude);
                        marker.setPosition(location);
                        map.setCenter(location);
                        map.setZoom(13);
                    }
                }
            });
        }
        if ($('#iLatitude').val() == "" && $('#iLongitude').val() == "") {
            carregarNoMapa($("#iCidade option:selected").text());
        }
        //carrega a cidade selecionada
        $('#iCidade').change(function () {
            carregarNoMapa($("#iCidade option:selected").text());
        });

        google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('#iLatitude').val(marker.getPosition().lat());
                        $('#iLongitude').val(marker.getPosition().lng());
                    }
                }
            });
        });
    }

});


/**
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
 */

if (document.getElementById("container-usuario-form")) {
    /**
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
     */
    readURL = function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var num = input.name.replace("tImagem-", "");
            reader.onload = function (e) {
                $("#viewImagem-" + num).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };
    /**
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @description Este codigo abaixo é responsável para fazer o carregamento da imagem setada pelo usuário ao muda a foto do perfil
     */
    readDefaultURL = function () {
        var valor = $('input[name=nSexo]:checked').val();
        if (valor === "Masculino") {
            $("#viewImagem-1").attr('src', '/imagens/user_masculino.png');
        } else {
            $("#viewImagem-1").attr('src', '/imagens/user_feminino.png');

        }
    };
}