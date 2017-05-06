<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Unidade</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-plus-square"></i> Cadastrar Unidade</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar uma unidade já cadastrada.'; ?></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off" id="form-unidade">
                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title"> Unidade</p>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-sm-8 col-md-8 col-lg-8 form-group">
                                    <label for="iOrgao">Orgão:</label>
                                    <select name="nOrgao" id="iOrgao" class="form-control">
                                        <?php
                                        foreach ($orgaos as $orgao) {
                                            if (!empty($_POST['nOrgao']) && $_POST['nOrgao'] == $orgao['cod_orgao']) {
                                                echo '<option value="' . $orgao['cod_orgao'] . '" selected="true">' . $orgao['nome_orgao'] . '</option>';
                                            } else {
                                                echo '<option value="' . $orgao['cod_orgao'] . '">' . $orgao['nome_orgao'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4 col-md-4 col-lg-4">
                                    <label for="iCidade">Cidade: </label>
                                    <select name="nCidade" id="iCidade" class="form-control" onchange="selectCidade()">
                                        <?php
                                        foreach ($cidades as $resultado) {
                                            if (!empty($_POST['nCidade']) && $_POST['nCidade'] == $resultado['cod_area_atuacao']) {
                                                echo '<option value="' . $resultado['cod_area_atuacao'] . '" selected="true">' . $resultado['cidade_area_atuacao'] . '</option>';
                                            } else {
                                                echo '<option value="' . $resultado['cod_area_atuacao'] . '">' . $resultado['cidade_area_atuacao'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 form-group <?php echo (isset($unidade['nome']['class'])) ? $unidade['nome']['class'] : ''; ?>">
                                    <label for="iUnidade" class="control-label">Unidade: * <?php echo (isset($unidade['nome']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['nome']['msg'] . ' </small>' : ''; ?></label> 
                                    <input type="text" name="nUnidade" id="iUnidade" class="form-control" placeholder="Exemplo: Fórum Desembargador Walter Bezerra Falcão" value="<?php echo (!empty($_POST['nUnidade'])) ? $_POST['nUnidade'] : ''; ?>">
                                </div>
                                <div class="col-md-4 form-group <?php echo (isset($unidade['conexao']['class'])) ? $unidade['conexao']['class'] : ''; ?>">
                                    <label for="iConexao" class="control-label">Conexão:* <?php echo (isset($unidade['conexao']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['conexao']['msg'] . ' </small>' : ''; ?></label>

                                    <select name="nConexao" id="iConexao" class="form-control">
                                        <option value=""></option>
                                        <option value="Rádio">Rádio</option>
                                        <option value="Fibra">Fibra</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group" id="list_ap">
                                    <label for="iAP">AP:*</label>
                                    <script>var selectAp = <?php echo (!empty($_POST['nAP'])) ? $_POST['nAP'] : 'null'; ?></script>

                                    <select name="nAP" id="iAP" class="form-control">
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group" id="list_redemetro">
                                    <label for="iAP">Rede Metro:*</label>
                                    <script>var selectRedMetro = <?php echo (!empty($_POST['nRedeMetro'])) ? $_POST['nRedeMetro'] : 'null'; ?></script>

                                    <select name="nRedeMetro" id="iRedeMetro" class="form-control">

                                    </select>
                                </div>
                                <div class="col-md-4 form-group <?php echo (isset($unidade['ip']['class'])) ? $unidade['ip']['class'] : ''; ?>">
                                    <label for="iIP" class="control-label">IP:* <?php echo (isset($unidade['ip']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['ip']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nIP" id="iIP" class="form-control" placeholder="Exemplo: 10.87.24.1"  value="<?php echo (!empty($_POST['nIP'])) ? $_POST['nIP'] : ''; ?>">
                                </div>


                                <div class="col-md-4 form-group <?php echo (isset($unidade['vlan']['class'])) ? $unidade['vlan']['class'] : ''; ?>">
                                    <label for="iVLAN" class="control-label">VLAN:* <?php echo (isset($unidade['vlan']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['vlan']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nVLAN" id="iVLAN" class="form-control" placeholder="Exemplo: inf_propazdorothy" value="<?php echo (!empty($_POST['nVLAN'])) ? $_POST['nVLAN'] : ''; ?>">
                                </div>

                                <div class="col-md-4 form-group <?php echo (isset($unidade['vlan']['class'])) ? $unidade['vlan']['class'] : ''; ?>">
                                    <label for="iTagVlan" class="control-label">TAG VLAN:* <?php echo (isset($unidade['vlan']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['vlan']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nTagVlan" id="iTagVlan" class="form-control" placeholder="Exemplo: 67" maxlength="5" value="<?php echo (!empty($_POST['nTagVlan'])) ? $_POST['nTagVlan'] : ''; ?>">
                                </div>

                                <div class="col-md-4 form-group <?php echo (isset($unidade['banda']['class'])) ? $unidade['banda']['class'] : ''; ?>">
                                    <label for="iBanda" class="control-label">Banda:* <?php echo (isset($unidade['banda']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['banda']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nBanda" id="iBanda" class="form-control" placeholder="Exemplo: 4 Mb" value="<?php echo (!empty($_POST['nBanda'])) ? $_POST['nBanda'] : ''; ?>">
                                </div>

                                <div class="col-md-4 form-group <?php echo (isset($unidade['statu']['class'])) ? $unidade['statu']['class'] : ''; ?>">
                                    <label for="iStatus" class="control-label">Status:* <?php echo (isset($unidade['statu']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['statu']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nStatus" id="iStatus" class="form-control" placeholder="Exemplo: Ativo" value="<?php echo (!empty($_POST['nStatus'])) ? $_POST['nStatus'] : ''; ?>">
                                </div>

                                <div class="col-md-4 form-group <?php echo (isset($unidade['data']['class'])) ? $unidade['data']['class'] : ''; ?>">
                                    <label for="inDataAtivacao" class="control-label">Data de Ativação:* <?php echo (isset($unidade['data']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['data']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nDataAtivacao" id="inDataAtivacao" class="form-control input-date" maxlength="10" placeholder="Exemplo: 20/03/2009" value="<?php echo (!empty($_POST['nDataAtivacao'])) ? $_POST['nDataAtivacao'] : ''; ?>">
                                </div>
                                <div class="col-md-4   form-group <?php echo (isset($unidade['zabbix']['class'])) ? $unidade['zabbix']['class'] : ''; ?>">
                                    <label for="iZabbix" class="control-label">Zabbix:* <?php echo (isset($unidade['zabbix']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['zabbix']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nZabbix" id="iZabbix" class="form-control" placeholder="Exemplo: Cadastrado" value="<?php echo (!empty($_POST['nZabbix'])) ? $_POST['nZabbix'] : ''; ?>">
                                </div>
                                <div class="col-md-8  form-group <?php echo (isset($unidade['url']['class'])) ? $unidade['url']['class'] : ''; ?>">
                                    <label for="iUrlZabbix" class="control-label">Url no Zabbix:* <?php echo (isset($unidade['url']['msg'])) ? '<small><span class="glyphicon glyphicon-remove"></span> ' . $unidade['url']['msg'] . ' </small>' : ''; ?></label>
                                    <input type="text" name="nUrlZabbix" id="iUrlZabbix" class="form-control" placeholder="Exemplo: http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=14022&graphid=0" value="<?php echo (!empty($_POST['nUrlZabbix'])) ? $_POST['nUrlZabbix'] : ''; ?>">
                                </div>



                            </div> <!-- fim row-->
                        </article>
                    </section> <!-- fim panel DADOS GERAIS -->

                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title">Contrato</p>
                        </header>
                        <article class="panel-body">
                            <span class="btn btn-success" onclick="add_contrato()"><i class="fa fa-plus" aria-hidden="true"></i> Novo</span>
                            <span class="btn btn-danger" onclick="remover_contrato()"><i class="fa fa-close" aria-hidden="true"></i> Excluir</span>
                            <input type="hidden" id="iQtdContrato" name="nQtdContrato" value="1"/>
                            <div id="icadContrato">
                                <div class="row container_cad_contrato">
                                    <hr/>
                                    <div class="col-md-4 form-group">
                                        <label for="iNumeroContrato1">Número do Contrato:</label>
                                        <input type="text" name="nNumeroContrato1" id="iNumeroContrato1" class="form-control" placeholder="Exemplo: 22454/6635" >
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <label for="iTipoContratro1">Tipo de Contrato:</label>
                                        <select id="iTipoContratro1" name="nTipoContratro1" class="form-control">
                                            <option value=""></option>
                                            <option value="ACT - Acordo de Cooperação Técnica">ACT - Acordo de Cooperação Técnica</option>
                                            <option value="ACTF - Acordo de Cooperação Técnico e Financeiro">ACTF - Acordo de Cooperação Técnico e Financeiro</option>
                                            <option value="ACR"> C - Contrato</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="iDataInicial1">Data Inicial:</label>
                                        <input type="date" name="nDataInicial1" id="iDataInicial1" class="form-control input-date" placeholder="Exemplo: 20/05/2011">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="iDataVigencia1">Data de Vigência:</label>
                                        <input type="date" name="nDataVigencia1" id="iDataVigencia1" class="form-control input-date" placeholder="Exemplo: 20/06/2014" >
                                    </div>
                                </div>
                            </div> 
                        </article>
                    </section><!-- fim panel DADOS GERAIS -->


                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title">Endereço</p>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="iLogradouro">Logradouro:</label>
                                    <input type="text" name="nLogradouro" id="iLogradouro" class="form-control" placeholder="Exemplo: Tv. Quinze de Agosto" value="<?php echo (!empty($_POST['nLogradouro'])) ? $_POST['nLogradouro'] : ''; ?>">
                                </div>
                                <div class="col-md-2 form-group">
                                    <label for="iNumero">Número:</label>
                                    <input type="text" name="nNumero" id="iNumero" class="form-control" placeholder="Exemplo: 100 ou S/N" value="<?php echo (!empty($_POST['nNumero'])) ? $_POST['nNumero'] : ''; ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iBairro">Bairro:</label>
                                    <input type="text" name="nBairro" id="iBairro" class="form-control" placeholder="Exemplo: Bela Vista" value="<?php echo (!empty($_POST['nBairro'])) ? $_POST['nBairro'] : ''; ?>">
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="iComplemento">Complemento:</label>
                                    <input type="text" name="nComplemento" id="iComplemento" class="form-control" placeholder="Exemplo: Próximo ao Mercantil Alvorada" value="<?php echo (!empty($_POST['nComplemento'])) ? $_POST['nComplemento'] : ''; ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iLatitude">Latitude:</label>
                                    <input type="text" name="nLatitude" id="iLatitude" class="form-control" placeholder="Exemplo: -4.2587258" value="<?php echo (!empty($_POST['nLatitude'])) ? $_POST['nLatitude'] : ''; ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iLongitude">Longitude:</label>
                                    <input type="text" name="nLongitude" id="iLongitude" class="form-control" placeholder="Exemplo: -55.998460" value="<?php echo (!empty($_POST['nLongitude'])) ? $_POST['nLongitude'] : ''; ?>">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="iGPS">GPS:</label>
                                    <input type="text" name="nGPS" id="iGPS" class="form-control" placeholder="Exemplo: 04°16’32.80’’S, 55°59’07.70’’W" value="<?php echo (!empty($_POST['nGPS'])) ? $_POST['nGPS'] : ''; ?>">
                                </div>
                                <div class="col-md-12"><div id="viewMapa"></div></div>
                                <!-- CHAMANDO GOOGLE MAPS API -->
                                <script src="http://maps.google.com/maps/api/js?key=AIzaSyCg1ogHawJGuDbw7nd6qBz9yYxYPoGTWQo&sensor=false"></script>
                                <script>
                                var getLatitude = <?php echo (!empty($_POST['nLatitude'])) ? $_POST['nLatitude'] : 'null'; ?>;
                                var getLongitude = <?php echo (!empty($_POST['nLongitude'])) ? $_POST['nLongitude'] : 'null'; ?>;
                                </script>
                            </div>
                        </article>
                    </section> <!-- fim panel ENDEREÇO -->

                    <section class="panel panel-primary">
                        <header class="panel-heading"><p class="panel-title">Contato</p></header>
                        <article class="panel-body">
                            <span class="btn btn-info" onclick="add_contato()"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo</span>
                            <span class="btn btn-warning" onclick="remover_contato()"><i class="fa fa-user-times" aria-hidden="true"></i> Excluir</span>
                            <input type="hidden" id="iQtdContato" name="nQtdContato" value="1"/>
                            <div id="iCadContato">
                                <div class="row container_cad_contato">
                                    <hr/>
                                    <div class="col-md-6 form-group">
                                        <label for="iNome1">Nome:</label>
                                        <input type="text" name="nNome1" id="iNome1" class="form-control" placeholder="Exemplo: Joab Alencar" value="<?php echo (!empty($_POST["nNome"])) ? $_POST["nNome"] : ""; ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="iEmail1">E-mail:</label>
                                        <input type="email" name="nEmail1" id="iEmail1" class="form-control" placeholder="Exemplo: usuario@live.com" value="<?php echo (!empty($_POST["nEmail"])) ? $_POST["nEmail"] : ""; ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="iTelefone1_1">Telefone:</label>
                                        <input type="text" name="nTelefone1_1" id="iTelefone1_1" class="form-control input-telefone" placeholder="Exemplo: (93) 3518-0011" value="<?php echo (!empty($_POST["nTelefone1"])) ? $_POST["nTelefone1"] : ""; ?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="iTelefone2_1">Celular:</label>
                                        <input type="text" name="nTelefone2_1" id="iTelefone2_1" class="form-control input-celular" placeholder="Exemplo: (093) 99222-3333" value="<?php echo (!empty($_POST["nTelefone2"])) ? $_POST["nTelefone2"] : ""; ?>">
                                    </div>
                                </div>
                            </div> 

                        </article>
                    </section> <!-- FIM PANEL CONTATO -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Salvar</button>
                        <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
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