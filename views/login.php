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
        <link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- SGL -->        
        <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/estilo.css">
    </head>

    <body onload="mostrarConteudo()"> 
        <div id="tela_load">

        </div>
        <div id="interface_login">
            <div class="container-fluid">
                <div class="row">
                    <!-- TELA LOGIN -->
                    <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" id="tela_login">
                        <h4 class="text-center text-login text-uppercase">SGL - Sistema de Gerenciamento de Link's</h4>
                        <div class="row">
                            <div class="col-md-6"><img src="<?php echo BASE_URL; ?>/assets/imagens/logo_login.png" alt="Logotipo da PRODEPA" class="img-center img-responsive"></div>
                            <div class="col-md-6">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="iSerachUsuario">Usuário:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                            <input type="text" id="iSerachUsuario" name="nSerachUsuario" class="form-control" autofocus placeholder="E-mail / Usuário">
                                        </div>                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="iSearchSenha">Senha:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                            <input type="password" id="iSearchSenha" name="nSearchSenha" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        if (isset($erro)) {
                                            echo '<p class="bg-danger">' . $erro["msg"] . '</p>';
                                        }
                                        ?>
                                        <button type="submit" name="nEntrar" class="btn btn-primary" value="Entrar"><i class="fa fa-sign-in" aria-hidden="true"></i> Fazer Login</button>
                                        <a data-toggle="modal" data-target=".modal-search-email"><span class="glyphicon glyphicon-lock"></span> Esqueceu a senha?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- FIM TELA LOGIN -->
                </div>
            </div>
            <!--  MODEL -->
            <div class="modal fade modal-search-email" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <section class="modal-dialog modal-lg" role="document">
                    <article class="modal-content">
                        <header class="modal-header bg-primary">
                            <h3><b>Esqueceu a senha?</b></h3>
                        </header>
                        <section class="modal-body">

                            <div class="row">
                                <div class="col-md-5">
                                    <p class="text-justify">Forneça o endereço de email usado em sua conta do SGL.</p>
                                    <p class="text-justify">Será enviado um e-mail que redefine a sua senha.</p>
                                </div>
                                <div class="col-md-7">
                                    <div id="tela_recupera_senha">
                                        <form method="POST" >
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-envelope-o fa-fw"></i></span>
                                                    <input type="email" name="nEmail" class="form-control" id="searchEmail" placeholder="Endereço de email">
                                                </div>
                                            </div>
                                            <div class="form-group"><button type="submit" value="Enviar" name="nEnviar" class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Enviar email de verificação</button</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <footer class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
                        </footer>
                    </article>
                </section>
            </div>
        </div>
        <!-- FIM MODEL -->
        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/js/sgl.js"></script>
    </body>

</html>
