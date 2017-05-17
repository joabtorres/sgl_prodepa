<?php

/**
 * A classe 'editarController' é responsável para fazer o gerenciamento na edicção de cidades, orgãos, ap's e unidades
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe editarController
 */
class editarController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel  para chama a função cidade($cod_cidade);
     * @param int $cod - código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod) {
        $this->cidade($cod);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma cidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_cidade - código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidade($cod_cidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            //dados da view
            $dados = array();
            //view a ser carregada
            $viewName = 'cidade_editar';
            //model cidade
            $cidadeModel = new cidade();
            $dados['nucleos'] = $cidadeModel->read('SELECT * FROM sgl_cidade_nucleo', array());
            $resultado_cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod ;', array('cod' => addslashes($cod_cidade)));
            if ($resultado_cidade) {
                $dados['cidade'] = $resultado_cidade[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                //este array vai armazena os valores do formulário;
                $cidade = array();
                if (isset($_POST['neditCidade']) && !empty($_POST['neditCidade'])) {
                    $cidade['cod'] = addslashes($_POST['neditCod']);
                    //CAMPO cidade
                    $cidade['cidade'] = addslashes($_POST['neditCidade']);
                    //campo codigo do  nucleo
                    $cidade['nucleo'] = addslashes($_POST['neditNucleo']);
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        //update
                        $resultado = $cidadeModel->update('UPDATE sgl_cidade_area_atuacao SET cidade_area_atuacao=:cidade, cod_nucleo=:nucleo WHERE cod_area_atuacao=:cod ', $cidade);
                        if ($resultado) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Edição realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $resultado_cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod ;', array('cod' => addslashes($cod_cidade)));
                            if ($resultado_cidade) {
                                $dados['cidade'] = $resultado_cidade[0];
                            }
                            $_POST = array();
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Informe o nome da cidade!';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($viewName, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um orgão e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_orgao - código do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_orgao) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "orgao_editar";
            $orgaoModel = new orgao();

            $result = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod', array('cod' => addslashes(trim($cod_orgao))));
            if ($result) {
                $dados['orgao'] = $result[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (isset($_POST['neditOrgao']) && !empty($_POST['neditOrgao'])) {
                    //array com os dados do formulário
                    $orgaoModel = new orgao();
                    $data = array("nome" => addslashes($_POST['neditOrgao']), "categoria" => addslashes($_POST['neditCategoria']), 'cod' => addslashes(trim($_POST['neditCod'])));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $result = $orgaoModel->update("UPDATE sgl_orgao SET nome_orgao=:nome, categoria_orgao=:categoria WHERE cod_orgao=:cod", $data);
                        if ($result) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                            $result = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod', array('cod' => addslashes(trim($cod_orgao))));
                            if ($result) {
                                $dados['orgao'] = $result[0];
                            }
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Informe o nome do orgão!';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um ap e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_ap - código da ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_ap) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "ap_editar";
            $apModel = new ap();
            $resultado = $apModel->read("SELECT ap.*, c.cidade_area_atuacao FROM  sgl_ap AS ap INNER JOIN sgl_cidade_area_atuacao AS c ON ap.cod_area_atuacao=c.cod_area_atuacao WHERE ap.cod_ap = :cod", array('cod' => addslashes(trim($cod_ap))));
            if ($resultado) {
                $dados['ap'] = $resultado[0];
            }

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['neditNome']) || !empty($_POST['neditBanda']) || !empty($_POST['neditCCode']) || !empty($_POST['neditIP'])) {
                    //array que armazena os dados do formulário
                    $data = array("nome" => addslashes(strtoupper($_POST['neditNome'])), "banda" => addslashes($_POST['neditBanda']), "color_code" => addslashes($_POST['neditCCode']), "ip" => addslashes($_POST['neditIP']), 'cod' => addslashes($_POST['neditCod']));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $resultado = $apModel->update('UPDATE sgl_ap SET nome_ap=:nome, banda_ap=:banda, color_code_ap=:color_code, ip_ap=:ip WHERE cod_ap=:cod', $data);
                        if ($resultado) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $resultado = $apModel->read("SELECT ap.*, c.cidade_area_atuacao FROM  sgl_ap AS ap INNER JOIN sgl_cidade_area_atuacao AS c ON ap.cod_area_atuacao=c.cod_area_atuacao WHERE ap.cod_ap = :cod", array('cod' => addslashes(trim($cod_ap))));
                            if ($resultado) {
                                $dados['ap'] = $resultado[0];
                            }
                            $_POST = array();
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos.';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações em editar os campos de  uma rede metro e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_redemetro - código do registro no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($cod_redemetro) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "redemetro_editar";
            $redeModel = new redemetro();

            $result = $redeModel->read("SELECT r.*, c.cidade_area_atuacao FROM sgl_redemetro AS r INNER JOIN sgl_cidade_area_atuacao AS c ON r.cod_area_atuacao=c.cod_area_atuacao WHERE r.cod_redemetro=:cod", array('cod' => addslashes(trim($cod_redemetro))));
            if ($result) {
                $dados['redemetro'] = $result[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['neditNome']) || !empty($_POST['neditEstensao'])) {
                    //array que armazena os dados do formulário
                    $data = array("nome" => addslashes(strtoupper($_POST['neditNome'])), "estensao" => addslashes($_POST['neditEstensao']), 'cod' => addslashes($_POST['neditCod']));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $result = $redeModel->update('UPDATE sgl_redemetro SET nome_redemetro=:nome, estensao_redemetro=:estensao WHERE cod_redemetro=:cod', $data);
                        if ($result) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                            $result = $redeModel->read("SELECT r.*, c.cidade_area_atuacao FROM sgl_redemetro AS r INNER JOIN sgl_cidade_area_atuacao AS c ON r.cod_area_atuacao=c.cod_area_atuacao WHERE r.cod_redemetro=:cod", array('cod' => addslashes(trim($cod_redemetro))));
                            if ($result) {
                                $dados['redemetro'] = $result[0];
                            }
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos.';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod_unidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "unidade_editar";

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um usuario e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_usuario - Código do usuario
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod_usuario = array()) {
        $view = "usuario_editar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de historico da unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_historico - código do historico registrado no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function historico($cod_historico) {
        
    }

}
