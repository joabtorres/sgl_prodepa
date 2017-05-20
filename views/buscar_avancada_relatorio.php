<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Relatório Detalhado</h2>
                <ol class="breadcrumb">
                    <li><a  href="index.html"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> Relatório Detalhado</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span class="pull-right"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class=" btn btn-primary btn-xs" title="Exibir/Ocultar"><i class="fa fa-plus-square"></i></a></span>
                        <p class="panel-title">Relatório Detalhado </p>
                    </div>
                    <div id="collapseOne" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                            <form method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iCidade">Cidade: </label>
                                        <select class="form-control" name="nCidade" id="iCidade">
                                            <option value="Todas" >Todas</option>
                                            <option value="ALTAMIRA" >ALTAMIRA</option>
                                            <option value="ITAITUBA" >ITAITUBA</option>
                                            <option value="SANTARÉM" >SANTARÉM</option>
                                            <option value="MARABÁ" >MARABÁ</option>
                                            <option value="PARAGOMINAS" >PARAGOMINAS</option>
                                            <option value="PLACAS" >PLACAS</option>
                                            <option value="RURÓPOLIS" >RURÓPOLIS</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iConexao">Conexão:</label>
                                        <select name="nConexao" id="iConexao" class="form-control">
                                            <option value="Todos">Todos</option>
                                            <option value="Nome do orgão">Rádio</option>
                                            <option value="Nome do orgão">Fibra</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iAP">AP:</label>
                                        <select name="nAP" id="iAP" class="form-control">
                                            <option value="Todos">Todos</option>
                                            <option value="Todos">AP01</option>
                                            <option value="Todos">AP02</option>
                                            <option value="Todos">AP03</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iRedeMetro">Rede Metro: </label>
                                        <select name="nRedeMetro" id="iRedeMetro" class="form-control">
                                            <option value="Todos">Todos</option>
                                            <option value="Todos">Rede Metro 01</option>
                                            <option value="Todos">Rede Metro 02</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iOrgao">Orgão:</label>
                                        <select name="nOrgao" id="iOrgao" class="form-control">
                                            <option value="Todos">Todos</option>
                                            <option value="Nome do orgão">Nome do orgão</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="iCategoria">Categoria:</label>
                                        <select name="nCategoria" id="iCategoria" class="form-control">
                                            <option value="Todas">Todas</option>
                                            <option value="Municipal" >Municipal</option>
                                            <option value="Estadual">Estadual</option>
                                            <option value="Federal">Federal</option>
                                            <option value="Acordo de Cooperação Técnica">Acordo de Cooperação Técnica</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                        <label>Modo de Exibição:</label><br/>
                                        <label><input type="radio" name="nModoExibicao" value="Resumido" checked/> Resumido</label>
                                        <!--<label><input type="radio" name="nModoExibicao" value="Completo"/> Completo</label>-->
                                    </div>

                                    <div class="col-sm-6 col-md-6 col-lg-6 form-group">
                                        <label>Gera PDF:</label><br/>
                                        <label><input type="radio" name="nPDF" value="Sim" checked/> Sim</label>
                                        <label><input type="radio" name="nPDF" value="Não"/> Não</label>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 form-group">
                                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar</button>
                                    </div>
                                </div>
                                <!--fim row-->
                            </form>
                        </div>
                    </div>

                </div>
            </div> 
            <!--class="col-sm-12 col-md-12 col-lg-12"-->
            <div class="col-sm-12 col-md-12 col-lg-12">
                <!--PANEL--> 
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <p class="panel-title"><span class="font-bold">Cidade: </span> Itaituba</p>
                        <p class="panel-title"><span class="font-bold">Orgãos:  </span>SEDUC - Secretaria de Estado de Educação</p>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Unidade</th>
                                <th>IP</th>
                                <th>AP</th>
                                <th>Banda</th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <td class="text-center">1</td>
                                <td>E.E.E.M Benedito Correa de Souza</td>
                                <td>10.125.444.65</td>
                                <td>AP03</td>
                                <td>1 MegaBits</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>E.E.E.M Benedito Correa de Souza</td>
                                <td>10.125.444.65</td>
                                <td>AP03</td>
                                <td>1 MegaBits</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>E.E.E.M Benedito Correa de Souza</td>
                                <td>10.125.444.65</td>
                                <td>AP03</td>
                                <td>1 MegaBits</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>E.E.E.M Benedito Correa de Souza</td>
                                <td>10.125.444.65</td>
                                <td>AP03</td>
                                <td>1 MegaBits</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--FIM PANEL-->
            </div>
            <!--fim COL-SM-12 COL-MD-12 COL-LG-12-->
            <!--paginação-->
            <section class="clear col-xs-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li>
                            <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </section>
            <!--paginação-->
        </div>
        <!--fim row-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->