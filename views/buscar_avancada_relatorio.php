<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Relatório Avançado</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-list"></i> Relatório Avançado</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" title="Exibir/Ocultar">
                            <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                            <p class="panel-title"><i class="fa fa-list"></i> Relatório Avançado </p></a>
                    </div>
                    <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <form method="POST" autocomplete="off" id="relatorio-detalhado">
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iCidade">Cidade: </label>
                                        <select class="form-control" name="nCidade" id="iCidade">
                                            <option value="Todas" >Todas</option>
                                            <?php
                                            if (isset($cidades)) {
                                                foreach ($cidades as $resultado) {
                                                    echo '<option value="' . $resultado['cod_area_atuacao'] . '">' . $resultado['cidade_area_atuacao'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iConexao">Conexão:</label>
                                        <select name="nConexao" id="iConexao" class="form-control">
                                            <option value="Todas">Todas</option>
                                            <option value="Rádio">Rádio</option>
                                            <option value="Fibra">Fibra</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iAP">AP:</label>
                                        <select name="nAP" id="iAP" class="form-control">
                                            <option value="Todos">Todos</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iRedeMetro">Rede Metro: </label>
                                        <select name="nRedeMetro" id="iRedeMetro" class="form-control">
                                            <option value="Todos">Todos</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iOrgao">Órgão:</label>
                                        <select name="nOrgao" id="iOrgao" class="form-control">
                                            <option value="Todos">Todos</option> 
                                            <?php
                                            if (isset($orgaos)) {
                                                foreach ($orgaos as $orgao) {
                                                    echo '<option value="' . $orgao['cod_orgao'] . '">' . $orgao['nome_orgao'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iCategoria">Esfera:</label>
                                        <select name="nCategoria" id="iCategoria" class="form-control">
                                            <option value="Todas">Todas</option>
                                            <?php
                                            if (isset($esferas)) {
                                                foreach ($esferas as $esfera) {
                                                    echo '<option value="' . $esfera['categoria_orgao'] . '">' . $esfera['categoria_orgao'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                        <label>Modo de Exibição:</label><br/>
                                        <label><input type="radio" name="nModoExibicao" value="Resumido" checked/> Resumido</label>
                                        <!--<label><input type="radio" name="nModoExibicao" value="Completo"/> Completo</label>-->
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                        <label>Gera PDF:</label><br/>
                                        <label><input type="radio" name="nPDF" value="Sim" checked/> Sim</label>
                                        <label><input type="radio" name="nPDF" value="Não"/> Não</label>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                        <button type="submit" class="btn btn-primary" name="nBuscar" value="Buscar"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                    </div>
                                </div>
                                <!--fim row-->
                            </form>
                        </div>
                    </div>

                </div>
            </div> 
            <!--class="col-sm-12 col-md-12 col-lg-12"-->
            <?php
            if (isset($resultadoView) && is_array($resultadoView)) {
                foreach ($resultadoView as $cidades):

                    foreach ($cidades['orgaos'] as $orgaos):
                        if (isset($orgaos['unidades']) && !empty($orgaos['unidades'])):
                            ?>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <!--PANEL--> 
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo isset($cidades['cidade']) ? $cidades['cidade'] : ''; ?></p>
                                        <p class="panel-title"><span class="font-bold">Orgãos:  </span><?php echo isset($orgaos['orgao']) ? $orgaos['orgao'] : ''; ?> - <?php echo isset($orgaos['categoria']) ? $orgaos['categoria'] : ''; ?></p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Unidade</th>
                                                <th>IP</th>
                                                <th>Banda</th>
                                                <th>Conexão</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $qtd = 1;
                                            foreach ($orgaos['unidades'] as $unidades):
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $qtd; ?></td>
                                                    <td><a href="<?php echo BASE_URL . '/unidade/index/' . $unidades['cod_unidade']; ?>"><?php echo $unidades['unidade']; ?></a></td>
                                                    <td><?php echo $unidades['ip']; ?></td>
                                                    <td ><?php echo $unidades['banda']; ?></td>
                                                    <td>
                                                        <?php
                                                        echo $unidades['conexao'];
                                                        if (isset($unidades['nome_ap'])) {
                                                            echo ' - ' . $unidades['nome_ap'];
                                                        } else {
                                                            echo ' - ' . $unidades['nome_redemetro'];
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                ++$qtd;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--FIM PANEL-->
                            </div>
                            <?php
                        endif;
                    endforeach;
                endforeach;
                ?>
                <!--fim COL-SM-12 COL-MD-12 COL-LG-12-->
                <?php
            } else {
                echo '<div class="col-xs-12"><div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
            </div></div>';
            }
            ?>
        </div>
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->