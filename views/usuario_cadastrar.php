<div id="conteudo_sistema">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
                <h2>Novo Usuário</h2>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="glyphicon glyphicon-dashboard"></i> Inicial</a></li>
                    <li class="active"><i class="glyphicon glyphicon-plus-sign"></i> Novo Usuário</li>
                </ol>
            </div>
        </div>
        <!--FIM pagina-header-->
        <article class="clear" id="container-usuario-form">
            <form method="POST" enctype="multipart/form-data" autocomplete="off">
                <section class="panel panel-primary">
                    <header class="panel-heading"><p class="panel-title">Usuário</p></header>
                    <article class="panel-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cNome">Nome Completo:</label>
                                <input type="text" name="nNome" id="cNome" class="form-control" placeholder="Exemplo: Joab Torres Alencar"/>
                            </div>
                            <div class="form-group">
                                <label for="cEmail">E-mail:</label>
                                <input type="email" name="nEmail" id="cEmail" class="form-control" placeholder="Exemplo: joab-alencar@prodepa.pa.gov.br"/>
                            </div>
                            <div class="form-group">
                                <label for="cSenha">Senha:</label>
                                <input type="password" name="nSenha" id="cSenha" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="cRepetirSenha">Repetir Senha:</label>
                                <input type="password" name="nRepetirSenha" id="cRepetirSenha" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="iNucleo">Núcleo: </label>
                                <select name="nNucleo" id="iNucleo" class="form-control"> 
                                    <option value="ALTAMIRA" >NÚCLEO ALTAMIRA</option>
                                    <option value="ITAITUBA" >NÚCLEO ITAITUBA</option>
                                    <option value="SANTARÉM" >NÚCLEO SANTARÉM</option>
                                    <option value="MARABÁ" >NÚCLEO MARABÁ</option>
                                    <option value="PARAGOMINAS" >NÚCLEO PARAGOMINAS</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="iCargo">Cargo:</label>
                                <input type="password" name="nCargo" id="iCargo" class="form-control"  placeholder="Exemplo: Estagiário"/>
                            </div>
                            <div class="form-group">
                                <strong class="font-bold">Sexo:</strong><br/>
                                <label><input type="radio" name="nSexo" value="Masculino" checked/> Masculino</label>
                                <label><input type="radio" name="nSexo" value="Feminino"/> Feminino</label>
                            </div>
                            <div class="form-group">
                                <strong class="font-bold">Nível de Acesso:</strong><br/>
                                <label><input type="radio" name="tNivelDeAcesso" value="0" checked/> Usuário Padrão</label>
                                <label><input type="radio" name="tNivelDeAcesso" value="1"/> Administrador</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="qtd_fotos" value="1">
                            <p class="text-center" style="margin-top: 10%;" id="fotos">
                                <img src="<?php echo BASE_URL?>/assets/imagens/user_masculino.png" class="img-center" alt="Usuario" id="viewImagem-1"/>
                                <label class="btn btn-primary" onclick="readDefaultURL()">Padrão</label>
                                <label class="btn btn-danger" for="cFileImagem">Escolher Imagem</label>
                                <input type="file" name="tImagem-1" id="cFileImagem" onchange="readURL(this)"/>
                            </p>

                        </div>
                    </article>
                </section>
                <div  class="form-group">
                    <button type="button" class="btn btn-success">Salvar</button>
                    <a href="index.html" class="btn btn-danger">Cancelar</a>
                </div>
            </form>
        </article><!--FIM CONTAINER-USUARIO-->
        <!--FIM .ROW-->

        <div id="rodape">
            <p class="text-right text-uppercase">&copy; Copyright 2017 - Joab Torres Alencar | DRI - GNU - DNR - NÚCLEO ITAITUBA.</p>
        </div>
        <!--FIM #rodape-->
    </div>
</div>
<!-- /#conteudo_sistema -->