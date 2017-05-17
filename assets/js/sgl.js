var BASE_URL = 'http://sgl.prodepa.pc';
/**
 * 
 * @author Joab Torres Alencar
 * @description Só carrega o conteudo da página após seu total carregamento
 */
function mostrarConteudo() {
    var elemento = document.getElementById("tela_load");
    elemento.style.display = "none";
    var elemento = document.getElementById("tela_sistema");
    if (elemento) {
        elemento.style.display = "block";
    }
    var elemento = document.getElementById("tela_login");
    if (elemento) {
        elemento.style.display = "block";
    }
}

/**
 * 
 * @author Joab Torres Alencar
 * @description Executa ações após o carreamento da página
 */
$(document).ready(function () {
    //ativa estilo e js do plugin select2
    $('select').select2({
        placeholder: "Selecione",
        allowClear: true
    });
});
/*
 * @author Joab Torres Alencar
 * @description Está função submite o forumlário de buscar rápida que está no menu principal
 */
function submit_form_navbar() {
    if (document.nSearchSGL) {
        document.nSearchSGL.submit();
    }
}

//oculta o arlert de mensagem
$("[data-hide]").on("click", function () {
    $("#alert-msg").toggle().addClass('oculta');
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
 * @author Joab Torres Alencar
 * Pagina: Unidade Detalhada
 */
//mapa
if (document.getElementById("view-mapa-unidade")) {
    var map;
    function initialize() {
        if (latitude != null && longitude != null) {
            var latlng = new google.maps.LatLng(latitude, longitude);
        } else {
            var latlng = new google.maps.LatLng(-4.2639141, -55.998396);
        }


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

/**
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @description Este trecho de código abaixa e relacionado ao cadastro e edição  no formulario da unidade
 */
if (document.getElementById('form-unidade')) {
    /*
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @public selectCidade()
     * @description Está função executa quando é selecionado uma cidade via select e consulta o json 'ap.json' 'redemetro.json';
     */

    function selectCidade() {
        var valor = $("#iCidade").val();
        $.getJSON(BASE_URL + '/assets/json/ap.json', function (ap) {
            var resultado = '<option value=""></option>';
            for (var x  in ap[valor]) {
                if (ap[valor][x]['cod'] == selectAp) {
                    resultado += '<option value="' + ap[valor][x]['cod'] + '" selected="true" class="text-uppercase">' + ap[valor][x]['nome'] + '</option>';
                } else {
                    resultado += '<option value="' + ap[valor][x]['cod'] + '" class="text-uppercase">' + ap[valor][x]['nome'] + '</option>';
                }
            }
            $("#iAP").html(resultado);
        });
        $.getJSON(BASE_URL + '/assets/json/redemetro.json', function (redemetro) {
            var resultado = '<option value=""></option>';
            for (var x  in redemetro[valor]) {
                if (redemetro[valor][x]['cod'] == selectRedMetro) {
                    resultado += '<option value="' + redemetro[valor][x]['cod'] + '" selected="true" class="text-uppercase">' + redemetro[valor][x]['nome'] + '</option>';
                } else {
                    resultado += '<option value="' + redemetro[valor][x]['cod'] + '" class="text-uppercase">' + redemetro[valor][x]['nome'] + '</option>';
                }
            }
            $("#iRedeMetro").html(resultado);
        });
        //tipo de conexao
        if ($("#iConexao").val() === "Fibra") {

            $("#iAP").attr('disabled', 'true');
            $("#iRedeMetro").removeAttr('disabled');
        } else {
            $("#iRedeMetro").attr('disabled', 'true');
            $("#iAP").removeAttr('disabled');
        }
    }
    /**
     * Aplicando mascaras
     */
    function aplicarMascara() {
        $('.input-date').mask("99/99/9999", {placeholder: "mm/dd/yyyy"});
        $('.input-telefone').mask("(999) 9999-9999");
        $('.input-celular').mask("(999) 99999-9999");
        $('select').select2({
            placeholder: "Selecione",
            allowClear: true
        });
    }
    $(document).ready(function () {
        aplicarMascara();
        /**
         * Quando é selecionado o tipo de conexão [rádio ou fibra]
         */
        $("#iConexao").change(function () {
            if ($("#iConexao").val() === "Fibra") {

                $("#iAP").attr('disabled', 'true');
                $("#iRedeMetro").removeAttr('disabled');
            } else {
                $("#iRedeMetro").attr('disabled', 'true');
                $("#iAP").removeAttr('disabled');
            }
        });
        //seleciona ap da cidade
        selectCidade();
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
    function add_contrato() {
        var elemento = document.getElementById("iQtdContrato");
        var qtd = elemento.value;
        elemento.value = parseInt(qtd) + 1;
        var viewContato = document.getElementsByClassName("container_cad_contrato");
        if (viewContato.length > 0) {
            qtd = parseInt(qtd) + 1;
            container = document.querySelector("#icadContrato");
            div = document.createElement('div');
            div.setAttribute('class', 'row container_cad_contrato');
            div.setAttribute('id', 'contrato_' + qtd);
            hr = document.createElement('hr');
            div.appendChild(hr);
            div_numero = document.createElement('div');
            div_numero.setAttribute('class', 'col-md-4 form-group');
            label_numero = document.createElement('label');
            label_numero.setAttribute('for', 'iNumeroContrato' + qtd);
            label_numero.appendChild(document.createTextNode("Número do Contrato: "));
            input_numero = document.createElement('input');
            input_numero.setAttribute('type', 'text');
            input_numero.setAttribute('name', 'nNumeroContrato' + qtd);
            input_numero.setAttribute('id', 'iNumeroContrato' + qtd);
            input_numero.setAttribute('class', 'form-control');
            input_numero.setAttribute('placeholder', 'Exemplo: 0001/2016');
            div_numero.appendChild(label_numero);
            div_numero.appendChild(input_numero);
            div_tipo = document.createElement('div');
            div_tipo.setAttribute('class', 'col-md-8 form-group');
            label_tipo = document.createElement('label');
            label_tipo.setAttribute('for', 'iTipoContratro' + qtd);
            label_tipo.appendChild(document.createTextNode("Tipo de Contrato: "));
            select_tipo = document.createElement('select');
            select_tipo.setAttribute('id', 'iTipoContratro' + qtd);
            select_tipo.setAttribute('name', 'nTipoContratro' + qtd);
            select_tipo.setAttribute('class', 'form-control');
            option_null = document.createElement('option');
            option_null.setAttribute('value', '');
            option_act = document.createElement('option');
            option_act.setAttribute('value', 'ACT - Acordo de Cooperação Técnica');
            option_act.appendChild(document.createTextNode('ACT - Acordo de Cooperação Técnica'));
            option_actf = document.createElement('option');
            option_actf.setAttribute('value', 'ACTF - Acordo de Cooperação Técnico e Financeiro');
            option_actf.appendChild(document.createTextNode('ACTF - Acordo de Cooperação Técnico e Financeiro'));
            option_c = document.createElement('option');
            option_c.setAttribute('value', 'C - Contrato');
            option_c.appendChild(document.createTextNode('C - Contrato'));
            select_tipo.appendChild(option_null);
            select_tipo.appendChild(option_act);
            select_tipo.appendChild(option_actf);
            select_tipo.appendChild(option_c);
            div_tipo.appendChild(label_tipo);
            div_tipo.appendChild(select_tipo);
            div_data_inicial = document.createElement('div');
            div_data_inicial.setAttribute('class', 'col-md-6 form-group');
            label_data_inicial = document.createElement('label');
            label_data_inicial.setAttribute('for', 'iDataInicial' + qtd);
            label_data_inicial.appendChild(document.createTextNode("Data Inicial: "));
            input_data_inicial = document.createElement('input');
            input_data_inicial.setAttribute('type', 'text');
            input_data_inicial.setAttribute('name', 'nDataInicial' + qtd);
            input_data_inicial.setAttribute('id', 'iDataInicial' + qtd);
            input_data_inicial.setAttribute('class', 'form-control input-date');
            input_data_inicial.setAttribute('placeholder', 'Exemplo: 20/05/2011');
            div_data_inicial.appendChild(label_data_inicial);
            div_data_inicial.appendChild(input_data_inicial);
            div_data_vigencia = document.createElement('div');
            div_data_vigencia.setAttribute('class', 'col-md-6 form-group');
            label_data_vigencia = document.createElement('label');
            label_data_vigencia.setAttribute('for', 'iDataVigencia' + qtd);
            label_data_vigencia.appendChild(document.createTextNode("Data de Vigência: "));
            input_data_vigencia = document.createElement('input');
            input_data_vigencia.setAttribute('type', 'text');
            input_data_vigencia.setAttribute('name', 'nDataVigencia' + qtd);
            input_data_vigencia.setAttribute('id', 'iDataVigencia' + qtd);
            input_data_vigencia.setAttribute('class', 'form-control input-date');
            input_data_vigencia.setAttribute('placeholder', 'Exemplo: 20/06/2014');
            div_data_vigencia.appendChild(label_data_vigencia);
            div_data_vigencia.appendChild(input_data_vigencia);
            div.appendChild(div_numero);
            div.appendChild(div_tipo);
            div.appendChild(div_data_inicial);
            div.appendChild(div_data_vigencia);
            container.insertBefore(div, container.firstElementChild);
            aplicarMascara();
        }
    }
    function remover_contrato() {
        var elemento = document.getElementById("iQtdContrato");
        var qtd = parseInt(elemento.value);
        if (qtd > 1) {
            $("#contrato_" + qtd).remove();
            elemento.value = qtd - 1;
        }
    }
    /*
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @public esta função adiciona campos para preenchimento de um ou mais contato
     */
    function add_contato() {
        var elemento = document.getElementById("iQtdContato");
        var qtd = elemento.value;
        elemento.value = parseInt(qtd) + 1;
        var viewContato = document.getElementsByClassName("container_cad_contato");
        if (viewContato.length > 0) {
            qtd = parseInt(qtd) + 1;
            container = document.querySelector("#iCadContato");
            div = document.createElement('div');
            div.setAttribute('class', 'row container_cad_contato');
            div.setAttribute('id', 'contato_' + qtd);
            hr = document.createElement('hr');
            div.appendChild(hr);
            div_nome = document.createElement('div');
            div_nome.setAttribute('class', 'col-md-6 form-group');
            label_nome = document.createElement('label');
            label_nome.setAttribute('for', 'iNome' + qtd);
            label_nome.appendChild(document.createTextNode("Nome: "));
            input_nome = document.createElement('input');
            input_nome.setAttribute('type', 'text');
            input_nome.setAttribute('name', 'nNome' + qtd);
            input_nome.setAttribute('id', 'iNome' + qtd);
            input_nome.setAttribute('class', 'form-control');
            input_nome.setAttribute('placeholder', 'Exemplo: Joab T. Alencar');
            div_nome.appendChild(label_nome);
            div_nome.appendChild(input_nome);
            div_email = document.createElement('div');
            div_email.setAttribute('class', 'col-md-6 form-group');
            label_email = document.createElement('label');
            label_email.setAttribute('for', 'iEmail' + qtd);
            label_email.appendChild(document.createTextNode("E-mail: "));
            input_email = document.createElement('input');
            input_email.setAttribute('type', 'email');
            input_email.setAttribute('name', 'nEmail' + qtd);
            input_email.setAttribute('id', 'iEmail' + qtd);
            input_email.setAttribute('class', 'form-control');
            input_email.setAttribute('placeholder', 'Exemplo: usuario@live.com');
            div_email.appendChild(label_email);
            div_email.appendChild(input_email);
            div_telefone1 = document.createElement('div');
            div_telefone1.setAttribute('class', 'col-md-6 form-group');
            label_telefone1 = document.createElement('label');
            label_telefone1.setAttribute('for', 'iTelefone1_' + qtd);
            label_telefone1.appendChild(document.createTextNode("Telefone: "));
            input_telefone1 = document.createElement('input');
            input_telefone1.setAttribute('type', 'text');
            input_telefone1.setAttribute('name', 'nTelefone1_' + qtd);
            input_telefone1.setAttribute('id', 'iTelefone1_' + qtd);
            input_telefone1.setAttribute('class', 'form-control input-telefone');
            input_telefone1.setAttribute('placeholder', 'Exemplo: Exemplo: (93) 3518-0011');
            div_telefone1.appendChild(label_telefone1);
            div_telefone1.appendChild(input_telefone1);
            div_telefone2 = document.createElement('div');
            div_telefone2.setAttribute('class', 'col-md-6 form-group');
            label_telefone2 = document.createElement('label');
            label_telefone2.setAttribute('for', 'iTelefone2_' + qtd);
            label_telefone2.appendChild(document.createTextNode("Celular: "));
            input_telefone2 = document.createElement('input');
            input_telefone2.setAttribute('type', 'text');
            input_telefone2.setAttribute('name', 'nTelefone2_' + qtd);
            input_telefone2.setAttribute('id', 'iTelefone2_' + qtd);
            input_telefone2.setAttribute('class', 'form-control input-celular');
            input_telefone2.setAttribute('placeholder', 'Exemplo: Exemplo: (093) 99222-3333');
            div_telefone2.appendChild(label_telefone2);
            div_telefone2.appendChild(input_telefone2);
            div.appendChild(div_nome);
            div.appendChild(div_email);
            div.appendChild(div_telefone1);
            div.appendChild(div_telefone2);
            container.insertBefore(div, container.firstElementChild);
            aplicarMascara();
        }
    }
    /*
     * @author Joab Torres <joabtorres1508@gmail.com>
     * @public esta função remove os campos para preenchimento de um ou mais contato
     */
    function remover_contato() {
        var elemento = document.getElementById("iQtdContato");
        var qtd = parseInt(elemento.value);
        if (qtd > 1) {
            $("#contato_" + qtd).remove();
            elemento.value = qtd - 1;
        }
    }
}


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
        if (valor === "M") {
            $("#viewImagem-1").attr('src', '/assets/imagens/user_masculino.png');
        } else {
            $("#viewImagem-1").attr('src', '/assets/imagens/user_feminino.png');
        }
    };
}
