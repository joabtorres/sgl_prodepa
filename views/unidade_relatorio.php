<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Unidades</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL . '/home' ?>"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <?php if (isset($cidade)) : ?>
                        <li><a  href="<?php echo BASE_URL . '/relatorio/cidades/1/' . $cidade['cod'] ?>"><i class="fa fa-list"></i> <?php echo $cidade['nome'] ?></a></li>
                    <?php endif; ?>
                    <li class="active"><i class="fa fa-list"></i> Unidades</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php
            if (isset($resultadoView)) {
                foreach ($resultadoView as $cidades):
                    if (!empty($cidades['unidades'])) :
                        ?>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?></p>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Unidade</th>
                                            <?php if (isset($_SESSION['user_sgl']['nivel']) && !empty($_SESSION['user_sgl']['nivel'])): ?>
                                                <th>Ação</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $qtd = 1;
                                        foreach ($cidades['unidades'] as $unidade):
                                            ?>
                                            <tr>
                                                <td class="text-center table-qtd">
                                                    <?php
                                                    echo $qtd;
                                                    $qtd++;
                                                    ?>
                                                </td>
                                                <td><a href="<?php echo BASE_URL ?>/unidade/index/<?php echo $unidade['cod_unidade'] ?>"><?php echo $unidade['nome_unidade'] ?></a></td>
                                                <?php if (isset($_SESSION['user_sgl']['nivel']) && !empty($_SESSION['user_sgl']['nivel'])): ?>
                                                    <td class="table-acao"><a class="btn btn-primary btn-xs" href="<?php echo BASE_URL . '/editar/unidade/' . $unidade['cod_unidade'] ?>" title="Editar"><i class="fa fa-pencil"></i></a> <button type="button"  class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal_unidade_<?php echo $cidades['cod_cidade'] . '_' . $unidade['cod_unidade'] ?>" title="Excluir"><i class="fa fa-trash"></i></button></td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        endif;
                    endforeach;
                } else {
                    echo '<div class="col-xs-12"><div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div></div>';
                }
                ?>
            </div>  
            <!--PANEL--> 
        </div>
        <!--fim COL-SM-12 COL-MD-12 COL-LG-12-->
        <!--paginação-->
        <?php if (ceil($paginas) > 1): ?>
            <section class="clear col-xs-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="<?php echo BASE_URL . '/relatorio/' . $action . '/1' ?><?php echo (isset($cod_cidade)) ? "/" . $cod_cidade : "" ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        $cod_cidade = (isset($cod_cidade)) ? "/" . $cod_cidade : "";
                        for ($p = 0; $p < ceil($paginas); $p++) {
                            if ($pagina_atual == ($p + 1)) {
                                echo "<li class='active'><a href='" . BASE_URL . "/relatorio/" . $action . "/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            } else {
                                echo "<li><a href='" . BASE_URL . "/relatorio/" . $action . "/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            }
                        }
                        ?>
                        <li>
                            <a href="<?php echo BASE_URL . '/relatorio/' . $action . '/' . ceil($paginas) . $cod_cidade ?>" aria-label="Next">
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
if (isset($_SESSION['user_sgl']['nivel']) && !empty($_SESSION['user_sgl']['nivel'])):
    if (isset($resultadoView)) {
        foreach ($resultadoView as $cidades):
            if (!empty($cidades['unidades'])) :

                foreach ($cidades['unidades'] as $unidades):
                    ?>
                    <!--MODAL - ESTRUTURA BÁSICA-->
                    <section class="modal fade" id="modal_unidade_<?php echo $cidades['cod_cidade'] . '_' . $unidades['cod_unidade'] ?>" tabindex="-1" role="dialog">
                        <article class="modal-dialog modal-md" role="document">
                            <section class="modal-content">
                                <header class="modal-header bg-primary">
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4>Deseja remover este registro?</h4>
                                </header>
                                <article class="modal-body">
                                    <ul class="list-unstyled">
                                        <li><b>Código: </b> <?php echo $unidades['cod_unidade']?>; </li>
                                        <li><b>Unidade: </b> <?php echo $unidades['nome_unidade']?>. </li>
                                    </ul>
                                    <p class="text-danger"><span class="font-bold">OBS : </span> Se você remove está unidade, será removido todos os respectivos dados como, por exemplo, endereço, contrato, contato e históricos.</p>
                                </article>
                                <footer class="modal-footer">
                                    <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/unidade/' . $unidades['cod_unidade'] ?>"> <i class="fa fa-trash"></i> Excluir</a>
                                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                                </footer>
                            </section>
                        </article>
                    </section>
                    <?php
                endforeach;
            endif;
        endforeach;
    }
endif;
?>
