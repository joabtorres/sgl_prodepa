<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Orgãos</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <?php if (isset($cod_cidade)): ?>
                        <li><a href="<?php echo BASE_URL ?>/relatorio/cidade"><i class="glyphicon glyphicon-th-list"></i> Cidades</a></li>
                    <?php endif; ?>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> Orgãos</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php
            //print_r($resultadoView);
            foreach ($resultadoView as $cidades):
                foreach ($cidades['orgaos'] as $orgao) :
                    if (!empty($orgao['unidades'])):
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?> </p>
                                    <p class="panel-title"><span class="font-bold">Orgãos:  </span> <?php echo $orgao['nome_orgao'] ?> <small class="pull-right"><a href="#">Editar</a> / <a href="#">Excluir</a></small></p>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Unidade</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $qtd = 1;
                                        foreach ($orgao['unidades'] as $unidade):
                                            ?>
                                            <tr>
                                                <td class="text-center table-qtd"><?php
                                                    echo $qtd;
                                                    $qtd++;
                                                    ?></td>
                                                <td><a href="relatorios_unidade.html"><?php echo $unidade['nome_unidade'] ?></a></td>
                                                <td class="table-acao"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_recupera">Editar</button> <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_recupera">Excluir</button></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
            endforeach;
            ?>

        </div>
        <!--fim COL-SM-12 COL-MD-12 COL-LG-12-->
        <!--paginação-->
        <?php if (count($resultadoView) > 0): ?>
            <section class="clear col-xs-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="<?php echo BASE_URL ?>/relatorio/orgao/1<?php echo (isset($cod_cidade)) ? "/" . $cod_cidade : "" ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        $cod_cidade = (isset($cod_cidade)) ? "/" . $cod_cidade : "";
                        for ($p = 0; $p < ceil($paginas); $p++) {
                            if ($pagina_atual == ($p + 1)) {
                                echo "<li class='active'><a href='" . BASE_URL . "/relatorio/orgao/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            } else {
                                echo "<li><a href='" . BASE_URL . "/relatorio/orgao/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            }
                        }
                        ?>
                        <li>
                            <a href="<?php echo BASE_URL ?>/relatorio/orgao/<?php echo ceil($paginas) . $cod_cidade ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>
            <!--paginação-->
        <?php endif; ?>
    </div>
    <!--fim row-->

    <div id="rodape">
        <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
    </div>
    <!--FIM #rodape-->
</div>
</div>
<!-- /#conteudo_sistema -->