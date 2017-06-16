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
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <img src="<?php echo BASE_URL ?>/assets/imagens/404-error-page.png" class="img-center img-responsive">
                        <p class="text-center"><a href="<?php echo BASE_URL ?>/home" class="btn btn-primary">Página Inicial</a></p>
                    </div> 
                </div>
            </div>
        </div>

        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/js/sgl.js"></script>
    </body>

</html>
