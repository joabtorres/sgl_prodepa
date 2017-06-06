<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Lista Usuário</h2>
                <ol class="breadcrumb">
                    <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-list "></i> Lista Usuário</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row" id="container-usuario">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><p class="panel-title">Buscar</p></div>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="iSelectBuscar">Por:</label>
                                        <select class="form-control" name="nSelectBuscar" id="iSelectBuscar">
                                            <option value="E-mail">E-mail</option>
                                            <option value="Código">Código</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="iCampo">Campo:  </label>
                                        <input type="text" class="form-control" name="nCampo" id="iCampo"/>
                                    </div>
                                </div>
                                <div class="col-md-2"><br/>
                                    <button type="submit" class="btn btn-primary" name="nBuscar" value="Buscar">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--FIM .PANEL-->
            </div>
            <!--thumbnal usuario-->
            <?php
            if (isset($usuarios)) {
                foreach ($usuarios as $usuario):
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-4">                            
                        <div class=" thumbnail">
                            <img src="<?php echo BASE_URL . '/' . $usuario['img_usuario'] ?>" alt="SGL - Usuáio" class="img-responsive img-circle"/>
                            <p class="text-center text-uppercase font-bold"><?php echo $usuario['nome_usuario'] . ' ' . $usuario['sobrenome_usuario'] . ' - Código ' . $usuario['cod_usuario'] ?></p>
                            <p class="text-center text-lowercase"><?php echo $usuario['email_usuario'] ?></p>
                            <p class="text-center text-capitalize"><?php echo $usuario['cargo_usuario'] ?></p>
                            <div class="caption text-center">
                                <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#modal_recupera_senha_<?php echo $usuario['cod_usuario'] ?>" title="Recupera Senha"><i class="fa fa-sign-out"></i> Recupera Senha</button> 
                                <a href="<?php echo BASE_URL . '/editar/usuario/' . $usuario['cod_usuario'] ?>" class="btn btn-primary btn-block btn-sm" title="Editar"><i class="fa fa-pencil"></i> Editar</a> 
                                <button type="button"  class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#modal_excluir_<?php echo $usuario['cod_usuario'] ?>" title="Excluir"> <i class="fa fa-trash"></i> Excluir</button>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            }else {
                echo '<div class="col-xs-12"><div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div></div>';
            }
            ?>

        </div>
        <!--FIM .ROW-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->
<?php
if (isset($_SESSION['user_sgl']['nivel']) && !empty($_SESSION['user_sgl']['nivel'])):
    if (isset($usuarios)) :
        foreach ($usuarios as $usuario):
            ?>
            <!--MODAL - ESTRUTURA BÁSICA-->
            <section class="modal fade" id="modal_recupera_senha_<?php echo $usuario['cod_usuario'] ?>" tabindex="-1" role="dialog">
                <article class="modal-dialog modal-md" role="document">
                    <section class="modal-content">
                        <header class="modal-header bg-primary">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3>Esqueceu a senha?</h3>
                        </header>
                        <article class="modal-body">
                            <ul class="list-unstyled">
                                <li><b class="font-bold">Código: </b> <?php echo $usuario['cod_usuario']; ?>;</li>
                                <li><b class="font-bold">Nome: </b> <?php echo $usuario['nome_usuario'] . ' ' . $usuario['sobrenome_usuario'] ?>;</li>
                                <li><b class="font-bold">E-mail: </b> <?php echo $usuario['email_usuario'] ?>;</li>
                                <?php if (isset($usuario['cargo_usuario'])) : ?>
                                    <li><b class="font-bold">Cargo: </b> <?php echo $usuario['cargo_usuario'] ?>.</li>
                                <?php endif; ?>
                            </ul>
                            <form method="POST">
                                <input type="hidden" name="nEmail" value="<?php echo $usuario['email_usuario'] ?>"/>
                                <button type="submit" value="Enviar" name="nEnviar" class=" btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Enviar email de verificação</button>
                            </form>
                        </article>
                        <footer class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-close"></i> Fechar</button>
                        </footer>
                    </section>
                </article>
            </section>

            <section class="modal fade" id="modal_excluir_<?php echo $usuario['cod_usuario'] ?>" tabindex="-1" role="dialog">
                <article class="modal-dialog modal-md" role="document">
                    <section class="modal-content">
                        <header class="modal-header bg-primary">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h3>Deseja remover este registro?</h3>
                        </header>
                        <article class="modal-body">
                            <ul class="list-unstyled">
                                <li><b class="font-bold">Código: </b> <?php echo $usuario['cod_usuario']; ?>;</li>
                                <li><b class="font-bold">Nome: </b> <?php echo $usuario['nome_usuario'] . ' ' . $usuario['sobrenome_usuario'] ?>;</li>
                                <li><b class="font-bold">E-mail: </b> <?php echo $usuario['email_usuario'] ?>;</li>
                                <?php if (isset($usuario['cargo_usuario'])) : ?>
                                    <li><b class="font-bold">Cargo: </b> <?php echo $usuario['cargo_usuario'] ?>.</li>
                                <?php endif; ?>
                            </ul>
                            <p class="text-justify text-danger"><span class="font-bold">OBS¹ : </span> Se você remove este usuário, será removido não só o usuário, como também todos históricos registrados por este usuário.</p>

                        </article>
                        <footer class="modal-footer">
                            <a class="btn btn-danger " href="<?php echo BASE_URL . '/excluir/usuario/' . $usuario['cod_usuario'] ?>"> <i class="fa fa-trash"></i> Excluir</a> | 
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
