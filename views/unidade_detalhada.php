<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2><?php echo isset($unidade) ? $unidade['nome'] : ''; ?></h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li><a  href="<?php echo BASE_URL ?>/relatorio/cidades/1<?php echo isset($cidade) ? '/' . $cidade['cod'] : "" ?>"><i class="glyphicon glyphicon-th-list"></i>  <?php echo isset($cidade) ? $cidade['nome'] : "Cidades" ?></a></li>
                    <?php
                    if (isset($orgao)) {
                        ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/orgaos/1/<?php echo $cidade['cod'].'/'.$orgao['cod'] ?>"><i class="glyphicon glyphicon-th-list"></i>  <?php echo $orgao['nome'] ?></a></li>
                    <?php } else if (isset($ap)) { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/aps/1/<?php echo $cidade['cod'].'/'.$ap['cod'] ?>"><i class="glyphicon glyphicon-th-list"></i>  <?php echo $ap['nome'] ?></a></li>
                    <?php } else if (isset($redemetro)) { ?>
                        <li><a  href="<?php echo BASE_URL ?>/relatorio/orgaos/1/<?php echo $cidade['cod'] ?>"><i class="glyphicon glyphicon-th-list"></i> Rede Metro</a></li>
                    <?php } ?>
                    <li class="active"><i class="glyphicon glyphicon-list-alt"></i>  <?php echo isset($unidade) ? $unidade['nome'] : ''; ?></li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php
            if (count($resultado_unidade)) {
                ?>
                <div class="col-md-12">
                    <p class="text-justify"><span class="title-destaque">Cidade:</span> 
                        <?php echo $resultado_unidade['cidade_area_atuacao'] ?>
                    </p>
                    <p class="text-justify"><span class="title-destaque">Orgão: </span> 
                        <?php echo $resultado_unidade['nome_orgao'] ?>
                    </p>
                    <p class="text-justify"><span class="title-destaque">Unidade:</span> 
                        <?php echo $resultado_unidade['nome_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque">Tipo: </span> 
                        <?php echo $resultado_unidade['categoria_orgao'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> Conexão:   </span> 
                        <?php echo $resultado_unidade['conexao_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque">ZABBIX: </span> 
                        <?php echo $resultado_unidade['zabbix_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> Data de Ativação:  </span> 
                        <?php echo $resultado_unidade['data_ativacao_unidade'] ?>
                    </p>
                </div>

                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> Banda:   </span> 
                        <?php echo $resultado_unidade['banda_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> Status:   </span> 
                        <?php echo $resultado_unidade['statu_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> IP:    </span> 
                        <?php echo $resultado_unidade['ip_unidade'] ?>
                    </p>
                </div>

                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> NOME VLAN:</span> 
                        <?php echo $resultado_unidade['nome_vlan_unidade'] ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p class="text-justify"><span class="title-destaque"> TAG VLAN:</span> 
                        <?php echo $resultado_unidade['tag_vlan_unidade'] ?>
                    </p>
                </div>
                <?php if (isset($resultado_unidade['nome_ap'])) : ?>
                    <div class="col-md-4">
                        <p class="text-justify"><span class="title-destaque"> AP:    </span> 
                            <?php echo $resultado_unidade['nome_ap'] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class="text-justify"><span class="title-destaque"> IP AP:    </span> 
                            <?php echo $resultado_unidade['ip_ap'] ?>
                        </p>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <p class="text-justify"><span class="title-destaque">Endereço:</span> 
                        <?php echo $resultado_unidade['logradouro_endereco'] . ', ' . $resultado_unidade['numero_endereco'] . ', Bairro ' . $resultado_unidade['bairro_endereco'] . ', ' . $resultado_unidade['complemento_endereco'] . ' - ' . $resultado_unidade['cidade_area_atuacao'] ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="text-justify"><span class="title-destaque">GPS:</span> 
                        <?php echo $resultado_unidade['gps_endereco'] ?>
                    </p>
                    <p class="text-justify"><span class="title-destaque">Contato(s):</span> 
                        <?php
                        if (isset($resultado_unidade['contatos'])) :
                            foreach ($resultado_unidade['contatos'] as $contatos) :
                                ?>
                                <span class="font-stronge">Nome:</span> <?php echo $contatos['nome_contato'] ?> <br/>
                                <span class="font-stronge">Telefone 1:</span>  <?php echo $contatos['telefone1_contato'] ?> <br/>
                                <span class="font-stronge">Telefone 2:</span>  <?php echo $contatos['telefone2_contato'] ?> <br/>
                                <span class="font-stronge">E-mail: </span> <?php echo $contatos['email_contato'] ?><br/>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </p>
                    <p class="text-justify"><span class="title-destaque">Acesso Rápido:</span> 
                        Gráfico no Zabbix: <a href="<?php echo $resultado_unidade['url_zabbix_unidade'] ?>" target="_blank">Clique aqui!</a><br/>
                        Rádio: <a href="http://<?php echo $resultado_unidade['ip_unidade'] ?>"  target="_blank">Clique aqui!</a><br/>
                    </p>
                </div>
                <div class="col-md-6">
                    <p class="text-justify"><span class="title-destaque">Localização no Google Maps:</span> </p>
                    <div id="view-mapa-unidade"></div>
                    <!-- CHAMANDO GOOGLE MAPS API -->
                    <script src="http://maps.google.com/maps/api/js?key=AIzaSyCWbC3lfteLuL87PJLoU2yBKv4fyF_DGDQ&sensor=false"></script>
                    <?php echo '
                    <script type = "text/javascript">
                    var latitude = '.$resultado_unidade["latitude_endereco"].';
                    var longitude = '.$resultado_unidade["longitude_endereco"].';
                    </script> '
                    ?>
                </div>
                <?php
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div>';
            }
            ?>
        </div> <!--FIM ROW-->
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->