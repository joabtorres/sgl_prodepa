<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2><?php echo (isset($orgao)) ? $orgao['nome'] : "Orgãos" ?></h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <?php if (isset($cidade)): ?>
                        <li><a href="<?php echo BASE_URL ?>/relatorio/cidades/1/<?php echo $cidade['cod'] ?>"><i class="glyphicon glyphicon-th-list"></i> <?php echo $cidade['nome'] ?></a></li>
                    <?php endif; ?>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> <?php echo (isset($orgao)) ? $orgao['nome'] : "Orgãos" ?></li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php
            if (isset($resultadoView)) {
                if (isset($orgao)) {
                    foreach ($resultadoView as $cidades):
                        foreach ($cidades['orgaos'] as $orgaos) :
                            if (!empty($orgaos['unidades'])):
                                ?>

                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?> </p>
                                            <p class="panel-title"><span class="font-bold">Orgão: </span> <?php echo $orgaos['nome_orgao'] ?> -  <?php echo $orgaos['categoria_orgao'] ?></p>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-condensed">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Unidade </th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <?php
                                                $qtd = 1;
                                                foreach ($orgaos['unidades'] as $unidades):
                                                    ?>
                                                    <tr>
                                                        <td class="text-center table-qtd">
                                                            <?php
                                                            echo $qtd;
                                                            $qtd++;
                                                            ?>
                                                        </td>
                                                        <td><a href="<?php echo BASE_URL . '/unidade/orgao/' . $unidades['cod_unidade'] . '/' . $cidades['cod_cidade'] . '/' . $orgaos['cod_orgao'] ?>"><?php echo $unidades['nome_unidade'] ?></a></td>

                                                        <td class="table-acao"><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL . '/editar/unidade/' . $unidades['cod_unidade'] ?>"><i class="fa fa-pencil"></i></a> <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_recupera"><i class="fa fa-trash"></i></button></td>
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
                }else {
                    foreach ($resultadoView as $cidades):
                        ?>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <p class="panel-title"><span class="font-bold">Cidade: </span> <?php echo $cidades['cidade'] ?> </p>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th> Orgão </th>
                                            <th>Esfera </th>
                                            <th>Unidade(s)</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $qtd = 1;
                                        foreach ($cidades['orgaos'] as $orgaos) :
                                            if (!empty($orgaos['unidades'])):
                                                ?>
                                                <tr>
                                                    <td class="text-center table-qtd">
                                                        <?php
                                                        echo $qtd;
                                                        $qtd++;
                                                        ?>
                                                    </td>
                                                    <td><a href="<?php echo BASE_URL . '/relatorio/orgaos/' . $pagina_atual . '/' . $cidades['cod_cidade'] . '/' . $orgaos['cod_orgao'] ?>"><?php echo $orgaos['nome_orgao'] ?></a></td>
                                                    <td><?php echo $orgaos['categoria_orgao'] ?></td>
                                                    <td class="text-center "><?php echo count($orgaos['unidades']) ?></td>
                                                    <td class="table-acao"><a class="btn btn-primary btn-sm" href="<?php echo BASE_URL . '/editar/orgao/' . $orgaos['cod_orgao'] ?>"><i class="fa fa-pencil"></i></a> <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_recupera"><i class="fa fa-trash"></i></button></td>
                                                </tr>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
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