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
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/redemetro/1/<?php echo $cidade['cod'] . '/' . $redemetro['cod'] ?>"><i class="fa fa-list"></i> <?php echo $redemetro['nome'] ?></a></li>
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
                        <p class="panel-title"><i class="fa fa-list-ul"></i> Administrativo</p>
                    </header>
                    <article class="panel-body">
                        <ul class="list-unstyled">
                            <li><p><span class="text-primary ">Cidade:</span> <?php echo $resultado_unidade['cidade_area_atuacao'] ?></p></li>
                            <li><p><span class="text-primary ">Orgão:</span> <?php echo $resultado_unidade['nome_orgao'] ?></p></li>
                            <li><p><span class="text-primary ">Esfera:</span> <?php echo $resultado_unidade['categoria_orgao'] ?></p></li>
                            <li><p><span class="text-primary ">Unidade:</span> <?php echo $resultado_unidade['nome_unidade'] ?></p></li>
                            <li><p><span class="text-primary ">Data de Ativação:</span> <?php echo $resultado_unidade['data_ativacao_unidade'] ?></p></li>
                            <li><p><span class="text-primary ">Status:</span> <?php echo $resultado_unidade['statu_unidade'] ?></p></li>
                            <li><p><span class="text-primary ">Zabbix:</span> <?php echo $resultado_unidade['zabbix_unidade'] ?></p></li>
                        </ul>
                        <?php if (isset($resultado_unidade['contratos']) && !empty($resultado_unidade['contratos'])): ?>
                            <!--panel do contrato-->
                            <div class="panel panel-primary" >
                                <header class="panel-heading">
                                  <a data-toggle="collapse" href="#tableContratoView" aria-expanded="false" aria-controls="tableContratoView">
                                    <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                                    <p class="panel-title"><i class="fa fa-table" aria-hidden="true"></i> Contrato</p>
                                  </a>
                                </header>
                                <article class="table-responsive collapse" id="tableContratoView">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>#</th>
                                            <th>Numero</th>
                                            <th>Tipo</th>
                                            <th>Data Inicial</th>
                                            <th>Data Vigência</th>
                                        </tr>
                                        <?php
                                        $qtdContrato = 1;
                                        foreach ($resultado_unidade['contratos'] as $contratos):
                                            ?>
                                            <tr>
                                                <td><?php echo $qtdContrato ?></td>
                                                <td><?php echo isset($contratos['numero_contrato']) ? $contratos['numero_contrato'] : ""; ?></td>
                                                <td><?php echo isset($contratos['nome_contrato']) ? $contratos['nome_contrato'] : ""; ?></td>
                                                <td><?php echo isset($contratos['data_inicial_contrato']) ? $contratos['data_inicial_contrato'] : ""; ?></td>
                                                <td><?php echo isset($contratos['data_vigencia_contrato']) ? $contratos['data_vigencia_contrato'] : ""; ?></td>
                                            </tr>
                                            <?php
                                            ++$qtdContrato;
                                        endforeach;
                                        ?>
                                    </table>
                                </article>
                            </div>
                            <!--panel do contrato-->
                        <?php endif; ?>
                    </article>
                </div><!-- fim panel -->
            </div> <!-- fim da col-xs-12 -->
            <div class="col-xs-12">
                <!--panel conexao-->
                <div class="panel panel-primary">
                    <header class="panel-heading">
                        <p class="panel-title"><i class="fa fa-list-ul"></i> Conexão</p>
                    </header>
                    <article class="panel-body">
                        <div class="row">
                            <div class="col-md-4"><p><span class="text-primary">IP: </span> <?php echo isset($resultado_unidade['ip_unidade']) ? $resultado_unidade['ip_unidade'] : ""; ?></p></div>
                            <div class="col-md-4"><p><span class="text-primary">VLAN: </span> <?php echo isset($resultado_unidade['nome_vlan_unidade']) ? $resultado_unidade['nome_vlan_unidade'] : ""; ?> </p> </div>
                            <div class="col-md-4"><p><span class="text-primary">TAG VLAN: </span> <?php echo isset($resultado_unidade['tag_vlan_unidade']) ? $resultado_unidade['tag_vlan_unidade'] : ""; ?></p></div>
                            <div class="col-md-4"><p><span class="text-primary">Banda: </span> <?php echo isset($resultado_unidade['banda_unidade']) ? $resultado_unidade['banda_unidade'] : ""; ?></p></div>
                            <div class="col-md-4"><p><span class="text-primary">Conexão: </span> <?php echo isset($resultado_unidade['conexao_unidade']) ? $resultado_unidade['conexao_unidade'] : ""; ?></p></div>
                            <?php if (isset($resultado_unidade['cod_ap']) && !empty($resultado_unidade['cod_ap'])) { ?>
                                <div class="col-md-4"><p><span class="text-primary">Nome do AP: </span> <?php echo isset($resultado_unidade['nome_ap']) ? $resultado_unidade['nome_ap'] : ""; ?></p></div>
                                <div class="col-md-4"><p><span class="text-primary">IP do AP: </span> <?php echo isset($resultado_unidade['ip_ap']) ? $resultado_unidade['ip_ap'] : ""; ?></p></div>
                                <div class="col-md-4"><p><span class="text-primary">Color Code do AP: </span> <?php echo isset($resultado_unidade['color_code_ap']) ? $resultado_unidade['color_code_ap'] : ""; ?></p></div >
                            <?php } else { ?>
                                <div class="col-md-4"><p><span class="text-primary">Nome da Rede Metro: </span> <?php echo isset($resultado_unidade['nome_redemetro']) ? $resultado_unidade['nome_redemetro'] : ""; ?></p></div >
                            <?php } ?>
                        </div>
                        <?php if (!empty($resultado_unidade['url_zabbix_unidade']) || !empty($resultado_unidade['cod_ap'])): ?>
                            <div class="row">
                                <div class="clear col-md-12">
                                    <hr class="no-margin">
                                    <p class="font-stronge text-primary">Acesso Rápido</p>
                                    <?php if (!empty($resultado_unidade['url_zabbix_unidade'])): ?><p>Gráfico no Zabbix: <a href="<?php echo isset($resultado_unidade['url_zabbix_unidade']) ? $resultado_unidade['url_zabbix_unidade'] : ""; ?>" target="_blank">Clique aqui!</a></p> <?php endif; ?>
                                    <?php if (isset($resultado_unidade['cod_ap']) && !empty($resultado_unidade['cod_ap'])) : ?>
                                        <p>Rádio: <a href="http://<?php echo isset($resultado_unidade['ip_unidade']) ? $resultado_unidade['ip_unidade'] : ""; ?>" target="_blank">Clique aqui!</a></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </article>
                </div> <!--panel conexao-->
            </div><!-- fim da col-xs-12 -->
            <?php if (isset($resultado_unidade['endereco'])): ?>
                <div class="clear col-xs-12">
                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <p class="panel-title"><i class="fa fa-map-marker"></i> Localização</p>
                        </header>
                        <article class="panel-body">
                            <div class="row">
                                <div class="col-md-8"><span class="text-primary">Endereco: </span><br> <?php echo $resultado_unidade['endereco']['logradouro_endereco'] . ', ' . $resultado_unidade['endereco']['numero_endereco'] . ', ' . $resultado_unidade['endereco']['bairro_endereco'] . ', ' . $resultado_unidade['endereco']['complemento_endereco'] . ' - ' . $resultado_unidade['cidade_area_atuacao'] ?> - PA </div>
                                <?php if (isset($resultado_unidade['endereco']['gps_endereco']) && !empty($resultado_unidade['endereco']['gps_endereco'])) : ?><div class="col-md-4"><span class="text-primary">GPS: </span><br> <?php echo isset($resultado_unidade['endereco']['gps_endereco']) ? $resultado_unidade['endereco']['gps_endereco'] : ""; ?> </div><?php endif; ?>
                            </div> <!-- fim row-->
                            <div class="row">
                              <div class="col-md-12">
                                <hr class="margin-5">
                                <span>Google Maps: <a data-toggle="modal" data-target="#modal_localizacao" class="cursor-pointer"> Clique aqui!</a></span>
                              </div> <!-- fim row-->
                            </div>
                        </article>
                    </section>
                </div><!-- fim da col-xs-12 -->
                <?php
            endif;
            if (isset($resultado_unidade['contatos'])) :
                ?>

                <div class="clear col-xs-12">
                    <section class="panel panel-primary">
                        <header class="panel-heading">
                            <a data-toggle="collapse" href="#tableContatoView" aria-expanded="false" aria-controls="tableContatoView">
                              <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                              <p class="panel-title"><i class="fa fa-users"></i> Contato</p>
                            </a>
                        </header>
                        <article class="table-responsive collapse" id="tableContatoView">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Telefone</th>
                                    <th>Celular</th>
                                </tr>
                                <?php
                                $qtdContato = 1;
                                foreach ($resultado_unidade['contatos'] as $contatos):
                                    ?>
                                    <tr>
                                        <td><?php echo $qtdContato ?></td>
                                        <td><?php echo $contatos['nome_contato'] ?></td>
                                        <td><?php echo $contatos['email_contato'] ?></td>
                                        <td><?php echo $contatos['telefone1_contato'] ?></td>
                                        <td><?php echo $contatos['telefone2_contato'] ?></td>
                                    </tr>
                                    <?php
                                    ++$qtdContato;
                                endforeach;
                                ?>
                            </table>
                        </article>
                    </section>
                </div><!--fim da col-xs-12 -->
                <?php
            endif;
            ?>
            <div class="clear col-xs-12">
                <section class="panel panel-primary">
                    <header class="panel-heading">
                      <a data-toggle="collapse" href="#tableHistoricoView" aria-expanded="false" aria-controls="tableHistoricoView">
                        <span class="pull-right"><i class="fa fa-plus-square"></i></span>
                        <p class="panel-title"><i class="fa fa-table"></i> Histórico</p>
                        <!-- <p class="panel-title"><i class="fa fa-table"></i> Histórico <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/historico/' . $resultado_unidade['cod_unidade'] ?>" class="btn btn-sm btn-success" title="Adicionar Histórico"><i class="fa fa-plus-circle"></i> Adicionar</a></span></p> -->
                      </a>
                    </header>
                    <article class="table-responsive collapse" id="tableHistoricoView" >
                      <div class="panel-body">
                        <span class="pull-right"><a href="<?php echo BASE_URL . '/cadastrar/historico/' . $resultado_unidade['cod_unidade'] ?>" class="btn btn-sm btn-success" title="Adicionar Histórico"><i class="fa fa-plus-circle"></i> Adicionar</a></span>
                      </div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>#</th>
                                <th>Data</th>
                                <th>Usuario</th>
                                <th>TDESK / Descrição</th>
                                <?php if (!empty($_SESSION['user_sgl']['nivel']) && $_SESSION['user_sgl']['nivel']) : ?>
                                    <th>Ação</th>
                                <?php endif; ?>
                            </tr>
                            <?php
                            if (isset($resultado_unidade['historicos'])) {
                                $qtdHistorico = 1;
                                foreach ($resultado_unidade['historicos'] as $historicos):
                                    ?>
                                    <tr>
                                        <td><?php echo $qtdHistorico ?></td>
                                        <td><?php echo $historicos['data_historico'] ?></td>
                                        <td><?php echo $historicos['usuario'] ?></td>
                                        <td> <?php echo $historicos['descricao_historico'] ?></td>
                                        <?php if (!empty($_SESSION['user_sgl']['nivel']) && $_SESSION['user_sgl']['nivel']) : ?>
                                            <td class="table-acao"><a href="<?php echo BASE_URL . '/editar/historico/' . $historicos['cod_historico'] ?>" class="btn btn-xs btn-primary" title="Editar"><i class="fa fa-pencil"></i></a> | <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal_historico_<?php echo $historicos['cod_historico'] ?>" title="Excluir"><i class="fa fa-trash"></i></button></td>
                                        <?php endif; ?>
                                    </tr>
                                    <?php
                                    ++$qtdHistorico;
                                endforeach;
                            }else {
                                echo '<tr><td colspan="5">Não há nenhum histórico registrado!</td></tr>';
                            }
                            ?>
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

