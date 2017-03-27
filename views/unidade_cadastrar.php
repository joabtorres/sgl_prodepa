<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Unidade</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-plus-sign"></i> Cadastrar Unidade</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off">
                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title"> Unidade</p>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-sm-8 col-md-8 col-lg-8 form-group">
                                    <label for="iOrgao">Orgão:</label>
                                    <select name="nOrgao" id="iOrgao" class="form-control">
                                        <option value="Nome do orgão">Nome do orgão</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                    <label for="iCidade">Cidade: </label>
                                    <select name="nCidade" id="iCidade" class="form-control">
                                        <option value="ALTAMIRA" >ALTAMIRA</option>
                                        <option value="ITAITUBA" >ITAITUBA</option>
                                        <option value="SANTARÉM" >SANTARÉM</option>
                                        <option value="MARABÁ" >MARABÁ</option>
                                        <option value="PARAGOMINAS" >PARAGOMINAS</option>
                                        <option value="PLACAS" >PLACAS</option>
                                        <option value="RURÓPOLIS" >RURÓPOLIS</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                    <label for="iUnidade">Unidade:</label>
                                    <input type="text" name="nUnidade" id="iUnidade" class="form-control" placeholder="Exemplo: Fórum Desembargador Walter Bezerra Falcão">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iIP">IP:</label>
                                    <input type="text" name="nIP" id="iIP" class="form-control" placeholder="Exemplo: 10.87.24.1">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iAP">AP:</label>
                                    <select name="nAP" id="iAP" class="form-control">
                                        <option value="AP01">AP01</option>
                                    </select>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="iVLAN">TAG VLAN:</label>
                                    <input type="text" name="nVLAN" id="iVLAN" class="form-control" placeholder="Exemplo: 67">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="iConexao">Conexão:</label>
                                    <input type="text" name="nConexao" id="iConexao" class="form-control" placeholder="Exemplo: Rádio">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="iBanda">Banda:</label>
                                    <input type="text" name="nBanda" id="iBanda" class="form-control" placeholder="Exemplo: 4 MegaBits">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="iStatus">Status:</label>
                                    <input type="text" name="nStatus" id="iStatus" class="form-control" placeholder="Exemplo: Ativo">
                                </div>
                                <div class="col-md-4   form-group">
                                    <label for="iZabbix">Zabbix:</label>
                                    <input type="text" name="nZabbix" id="iZabbix" class="form-control" placeholder="Exemplo: Cadastrado">
                                </div>
                                <div class="col-md-4  form-group">
                                    <label for="iUrlZabbix">Url no Zabbix:</label>
                                    <input type="text" name="nUrlZabbix" id="iUrlZabbix" class="form-control" placeholder="Exemplo: 10.15.125.54">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="inDataAtivacao">Data de Ativação:</label>
                                    <input type="text" name="nDataAtivacao" id="inDataAtivacao" class="form-control" placeholder="Exemplo: 20/03/2009">
                                </div>

                            </div> <!-- fim row-->
                        </article>
                    </section> <!-- fim panel DADOS GERAIS -->
                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title">Endereço</p>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="iLogradouro">Logradouro:</label>
                                    <input type="text" name="nLogradouro" id="iLogradouro" class="form-control" placeholder="Exemplo: Tv. Quinze de Agosto">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="iNumero">Número:</label>
                                    <input type="text" name="nNumero" id="iNumero" class="form-control" placeholder="Exemplo: 100 ou S/N">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iBairro">Bairro:</label>
                                    <input type="text" name="nBairro" id="iBairro" class="form-control" placeholder="Exemplo: Bela Vista">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="iComplemento">Complemento:</label>
                                    <input type="text" name="nComplemento" id="iComplemento" class="form-control" placeholder="Exemplo: Próximo ao Mercantil Alvorada">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iLatitude">Latitude:</label>
                                    <input type="text" name="nLatitude" id="iLatitude" class="form-control" placeholder="Exemplo: -4.2587258">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iLongitude">Longitude:</label>
                                    <input type="text" name="nLongitude" id="iLongitude" class="form-control" placeholder="Exemplo: -55.998460">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iGPS">GPS:</label>
                                    <input type="text" name="nGPS" id="iGPS" class="form-control" placeholder="Exemplo: 04°16’32.80’’S, 55°59’07.70’’W">
                                </div>
                                <div class="col-md-12"><div id="viewMapa"></div></div>
                                <!-- CHAMANDO GOOGLE MAPS API -->
                                <script src="http://maps.google.com/maps/api/js?key=AIzaSyCg1ogHawJGuDbw7nd6qBz9yYxYPoGTWQo&sensor=false"></script>
                            </div>
                        </article>
                    </section> <!-- fim panel ENDEREÇO -->

                    <section class="panel panel-primary">
                        <header class="panel-heading"><p class="panel-title">Contato</p></header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="iNome">Nome:</label>
                                    <input type="text" name="nNome" id="iNome" class="form-control" placeholder="Exemplo: Joab Alencar">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="iEmail">E-mail:</label>
                                    <input type="text" name="nEmail" id="iEmail" class="form-control" placeholder="Exemplo: usuario@live.com">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iTelefone">Telefone:</label>
                                    <input type="text" name="nTelefone" id="iTelefone" class="form-control" placeholder="Exemplo: (93) 3518-0011">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iCelular1">Celular 1:</label>
                                    <input type="text" name="nCelular1" id="iCelular1" class="form-control" placeholder="Exemplo: (93) 3518-0011">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iCelular2">Celular 2:</label>
                                    <input type="text" name="nCelular2" id="iCelular2" class="form-control" placeholder="Exemplo: (93) 3518-0011">
                                </div>
                            </div> <!-- fim row-->                                
                        </article>
                    </section> <!-- FIM PANEL CONTATO -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Salvar</button>
                        <a href="index.html" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->