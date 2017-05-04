<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/gif" href="<?php echo BASE_URL ?>/assets/imagens/icon-prodepa.gif" sizes="32x32" />
        <meta property="ogg:title" content="PRODEPA - SGL -Sistema de Gerênciamento de Link's ">
        <meta property="ogg:description" content="Sistema de Gerenciamento de Link's - PRODEPA !">
        <title> PRODEPA - SGL -Sistema de Gerenciamento de Link's </title>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <!--Font-Awesome - icons personalizados-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/font-awesome.min.css">
        <!--Select2 - select personalizados;-->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/select2.min.css">
        <!-- SGL -->
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/estilo.css">
    </head>

    <body onload="mostrarConteudo()">
        <div id="tela_load">
           
        </div>
        <div id="tela_sistema">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="menu_sistema">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo BASE_URL ?>/"><img src="<?php echo BASE_URL ?>/assets/imagens/logo_menu.png" alt=""></a>
                </div>
                <!-- Top Menu Items -->

                <ul class="nav navbar-right top-nav">
                    <li>
                        <form action="<?php echo BASE_URL ?>/relatorio/buscarapida/1" class="navbar-form" method="POST" autocomplete="off" name="nSearchSGL">
                            <div class="form-group">
                                <label ><input type="radio" name="nSearchFinalidade" value="Unidade" checked> Unidade</label>
                                <label ><input type="radio" name="nSearchFinalidade" value="Orgão"> Orgão</label>
                            </div>
                            <div class="input-group">
                                <input type="text" name="nSerachCampo" class="form-control">
                                <span class="input-group-addon" onclick="submit_form_navbar()"><span class="fa fa-search"></span></span>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Joab <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo BASE_URL ?>/editar/usuario/1"><i class="fa fa-user"></i> Editar Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out"></i> Sair</a>
                            </li>

                        </ul>
                    </li>
                </ul>

                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <nav class="side-nav">
                        <figure>
                            <img src="<?php echo BASE_URL ?>/assets/imagens/user_masculino.png" class="img-center img-responsive img-circle">
                            <figcaption>
                                <p class="text-center text-uppercase">Joab Torres Alencar</p>
                                <p class="text-center">Estagiário</p>
                            </figcaption>
                        </figure>

                        <ul class="nav navbar-nav">

                            <li >
                                <a href="<?php echo BASE_URL ?>"><i class="fa fa-tachometer"></i> Inicial</a>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#menu_cadastro"><i class="glyphicon glyphicon-plus-sign"></i> Cadastrar <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                                <ul id="menu_cadastro" class="collapse">
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/cidade"><i class="fa fa-plus-square"></i> Cidade</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/ap"><i class="fa fa-plus-square"></i> AP</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/redemetro"><i class="fa fa-plus-square"></i> Rede Metro</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/orgao"><i class="fa fa-plus-square"></i> Orgão</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/unidade"><i class="fa fa-plus-square"></i> Unidade</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#menu_relatorio"><i class="fa fa-share"></i> Relatórios <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                                <ul id="menu_relatorio" class="collapse">
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/cidades"><i class="fa fa-th-list"></i> Cidades</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/orgaos"><i class="fa fa-th-list"></i> Orgãos</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/aps"><i class="fa fa-th-list"></i> AP's</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/redemetro"><i class="fa fa-th-list"></i> Rede Metro</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/unidades"><i class="fa fa-th-list"></i> Unidades</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/relatorio/filtro"><i class="fa fa-th-list"></i> Detalhado</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:;" data-toggle="collapse" data-target="#menu_usuario"><i class="fa fa-users"></i> Usuários <i class="fa fa-fw fa-caret-down pull-right"></i></a>
                                <ul id="menu_usuario" class="collapse">
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/cadastrar/usuario"><i class="fa fa-user-plus"></i> Novo Usuário</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/editar/usuario"><i class="fa fa-user"></i> Editar Perfil</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo BASE_URL ?>/usuario/index"><i class="fa fa-users"></i> Lista Usuários</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo BASE_URL ?>/usuario/sair"><i class="fa fa-sign-out"></i> Sair</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- FIM SIDE-NAV-->
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <?php $this->loadViewInTemplate($viewName, $viewData) ?>

        </div>
        <!-- /#tela_sistema -->

        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>;-->
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="<?php echo BASE_URL ?>/assets/js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo BASE_URL ?>/assets/js/bootstrap.min.js"></script>
        <!--Js do Select2-->
        <script src="<?php echo BASE_URL ?>/assets/js/select2.min"></script>
        <!--Maskedinput-->
        <script src="<?php echo BASE_URL ?>/assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo BASE_URL ?>/assets/js/sgl.js"></script>

        <!--MODAL - ESTRUTURA BÁSICA-->
        <section class="modal fade" id="modal_recupera" tabindex="-1" role="dialog">
            <article class="modal-dialog modal-md" role="document">
                <section class="modal-content">
                    <header class="modal-header bg-primary">
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p class="panel-title">Mensagem</p>
                    </header>
                    <article class="modal-body">
                        <p class="text-justify">Lorem Ipsum Dolor!</p>
                    </article>
                    <footer class="modal-footer">
                        <button class="btn btn-default" type="button" data-dismiss="modal">Fechar</button>
                    </footer>
                </section>
            </article>
        </section>
        <!--MODAL - ESTRUTURA BÁSICA-->
    </body>

</html>