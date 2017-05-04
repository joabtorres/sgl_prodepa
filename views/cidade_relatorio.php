<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2><?php echo (isset($cidade)) ? $cidade['nome'] : "Cidades" ?></h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> <?php echo (isset($cidade)) ? $cidade['nome'] : "Cidades" ?></li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <?php
                if (isset($cidades)) {
                    foreach ($cidades as $resultado) :
                        ?>

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $resultado['cidade_area_atuacao'] ?>  <small class="pull-right"><a href="#">Editar</a> / <a href="#">Excluir</a></small> </p>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                    <th>Orgão</th>
                                    <th>AP</th>
                                    <th>Rede Metro</th>
                                    <th>Unidade</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/orgaos/1/' . $resultado['cod_area_atuacao'] ?>">Consultar Orgãos</a></td>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/aps/1/' . $resultado['cod_area_atuacao'] ?>">Consultar Ap's</a></td>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/redemetro/1/' . $resultado['cod_area_atuacao'] ?>">Consultar Rede Metro</a></td>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/unidades/1/' . $resultado['cod_area_atuacao'] ?>">Consultar Unidades</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    endforeach;
                }else {
                    echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div>';
                }
                ?>

            </div>
            <!--paginação-->
            <?php if (ceil($paginas) > 1): ?>
                <section class="clear col-xs-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="<?php echo BASE_URL ?>/relatorio/cidades/1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for ($p = 0; $p < ceil($paginas); $p++) {
                                if ($pagina_atual == ($p + 1)) {
                                    echo "<li class='active'><a href='" . BASE_URL . "/relatorio/cidades/" . ($p + 1) . "'>" . ($p + 1) . "</a></li>";
                                } else {
                                    echo "<li><a href='" . BASE_URL . "/relatorio/cidades/" . ($p + 1) . "'>" . ($p + 1) . "</a></li>";
                                }
                            }
                            ?>
                            <li>
                                <a href="<?php echo BASE_URL ?>/relatorio/cidades/<?php echo ceil($paginas) ?>" aria-label="Next">
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