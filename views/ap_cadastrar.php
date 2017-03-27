<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Cadastrar AP</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-plus-sign"></i> Cadastrar AP</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <form method="POST" autocomplete="off">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <p class="panel-title">AP</p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadNome">Nome: </label>
                                    <input type="text" name="ncadNome" id="icadNome" class="text-uppercase form-control"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadIP">IP: </label>
                                    <input type="text" name="ncadIP" id="icadIP" class="text-uppercase form-control"/>
                                </div>
                                <div class="form-group col-sm-6 col-md-4 col-lg-4">
                                    <label for="icadCidade">Cidade: </label>
                                    <select name="ncadCidade" id="icadCidade" class=" form-control">
                                        <option value="ALTAMIRA" >ALTAMIRA</option>
                                        <option value="ITAITUBA" >ITAITUBA</option>
                                        <option value="SANTARÉM" >SANTARÉM</option>
                                        <option value="MARABÁ" >MARABÁ</option>
                                        <option value="PARAGOMINAS" >PARAGOMINAS</option>
                                        <option value="PLACAS" >PLACAS</option>
                                        <option value="RURÓPOLIS" >RURÓPOLIS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--fim .panel--> 
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="index.html" class="btn btn-danger">Cancelar</a>
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