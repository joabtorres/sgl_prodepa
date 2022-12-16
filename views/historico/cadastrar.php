<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Histórico</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li><a  href="<?php echo BASE_URL ?>/unidade/index/<?php echo isset($unidade) ? $unidade['cod_unidade']: ''; ?>"><i class="fa fa-list"></i> <?php echo isset($unidade) ? $unidade['nome_unidade']: ''; ?></a></li>
                    <li class="active"><i class="fa fa-plus-square"></i> Cadastrar Histórico</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <?php if (isset($erro['msg'])): ?>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                        <button class="close" data-hide="alert">&times;</button>
                        <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : ''; ?></div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off" id="form-cidade">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">Histórico</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-7 col-lg-8">
                                    <label for="icadUnidade">Unidade: </label>
                                    <input type="hidden" name="ncadCodUnidade" value="<?php echo isset($unidade) ? $unidade['cod_unidade']: ''; ?>"/>
                                    <input type="text" name="ncadUnidade" id="icadUnidade" class=" form-control"  disabled="true" value="<?php echo isset($unidade) ? $unidade['nome_unidade']: ''; ?>"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-5 col-lg-4">
                                    <label for="icadUsuario">Usuário: </label>
                                    <input type="hidden" name="ncadCodUsuario" value="<?php echo isset($usuario) ? $usuario['cod_usuario']: ''; ?>"/>
                                    <input type="text" name="ncadUsuario" id="icadUsuario" class=" form-control"  disabled="true" value="<?php echo isset($usuario) ? $usuario['usuario_usuario']: ''; ?>"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="icadDescricao">Descrição: </label>
                                    <textarea name="ncadDescricao" id="icadDescricao" class="form-control" placeholder="Exemplo: Descrição do histórico..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fim .panel--> 
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Salvar</button>
                            <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->