<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Cidade</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-plus-sign"></i> Cadastrar Cidade</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : 'Não é possível cadastrar um núcleo ou uma área de atuação já cadastrado.'; ?></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off" id="form-cidade">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">Cidade</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadCidade">Cidade: </label>
                                    <input type="text" name="ncadCidade" id="icadCidade" class=" form-control" placeholder="Exemplo: Belém"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadCategoria">Categoria: </label>
                                    <select name="ncadCategoria" id="icadCategoria" class=" form-control" onchange="oculta_nucleo(this)">
                                        <option value="Área de Atuação">Área de Atuação</option>
                                        <option value="Núcleo" >Núcleo</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadNucleo">Núcleo Responsável: </label>
                                    <select name="ncadNucleo" id="icadNucleo" class=" form-control">
                                        <?php
                                        foreach ($nucleos as $nucleo) {
                                            echo '<option value="' . $nucleo['cod_nucleo'] . '" >Núcleo ' . $nucleo['cidade_nucleo'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fim .panel--> 
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success" name="nSalvar" value="Salvar">Salvar</button>
                            <a href="<?php echo BASE_URL ?>/home" class="btn btn-danger">Cancelar</a>
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