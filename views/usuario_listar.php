<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Lista Usuário</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-th-list"></i> Lista Usuário</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row" id="container-usuario">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading"><p class="panel-title">Buscar</p></div>
                    <div class="panel-body">
                        <form method="POST" autocomplete="off">
                            <div class="col-md-6 form-group">
                                <label for="iCampo">Campo:  </label>
                                <input type="text" class="form-control" name="nCampo" id="iCampo"/>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="iSelectBuscar">Por:</label>
                                <select class="form-control" name="nSelectBuscar" id="iSelectBuscar">
                                    <option value="Código">Código</option>
                                    <option value="Email">Email</option>
                                </select>
                            </div>
                            <div class="col-md-2 form-group"><br/>
                                <button type="submit" class="btn btn-primary form-control">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--FIM .PANEL-->
            </div>
            <!--thumbnal usuario-->
            <?php
            if (isset($usuarios)) {
                foreach ($usuarios as $usuario):
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-4">                            
                        <div class=" thumbnail">
                            <img src="<?php echo BASE_URL.'/'.$usuario['img_usuario'] ?>" alt="SGL - Usuáio" class="img-responsive img-circle"/>
                            <p class="text-center text-uppercase font-bold"><?php echo $usuario['nome_usuario'].' '.$usuario['sobrenome_usuario'].' - Código '.$usuario['cod_usuario']?></p>
                            <p class="text-center text-lowercase"><?php echo $usuario['email_usuario']?></p>
                            <p class="text-center text-capitalize"><?php echo $usuario['cargo_usuario']?></p>
                            <div class="caption">
                                <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal_recupera">Recupera Senha</button>
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_recupera">Editar</button>
                                <button type="button"  class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal_recupera">Excluir</button>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            }else {
                
            }
            ?>
            <!--thumbnal usuario-->
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
        <!--FIM .ROW-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->