<!--MODAL - Localização-->
<section class="modal fade" id="modal_localizacao" tabindex="-1" role="dialog">
    <article class="modal-dialog modal-lg" role="document">
        <section class="modal-content">
            <header class="modal-header bg-primary">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class="panel-title">Coordenadas Geográficas</p>
            </header>
            <article class="modal-body">
              <div id="view-mapa-unidade"></div>
              <!-- CHAMANDO GOOGLE MAPS API -->
              <script src="http://maps.google.com/maps/api/js?key=AIzaSyCg1ogHawJGuDbw7nd6qBz9yYxYPoGTWQo"></script>
              <?php echo '<script type="text/javascript"> var latitude = ' . $resultado_unidade['endereco']['latitude_endereco'] . '; var longitude =' . $resultado_unidade['endereco']['longitude_endereco'] . '</script>' ?>
              <script type="text/javascript">
                  var latitude = <?php echo isset($resultado_unidade['endereco']) ? $resultado_unidade['endereco']['latitude_endereco'] : ""; ?>;
                  var longitude = <?php echo isset($resultado_unidade['endereco']) ? $resultado_unidade['endereco']['longitude_endereco'] : ""; ?>;
              </script>
            </article>
            <footer class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
            </footer>
        </section>
    </article>
</section>
<!--MODAL - Localização-->

