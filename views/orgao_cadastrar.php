<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Orgão</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL; ?>/home"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-plus-sign"></i> Cadastrar Orgão</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : 'Não é possível cadastrar um orgão já cadastrado.'; ?></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">Orgão</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label for="icadOrgao">Orgão: </label>
                                    <input type="text" name="ncadOrgao" id="icadOrgao" class="text-uppercase form-control"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                    <label for="icadCategoria">Categoria: </label>
                                    <select name="ncadCategoria" id="icadCategoria" class=" form-control">
                                        <option value="Municipal" >Municipal</option>
                                        <option value="Estadual">Estadual</option>
                                        <option value="Federal">Federal</option>
                                        <option value="Privado">Privado</option>
                                        <option value="Acordo de Cooperação Técnica">Acordo de Cooperação Técnica</option>
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