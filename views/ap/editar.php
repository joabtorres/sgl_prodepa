<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Editar AP</h2>
                <ol class="breadcrumb">
                    <li><a  href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer"></i> Inicial</a></li>
                    <li class="active"><i class="fa fa-pencil"></i> Editar AP</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert <?php echo (isset($erro['class'])) ? $erro['class'] : 'alert-warning'; ?> " role="alert" id="alert-msg">
                    <button class="close" data-hide="alert">&times;</button>
                    <div id="resposta"><?php echo (isset($erro['msg'])) ? $erro['msg'] : '<i class="fa fa-info-circle" aria-hidden="true"></i>  Não é possível alterar a cidade!'; ?></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">AP</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <input type="hidden" name="neditCod" value="<?php echo isset($ap) ? $ap['cod_ap'] : ""; ?>"/>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditCidade">Cidade: </label>
                                    <select name="neditCidade" id="ieditCidade" class=" form-control" disabled>
                                        <option value="<?php echo $ap['cod_area_atuacao'] ?>"><?php echo $ap['cidade_area_atuacao'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6 col-md-8 col-lg-8">
                                    <label for="ieditNome">Nome: </label>
                                    <input type="text" name="neditNome" id="ieditNome" class="form-control" placeholder="Exemplo: AP-01" value="<?php echo isset($ap) ? $ap['nome_ap'] : ""; ?>"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditBanda">Banda: </label>
                                    <input type="text" name="neditBanda" id="ieditBanda" class="form-control" placeholder="Exemplo: 10 Mbps" value="<?php echo isset($ap) ? $ap['banda_ap'] : ""; ?>"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditCCode">Color Code: </label>
                                    <input type="text" name="neditCCode" id="ieditCCode" class="form-control" placeholder="Exemplo: 11" value="<?php echo isset($ap) ? $ap['color_code_ap'] : ""; ?>"/>
                                </div> 
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="ieditIP">IP: </label>
                                    <input type="text" name="neditIP" id="ieditIP" class="form-control" placeholder="Exemplo: 10.101.45.14" value="<?php echo isset($ap) ? $ap['ip_ap'] : ""; ?>"/>
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