<?php
if (!empty($_SESSION['user_sgl']['nivel']) && $_SESSION['user_sgl']['nivel']) :
    if (isset($resultado_unidade['historicos'])) :
        foreach ($resultado_unidade['historicos'] as $historicos):
            ?>
            <!--MODAL - ESTRUTURA BÁSICA-->
            <section class="modal fade" id="modal_historico_<?php echo $historicos['cod_historico'] ?>" tabindex="-1" role="dialog">
                <article class="modal-dialog modal-md" role="document">
                    <section class="modal-content">
                        <header class="modal-header bg-primary">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <p class="panel-title">Deseja remover este registro?</p>
                        </header>
                        <article class="modal-body">
                            <ul class="list-unstyled">
                                <li><b>Código: </b><?php echo $historicos['cod_historico'] ?>;</li>
                                <li><b>Data: </b><?php echo $historicos['data_historico'] ?>;</li>
                                <li><b>Usuário: </b><?php echo $historicos['usuario'] ?>.</li>
                                <li><b> TDESK / Descrição: </b> <br><?php echo $historicos['descricao_historico'] ?>;</li>
                            </ul>

                            <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se remove este registro, o mesmo deixará de existe no sistema.</p>
                            <p class="text-ri"></p>
                        </article>
                        <footer class="modal-footer">
                            <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/historico/' . $historicos['cod_historico'] ?>" title="Excluir"> <i class="fa fa-trash"></i> Excluir</a>
                            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                        </footer>
                    </section>
                </article>
            </section>
            <?php
        endforeach;
    endif;
endif;
?>
