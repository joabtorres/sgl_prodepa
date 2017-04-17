<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cidades</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> Cidades</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">

                <?php
                if (count($cidades) > 0):
                    foreach ($cidades as $cidade) :
                        ?>

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidade['cidade_area_atuacao'] ?>  <small class="pull-right"><a href="#">Editar</a> / <a href="#">Excluir</a></small> </p>
                            </div>
                            <table class="table table-striped table-bordered table-hover table-condensed">
                                <tr>
                                    <th>Orgão</th>
                                    <th>AP</th>
                                    <th>Unidade</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/orgao/1/' . $cidade['cod_area_atuacao'] ?>">Consultar Orgãos</a></td>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/ap/1/' . $cidade['cod_area_atuacao'] ?>">Consultar Ap's</a></td>
                                        <td><a href="<?php echo BASE_URL . '/relatorio/unidade/1/' . $cidade['cod_area_atuacao'] ?>">Consultar Unidades</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach;
                endif;
                ?>

            </div>
            <!--paginação-->
<?php if (count($cidades) > 0): ?>
                <section class="clear col-xs-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li>
                                <a href="<?php echo BASE_URL ?>/relatorio/cidade/1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for ($p = 0; $p < ceil($paginas); $p++) {
                                if ($pagina_atual == ($p + 1)) {
                                    echo "<li class='active'><a href='" . BASE_URL . "/relatorio/cidade/" . ($p + 1) . "'>" . ($p + 1) . "</a></li>";
                                } else {
                                    echo "<li><a href='" . BASE_URL . "/relatorio/cidade/" . ($p + 1) . "'>" . ($p + 1) . "</a></li>";
                                }
                            }
                            ?>
                            <li>
                                <a href="<?php echo BASE_URL ?>/relatorio/cidade/<?php echo ceil($paginas) ?>" aria-label="Next">
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