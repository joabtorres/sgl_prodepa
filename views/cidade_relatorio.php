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
                                <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $resultado['cidade_area_atuacao'] ?>  <small class="pull-right"><a href="<?php echo BASE_URL . '/editar/cidade/' . $resultado['cod_area_atuacao'] ?>"><i class="fa fa-pencil"></i></a> / <span data-toggle="modal"  data-target="#modal_cidade<?php echo $resultado['cod_area_atuacao'] ?>" class="cursor-pointer"><i class="fa fa-trash"></i></span></small> </p>
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

<?php
if (isset($cidades)) :
    foreach ($cidades as $resultado) :
        ?>

        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_cidade<?php echo $resultado['cod_area_atuacao'] ?>" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="panel-title">Deseja remover este registro?</p>
                    </header>
                    <article class="modal-body">
                        <p class="text-justify"><?php echo '<b>Cidade: </b>'.$resultado['cidade_area_atuacao']. ' - <b>Código: </b>'.$resultado['cod_area_atuacao'] ?></p>
                        <p class="text-justify text-danger"><span class="font-bold">OBS¹ : </span> Se você remove o registro <b class="font-bold"><?php echo $resultado['cidade_area_atuacao'] ?></b>, será removido todos os dados relacionados a este registro, por exemplo, unidades e tipos de conexões (Ap e Rede Metro). </p>
                        <p class="text-ri"></p>
                    </article>
                    <footer class="modal-footer">
                        <a class="btn btn-danger " href="<?php echo BASE_URL . '/excluir/cidade/' . $resultado['cod_area_atuacao'] ?>"> <i class="fa fa-trash"></i> Excluir</a> | 
                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
        <?php
    endforeach;
endif;
?>