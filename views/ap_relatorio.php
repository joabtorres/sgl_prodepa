<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2><?php echo (isset($ap)) ? $ap['nome'] : "Aps" ?></h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <?php if (isset($cidade)): ?>
                        <li><a href="<?php echo BASE_URL ?>/relatorio/cidades/1/<?php echo $cidade['cod'] ?>"><i class="fa fa-list"></i> <?php echo $cidade['nome'] ?></a></li>
                    <?php endif; ?>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> <?php echo (isset($ap)) ? $ap['nome'] : "Aps" ?></li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php
            if (isset($resultadoView)) {
                if (isset($ap)) {
                    foreach ($resultadoView as $cidades):
                        foreach ($cidades['aps'] as $aps) :
                            if (!empty($aps['unidades'])):
                                ?>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?> </p>
                                            <p class="panel-title"><span class="font-bold">AP: </span> <?php echo $aps['nome_ap'] ?> </p>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th>Unidade </span></th>
                                                        <th>Ação</th>
                                                    </tr>
                                                </thead>
                                                <tbody >
                                                    <?php
                                                    $qtd = 1;
                                                    foreach ($aps['unidades'] as $unidades):
                                                        ?>
                                                        <tr>
                                                            <td class="text-center table-qtd">
                                                                <?php
                                                                echo $qtd;
                                                                $qtd++;
                                                                ?>
                                                            </td>
                                                            <td><a href="<?php echo BASE_URL . '/unidade/ap/' . $unidades['cod_unidade'] ?>"><?php echo $unidades['nome_unidade'] ?></a></td>

                                                            <td class="table-acao"><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL . '/editar/unidade/' . $unidades['cod_unidade'] ?>"><i class="fa fa-pencil"></i></a> <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_unidade_<?php echo $cidades['cod_cidade'] . '_' . $aps['cod_ap'] . '_' . $unidades['cod_unidade'] ?>"><i class="fa fa-trash"></i></button></td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endif;
                        endforeach;
                    endforeach;
                }else {
                    foreach ($resultadoView as $cidades):
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?> </p>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-condensed">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>AP </th>
                                                <th>Banda </th>
                                                <th>IP </th>
                                                <th>Unidade(s)<span></th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php
                                            $qtd = 1;
                                            foreach ($cidades['aps'] as $aps) :
                                                if (!empty($aps['unidades'])):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center table-qtd">
                                                            <?php
                                                            echo $qtd;
                                                            $qtd++;
                                                            ?>
                                                        </td>
                                                        <td><a href="<?php echo BASE_URL . '/relatorio/aps/' . $pagina_atual . '/' . $cidades['cod_cidade'] . '/' . $aps['cod_ap'] ?>"><?php echo $aps['nome_ap'] ?></a></td>
                                                        <td><?php echo $aps['banda_ap'] ?></td>
                                                        <td><?php echo $aps['ip_ap'] ?></td>
                                                        <td class="text-center table-acao"><?php echo count($aps['unidades']) ?></td>
                                                        <td class="table-acao"><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL . '/editar/ap/' . $aps['cod_ap'] ?>"><i class="fa fa-pencil"></i></a> <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_aps_<?php echo $cidades['cod_cidade'] . '_' . $aps['cod_ap'] ?>"><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                    <?php
                                                endif;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php
                    endforeach;
                }
            } else {
                echo '<div class="col-xs-12"><div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div></div>';
            }
            ?>

        </div>
        <!--fim COL-SM-12 COL-MD-12 COL-LG-12-->
        <!--paginação-->
        <?php if (ceil($paginas) > 1): ?>
            <section class="clear col-xs-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="<?php echo BASE_URL ?>/relatorio/aps/1<?php echo (isset($cod_cidade)) ? "/" . $cod_cidade : "" ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        $cod_cidade = (isset($cod_cidade)) ? "/" . $cod_cidade : "";
                        for ($p = 0; $p < ceil($paginas); $p++) {
                            if ($pagina_atual == ($p + 1)) {
                                echo "<li class='active'><a href='" . BASE_URL . "/relatorio/aps/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            } else {
                                echo "<li><a href='" . BASE_URL . "/relatorio/aps/" . ($p + 1) . $cod_cidade . "'>" . ($p + 1) . "</a></li>";
                            }
                        }
                        ?>
                        <li>
                            <a href="<?php echo BASE_URL ?>/relatorio/aps/<?php echo ceil($paginas) . $cod_cidade ?>" aria-label="Next">
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
if (isset($resultadoView)) {
    if (isset($ap)) {
        foreach ($resultadoView as $cidades):
            foreach ($cidades['aps'] as $aps) :
                if (!empty($aps['unidades'])):
                    foreach ($aps['unidades'] as $unidades):
                        ?>
                        <!--MODAL - ESTRUTURA BÁSICA-->
                        <section class="modal fade" id="modal_unidade_<?php echo $cidades['cod_cidade'] . '_' . $aps['cod_ap'] . '_' . $unidades['cod_unidade'] ?>" tabindex="-1" role="dialog">
                            <article class="modal-dialog modal-md" role="document">
                                <section class="modal-content">
                                    <header class="modal-header bg-primary">
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <p class="panel-title">Deseja remover este registro?</p>
                                    </header>
                                    <article class="modal-body">
                                        <p class="text-justify"><?php echo '<b>Unidade: </b>' . $unidades['nome_unidade'] . ' - <b>Código: </b>' . $unidades['cod_unidade']; ?>;</p>
                                        <p class="text-justify text-danger"><span class="font-bold">OBS¹ : </span> Se você remove a unidade:  <b class="font-bold"><?php echo $unidades['nome_unidade']?></b>, será removido todos os respectivos dados como, por exemplo, endereço, contato e históricos.</p>
                                        <p class="text-ri"></p>
                                    </article>
                                    <footer class="modal-footer">
                                        <a class="btn btn-danger " href="<?php echo BASE_URL . '/excluir/unidade/' . $unidades['cod_unidade'] ?>"> <i class="fa fa-trash"></i> Excluir</a> | 
                                        <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                                    </footer>
                                </section>
                            </article>
                        </section>

                        <?php
                    endforeach;
                endif;
            endforeach;
        endforeach;
    }else {
        foreach ($resultadoView as $cidades):
            foreach ($cidades['aps'] as $aps) :
                if (!empty($aps['unidades'])):
                    ?>
                    <!--MODAL - ESTRUTURA BÁSICA-->
                    <section class="modal fade" id="modal_aps_<?php echo $cidades['cod_cidade'] . '_' . $aps['cod_ap'] ?>" tabindex="-1" role="dialog">
                        <article class="modal-dialog modal-md" role="document">
                            <section class="modal-content">
                                <header class="modal-header bg-primary">
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <p class="panel-title">Deseja remover este registro?</p>
                                </header>
                                <article class="modal-body">
                                    <p class="text-justify"><?php echo '<b>AP: </b>' . $aps['nome_ap'] . ' - <b>Código: </b>' . $aps['cod_ap'] . ' - <b> Unidade(s): </b> ' . count($aps['unidades']) ?>;</p>
                                    <p class="text-justify text-danger"><span class="font-bold">OBS¹ : </span> Se você remove o AP:  <b class="font-bold"><?php echo $aps['nome_ap'] ?></b>, será removido todas as unidades cadastradas e seus respectivos históricos.</p>
                                    <p class="text-ri"></p>
                                </article>
                                <footer class="modal-footer">
                                    <a class="btn btn-danger " href="<?php echo BASE_URL . '/excluir/ap/' . $aps['cod_ap'] ?>"> <i class="fa fa-trash"></i> Excluir</a> | 
                                    <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                                </footer>
                            </section>
                        </article>
                    </section>
                    <?php
                endif;
            endforeach;
        endforeach;
    }
}
?>