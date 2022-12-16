<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Editar Orgão</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-pencil"></i> Editar Orgão</li>
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
                                <input type="hidden" name="neditCod" value="<?php echo isset($orgao) ? $orgao['cod_orgao'] : ""; ?>"/> 
                                <div class="form-group col-sm-12 col-md-8 col-lg-8">
                                    <label for="ieditOrgao">Orgão: </label>
                                    <input type="text" name="neditOrgao" id="ieditOrgao" class="form-control" placeholder="Exemplo:  ADEPARÁ - Agência de Defesa Agropecuária do Estado do Pará " value="<?php echo isset($orgao) ? $orgao['nome_orgao'] : ""; ?>"/>
                                </div>
                                <div class="form-group col-sm-12 col-md-4 col-lg-4">
                                    <label for="ieditCategoria">Esfera: </label>
                                    <select name="neditCategoria" id="ieditCategoria" class=" form-control">
                                        <?php
                                        $esfera = array('Estadual', 'Federal', 'Municipal', 'Privado', 'Terceiro Setor');
                                        for ($i = 1; $i <= count($esfera); $i++) {
                                            if ($esfera[$i] == $orgao['categoria_orgao']) {
                                                echo '<option value="' . $esfera[$i] . '" selected>' . $esfera[$i] . '</option>';
                                            } else {
                                                echo '<option value="' . $esfera[$i] . '">' . $esfera[$i] . '</option>';
                                            }
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