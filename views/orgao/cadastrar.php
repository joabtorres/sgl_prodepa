<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar Orgão</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-plus-square"></i> Cadastrar Orgão</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um orgão já cadastrado.'; ?></div>
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
                                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                                    <label for="icadOrgao">Orgão: </label>
                                    <input type="text" name="ncadOrgao" id="icadOrgao" class="form-control" placeholder="Exemplo:  ADEPARÁ - Agência de Defesa Agropecuária do Estado do Pará "/>
                                </div>
                                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                    <label for="icadCategoria">Esfera: </label>
                                    <select name="ncadCategoria" id="icadCategoria" class=" form-control">
                                        <option value="Estadual">Estadual</option>
                                        <option value="Federal">Federal</option>
                                        <option value="Municipal" >Municipal</option>
                                        <option value="Privado">Privado</option>
                                        <option value="Terceiro Setor">Terceiro Setor</option>
                                    </select>
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