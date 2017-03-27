<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/gif" href="imagens/icon-prodepa.gif" sizes="32x32" />
        <meta property="ogg:title" content="PRODEPA - SGL -Sistema de Gerênciamento de Link's ">
        <meta property="ogg:description" content="Sistema de Gerenciamento de Link's - PRODEPA !">
        <title> PRODEPA - SGL -Sistema de Gerenciamento de Link's </title>
        <!-- Bootstrap -->
        <link href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- SGL -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/estilo.css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- TELA LOGIN -->
                <div class="col-sm-offset-1 col-sm-10 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8" id="tela_login">
                    <h3 class="text-center text-login text-uppercase">SGL - Sistema de Gerenciamento de Link's</h3>
                    <div class="row">
                        <div class="col-md-6"><img src="<?php echo BASE_URL; ?>/assets/imagens/logo_login.png" alt="Logotipo da PRODEPA" class="img-center img-responsive"></div>
                        <div class="col-md-6">
                            <form method="POST">
                                <div class="form-group">
                                    <label for="iSerachEmail">E-mail:</label>
                                    <input type="email" id="iSerachEmail" name="nSerachEmail" class="form-control" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="iSearchSenha">Senha:</label>
                                    <input type="password" id="iSearchSenha" name="nSearchSenha" class="form-control">
                                </div>
                                <div class="form-group">
                                    <p class="bg-danger">O Campo E-mail ou Senha está incorreto !</p>
                                    <input type="submit" value="Entrar" name="nEntrar" class="btn btn-info">
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
                    <header class="modal-header">
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
                                    <form method="POST">
                                        <div class="form-group"><label for="searchEmail">Endereço de email</label><input type="email" class="form-control" id="searchEmail"></div>
                                        <div class="form-group"><input type="submit" class="btn btn-success" value="Enviar email de verificação" name="nVerificar"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </footer>
                </article>
            </section>
        </div>
        <!-- FIM MODEL -->
        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/js/sgl.js"></script>
    </body>

</html>