<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Inicial</h2>
                <ol class="breadcrumb">
                    <li class="active"><i class="fa fa-tachometer"></i> Inicial</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Olá <strong><?php echo trim($_SESSION['user_sgl']['nome']); ?></strong>, bem-vindo ao Sistema de Gerenciamento de Link’s.
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="http://prodepa.pa.gov.br/" target="_blank">
                                <div class="col-xs-12">
                                    <img src="<?php echo BASE_URL ?>/assets/imagens/panel_icon.png" class="pull-left" alt="PRODEPA - LOGOTIPO"/>
                                    <div class="text-uppercase font-bold">PRODEPA</div>
                                    <div>Website Institucional</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="http://mail.prodepa.pa.gov.br/" target="_blank">
                                <div class="col-xs-12">
                                    <i class="fa fa-envelope-o fa-3x pull-left"></i>
                                    <div class="text-uppercase font-bold">ZIMBRA</div>
                                    <div>E-mail Corporativo</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="http://tdesk.prodepa.pa.gov.br" target="_blank">
                                <div class="col-xs-12">
                                    <i class="fa fa-file-text-o fa-3x pull-left"></i>                               
                                    <div class="text-uppercase font-bold">TDESK</div>
                                    <div>Monitor de Suporte</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="http://zabbix.prodepa.pa.gov.br" target="_blank">
                                <div class="col-xs-12">
                                    <i class="fa fa-area-chart fa-3x pull-left" ></i>
                                    <div class="text-uppercase font-bold">ZABBIX</div>
                                    <div>Monitoramento</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--FIM .ROW-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->