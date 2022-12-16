<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Editar Cidade</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-pencil"></i> Editar Cidade</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : ' <i class="fa fa-info-circle" aria-hidden="true"></i> Cuidado em alterar o núcleo responsável, caso altere a cidade para qual o núcleo é responsável a mesma deixara de ser consultada nos relatórios.'; ?></div>
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
                                <input type="hidden" name="neditCod" value="<?php echo isset($cidade) ? $cidade['cod_area_atuacao'] : '' ?>"/>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditCidade">Cidade: </label>
                                    <input type="text" name="neditCidade" id="ieditCidade" class=" form-control" placeholder="Exemplo: Belém" value="<?php echo isset($cidade) ? $cidade['cidade_area_atuacao'] : '' ?>"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditCategoria">Categoria: </label>
                                    <select name="neditCategoria" id="ieditCategoria" class=" form-control" onchange="oculta_nucleo(this)">
                                        <option value="Área de Atuação">Área de Atuação</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditNucleo">Núcleo Responsável: </label>
                                    <select name="neditNucleo" id="ieditNucleo" class=" form-control">
                                        <?php
                                        foreach ($nucleos as $nucleo) {
                                            if (isset($cidade) && $cidade['cod_nucleo'] == $nucleo['cod_nucleo']) {
                                                echo '<option value="' . $nucleo['cod_nucleo'] . '" selected>Núcleo ' . $nucleo['cidade_nucleo'] . '</option>';
                                            } else {
                                                echo '<option value="' . $nucleo['cod_nucleo'] . '" >Núcleo ' . $nucleo['cidade_nucleo'] . '</option>';
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