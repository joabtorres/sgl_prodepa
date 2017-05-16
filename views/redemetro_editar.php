<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Editar Rede Metro</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-pencil"></i> Editar Rede Metro</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i>  Não é possível alterar a cidade !'; ?></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off" id="form-unidade">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">Rede Metro</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <input type="hidden" name="neditCod" value="<?php echo isset($redemetro) ? $redemetro['cod_redemetro'] : ""; ?>" />
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditCidade">Cidade: </label>
                                    <select name="neditCidade" id="ieditCidade" class=" form-control" disabled>
                                        <?php
                                            echo '<option value="' . $redemetro['cod_area_atuacao'] . '" >' . $redemetro['cidade_area_atuacao'] . '</option>';
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditNome">Nome: </label>
                                    <input type="text" name="neditNome" id="ieditNome" class="form-control" placeholder="Exemplo: Rede Metro Itaituba" value="<?php echo isset($redemetro) ? $redemetro['nome_redemetro'] : ""; ?>"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditEstensao">Estensão: </label>
                                    <input type="text" name="neditEstensao" id="ieditEstensao" class="form-control" placeholder="Exemplo: 5.4 Km" value="<?php echo isset($redemetro) ? $redemetro['estensao_redemetro'] : ""; ?>"/>
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