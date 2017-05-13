<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2><?php echo isset($unidade) ? $unidade['nome'] : ''; ?></h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li><a  href="<?php echo BASE_URL ?>/relatorio/cidades/1<?php echo isset($cidade) ? '/' . $cidade['cod'] : "" ?>"><i class="fa fa-list"> </i> <?php echo isset($cidade) ? $cidade['nome'] : "Cidades" ?></a></li>
                    <?php if (isset($orgao)) { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/orgaos/1/<?php echo $cidade['cod'] . '/' . $orgao['cod'] ?>"><i class="fa fa-list"> </i> <?php echo $orgao['nome'] ?></a></li>
                    <?php } else if (isset($ap)) { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/aps/1/<?php echo $cidade['cod'] . '/' . $ap['cod'] ?>"><i class="fa fa-list"></i>  <?php echo $ap['nome'] ?></a></li>
                    <?php } else if (isset($redemetro)) { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/redemetro/1/<?php echo $redemetro['cod'] ?>"><i class="fa fa-list"></i> Rede Metro</a></li>
                    <?php } else { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/unidades/1/<?php echo $cidade['cod'] ?>"><i class="fa fa-list"></i> Unidades</a></li>
                    <?php } ?>
                    <li class="active"><i class="fa fa-list"></i>  <?php echo isset($unidade) ? $unidade['nome'] : ''; ?></li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-list-ul"></i> Administrativos</p>
                    </header>
                    <article class="panel-body">
                        <ul class="list-unstyled">
                            <li><p><span class="text-primary ">Cidade:</span> Itaituba</p></li>
                            <li><p><span class="text-primary ">Orgão:</span> PRODEPA - Processamento de Dados do Estado do Pará</p></li>
                            <li><p><span class="text-primary ">Esfera:</span> Estadual</p></li>
                            <li><p><span class="text-primary ">Unidade:</span> Hotzone Orla</p></li>
                            <li><p><span class="text-primary ">Data de Ativação:</span> 20/04/2014</p></li>
                            <li><p><span class="text-primary ">Status:</span> Ativo</p></li>
                            <li><p><span class="text-primary ">Zabbix:</span> Cadastrado</p></li>
                        </ul>
                        <!--panel do contrato-->
                        <div class="panel panel-primary">
                            <header class="panel-heading">
                                <p class="panel-title"><i class="fa fa-table" aria-hidden="true"></i> Contrato</p>
                            </header>
                            <article class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>#</th>
                                        <th>Numero</th>
                                        <th>Tipo</th>
                                        <th>Data Inicial</th>
                                        <th>Data Vigência</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>0001/2016</td>
                                        <td>ACT - Acordo de Cooperação Técnica</td>
                                        <td>20/03/2009</td>
                                        <td>20/03/2020</td>
                                    </tr>
                                </table>
                            </article>
                        </div>
                        <!--panel do contrato-->
                    </article>
                </div><!-- fim panel -->
            </div> <!-- fim da col-xs-12 -->
            <div class="col-xs-12">
                <!--panel conexao-->
                <div class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-list-ul"></i> Conexao</p>
                    </header>
                    <article class="panel-body">
                        <!-- ul class="list-unstyled">
                            <li><span class="text-primary">IP: </span> 10.132.2.1</li>
                            <li><span class="text-primary">VLAN: </span> ita_hotzorla </li>
                            <li><span class="text-primary">TAG VLAN: </span> 81</li>
                            <li><span class="text-primary">Banda: </span> 2 Mbps</li>
                            <li><span class="text-primary">Conexão: </span> Rádio</li>
                            <li><span class="text-primary">AP: </span> AP01</li>
                            <li><span class="text-primary">IP do AP: </span> 10.101.45.14</li>
                            <li><span class="text-primary">Color Code do Ap: </span> 11</li>
                        </ul>-->
                        <div class="row">
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">IP: </span> 10.132.2.1</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">VLAN: </span> ita_hotzorla </p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">TAG VLAN: </span> 81</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">Banda: </span> 2 Mbps</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">Conexão: </span> Rádio</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">Nome do AP: </span> AP01</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">IP do AP: </span> 10.101.45.14</p></div>
                            <div class="col-md-3 col-sm-6"><p><span class="text-primary">Color Code do AP: </span> 11</p></div>
                            <div class="clear col-xs-12">
                                <hr class="no-margin">
                                <p class="font-stronge text-primary">Acesso Rápido</p>
                                <p>Gráfico no Zabbix: <a href="#" target="_blank">Clique aqui!</a></p>
                                <p>Rádio: <a href="#" target="_blank">Clique aqui!</a></p>
                            </div>
                        </div>
                    </article>
                </div> <!--panel conexao-->
            </div><!-- fim da col-xs-12 -->
            <div class="clear col-xs-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-map-marker"></i> Localização</p>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-8"><span class="text-primary">Endereco: </span><br> Avenida Getúlio Vargas, S/N, Bairro Centro, - Itaituba - PA </div>
                            <div class="col-md-4"><span class="text-primary">GPS: </span><br> 04°16’32,38’’S, 55°58’56,78’’W </div>
                            <div class=" clear col-xs-12">
                                <div id="view-mapa-unidade"></div>
                                <!-- CHAMANDO GOOGLE MAPS API -->
                                <script src="http://maps.google.com/maps/api/js?key=AIzaSyCWbC3lfteLuL87PJLoU2yBKv4fyF_DGDQ&sensor=false"></script>
                                <script type="text/javascript">
                                    var latitude = -4.2639141;
                                    var longitude = -55.998396;
                                </script>
                            </div>
                        </div> <!-- fim row-->
                    </article>
                </section>
            </div><!-- fim da col-xs-12 -->
            <div class="clear col-xs-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-users"></i> Contato</p>
                    </header>
                    <article class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Celular</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Joab Torres Alencar</td>
                                <td>joab.alencar@prodepa.pa.gov.br</td>
                                <td></td>
                                <td>(093) 99204-7173</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Paulo Nardel</td>
                                <td>paulo.nardel@prodepa.pa.gov.br</td>
                                <td>(093) 3518-3322</td>
                                <td>(091) 98200-3839</td>
                            </tr>
                        </table>
                    </article>
                </section>
            </div><!-- fim da col-xs-12 -->
            <div class="clear col-xs-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-table"></i> Histórico <span class="pull-right"><a href="#" class="btn btn-sm btn-success"><i class="fa fa-plus-circle"></i> Adicionar</a></span></p>
                    </header>
                    <article class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Usuario</th>
                                <th>Descrição</th>
                                <th>Ação</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>20/05/2011</td>
                                <td>joab.alencar</td>
                                <td> Foi feito a troca do rádio</td>
                                <td><a href="#" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a> | <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        </table>
                    </article>
                </section>
            </div><!-- fim da col-xs-12 -->
        </div> <!--FIM ROW-->
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->

