<?php

/**
 * A classe 'relatorioController' é responsável para fazer o carregamento das views relacionado a relatorios e validações de exibição de campos
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe relatorioController
 */
class relatorioController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela chama a  função cidade();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
        $this->cidades(1);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável para mostra todas as cidades  em atuação que o núcleo é responsável, lógico isso é definido pelo cod_nucleo do usuario, chamando link para os orgãos, ap's e clientes registrado da quela cidade.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidades($page = 1, $cod_cidade = 0) {
        if ($this->checkUserPattern()) {
            $view = "cidade_relatorio";
            $dados = array();
            $cidadeModel = new cidade();
            $data = array("cod" => $_SESSION['user_sgl']['nucleo']);
            $limite = 6;
            $indice = 0;
            $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
            $indice = ($pagina_atual - 1) * $limite;
            if (empty($cod_cidade)) {
                $dados['cidades'] = $cidadeModel->read("SELECT sgl_cidade_area_atuacao.* FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . "," . $limite, $data);
            } else {
                $data['cod_cidade'] = addslashes($cod_cidade);
                $resultado = $cidadeModel->read("SELECT sgl_cidade_area_atuacao.* FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod  AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . "," . $limite, $data);

                if ($resultado) {
                    $dados['cidades'] = $resultado;
                    $dados['cidade'] = array("nome" => $dados['cidades'][0]['cidade_area_atuacao'], "cod" => $dados['cidades'][0]['cod_area_atuacao']);
                }
            }
            $total_registro = $cidadeModel->getNumRows();
            $dados['paginas'] = $total_registro / $limite;
            $dados['pagina_atual'] = $pagina_atual;
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os orgãos registrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo da cidade area de atuação
     * @param int $cod_orgao - codigo do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgaos($page = 1, $cod_cidade = 0, $cod_orgao = 0) {
        if ($this->checkUserPattern()) {

            $view = "orgao_relatorio";
            $dados = array();
            //models
            $orgaoModel = new orgao();
            $unidadeModel = new unidade();
            $cidadeModel = new cidade();

            //array que vai ser utilizado na consulta com banco de dados
            $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']);

            //paginação
            $limite = 1;
            $indice = 0;
            $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
            $indice = ($pagina_atual - 1) * $limite;

            //se não for setado a cidade
            if (empty($cod_cidade)) {
                //lista todos os orgãos que tem unidade cadastrada de todas as cidades
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);
                $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC,  sgl_unidade.nome_unidade;", $data);

                //total de cidades
                $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC;", $data);
                $total_registro = $cidadeModel->getNumRows();
            } else {

                $data['cod_cidade'] = addslashes($cod_cidade);
                //lista todos os orgãos que tem unidade cadastrada de cidade específica
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
                if ($resultado_cidade) {
                    $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
                }
                //se não for setado o orgão
                if (empty($cod_orgao)) {
                    $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC;", $data);
                    $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC,  sgl_unidade.nome_unidade ASC;", $data);
                    $total_registro = 1;
                } else {
                    //lista todos os orgãos que tem unidade cadastrada de cidade específica e orgão específico
                    $data['cod_orgao'] = addslashes($cod_orgao);

                    $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_orgao.cod_orgao=:cod_orgao ORDER BY sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC;", $data);
                    $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_orgao.cod_orgao=:cod_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC,  sgl_unidade.nome_unidade;", $data);

                    if ($resultado_orgao) {
                        $dados['orgao'] = array('nome' => $resultado_orgao[0]['nome_orgao'], 'cod' => $resultado_orgao[0]['cod_orgao'], 'categoria' => $resultado_orgao[0]['categoria_orgao']);
                    }
                    $total_registro = 1;
                }
            }
            //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
            if ($resultado_cidade && $resultado_orgao && $resultado_unidade) {
                $resultado = array();
                $qtdCidade = 0;
                foreach ($resultado_cidade as $cidade) {
                    $qtdOrgao = 0;
                    $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'orgaos' => array());
                    foreach ($resultado_orgao as $orgao) {
                        $qtdUnidade = 0;
                        $resultado[$qtdCidade]['orgaos'][$qtdOrgao] = array('nome_orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'categoria_orgao' => $orgao['categoria_orgao'], 'unidades' => array());
                        foreach ($resultado_unidade as $unidade) {
                            if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao'] && $orgao['nome_orgao'] == $unidade['nome_orgao']) {
                                $resultado[$qtdCidade]['orgaos'][$qtdOrgao]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                            }
                            $qtdUnidade = $qtdUnidade + 1;
                        }
                        $qtdOrgao = $qtdOrgao + 1;
                    }
                    $qtdCidade = $qtdCidade + 1;
                }
                //resultado da consulta
                $dados['resultadoView'] = $resultado;
            }
            //PAGINAÇÃO
            $dados['paginas'] = $total_registro / $limite;
            $dados['pagina_atual'] = $pagina_atual;
            $dados['action'] = 'orgaos';
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os ap's registrados nas cidades e seus respectivos links cadastrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @param $cod_ap  - código do ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function aps($page = 1, $cod_cidade = 0, $cod_ap = 0) {
        if ($this->checkUserPattern()) {
            $view = "ap_relatorio";
            $dados = array();
            //models
            $apModel = new ap();
            $unidadeModel = new unidade();
            $cidadeModel = new cidade();

            //array que vai ser utilizado na consulta com banco de dados
            $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']);

            //paginação
            $limite = 1;
            $indice = 0;
            $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
            $indice = ($pagina_atual - 1) * $limite;

            //se não for setado a cidade
            if (empty($cod_cidade)) {
                //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);
                $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_ap.banda_ap, sgl_ap.ip_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_ap.banda_ap,sgl_ap.ip_ap, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade ASC;", $data);

                //total de cidades
                $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC", $data);
                $total_registro = $cidadeModel->getNumRows();
            } else {

                $data['cod_cidade'] = addslashes($cod_cidade);
                //lista todos os orgãos que tem unidade cadastrada de cidade específica
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC;", $data);
                if ($resultado_cidade) {
                    $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
                }
                //se não for setado o orgão
                if (empty($cod_ap)) {
                    $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_ap.banda_ap, sgl_ap.ip_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
                    $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_ap.banda_ap,sgl_ap.ip_ap, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade ASC;", $data);

                    $total_registro = 1;
                } else {
                    //lista todos os orgãos que tem unidade cadastrada de cidade específica e orgão específico
                    $data['cod_ap'] = addslashes($cod_ap);

                    $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_ap.banda_ap, sgl_ap.ip_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_ap.cod_ap=:cod_ap ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
                    $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_ap.banda_ap,sgl_ap.ip_ap, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_ap.cod_ap=:cod_ap ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade ASC;", $data);

                    if ($resultado_ap) {
                        $dados['ap'] = array('nome' => $resultado_ap[0]['nome_ap'], 'cod' => $resultado_ap[0]['cod_ap']);
                    }
                    $total_registro = 1;
                }
            }
            //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
            if ($resultado_cidade && $resultado_ap && $resultado_unidade) {
                $resultado = array();
                $qtdCidade = 0;
                foreach ($resultado_cidade as $cidade) {
                    $qtdAps = 0;
                    $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'aps' => array());
                    foreach ($resultado_ap as $ap) {
                        $qtdUnidade = 0;
                        $resultado[$qtdCidade]['aps'][$qtdAps] = array('nome_ap' => $ap['nome_ap'], 'cod_ap' => $ap['cod_ap'], 'banda_ap' => $ap['banda_ap'], 'ip_ap' => $ap['ip_ap'], 'unidades' => array());
                        foreach ($resultado_unidade as $unidade) {
                            if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao'] && $ap['nome_ap'] == $unidade['nome_ap'] && $cidade['cidade_area_atuacao'] == $ap['cidade_area_atuacao']) {
                                $resultado[$qtdCidade]['aps'][$qtdAps]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                            }
                            $qtdUnidade = $qtdUnidade + 1;
                        }
                        $qtdAps = $qtdAps + 1;
                    }
                    $qtdCidade = $qtdCidade + 1;
                }
                //resultado da consulta
                $dados['resultadoView'] = $resultado;
            }

            //PAGINAÇÃO
            $dados['paginas'] = $total_registro / $limite;
            $dados['pagina_atual'] = $pagina_atual;

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra as redemetro registradas nas cidades e seus respectivos links cadastrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @param int $cod_redemetro - código da redemetro
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($page = 1, $cod_cidade = 0, $cod_redemetro = 0) {
        if ($this->checkUserPattern()) {
            $view = "redemetro_relatorio";
            $dados = array();
            //models
            $redeModel = new redemetro();
            $unidadeModel = new unidade();
            $cidadeModel = new cidade();

            //array que vai ser utilizado na consulta com banco de dados
            $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']);

            //paginação
            $limite = 1;
            $indice = 0;
            $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
            $indice = ($pagina_atual - 1) * $limite;

            //se não for setado a cidade
            if (empty($cod_cidade)) {
                //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);
                //-- COMANDO PARA LISTA AS REDESMETROS EM DESTAQUE QUE CONTEM UNIDADES CADASTRADAS
                $resultado_redemetro = $redeModel->read("SELECT DISTINCT(sgl_redemetro.nome_redemetro), sgl_redemetro.cod_redemetro, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC;", $data);
                //-- COMANDO PARA LISTA sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade, cujo em ordem alfabetica sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC;
                $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC;", $data);

                //total de cidades
                $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC;", $data);
                $total_registro = $cidadeModel->getNumRows();
            } else {

                $data['cod_cidade'] = addslashes($cod_cidade);
                //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA -- cidade especifíca
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC;", $data);
                if ($resultado_cidade) {
                    $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
                }
                //se não for setado a redemetro
                if (empty($cod_redemetro)) {
                    //-- COMANDO PARA LISTA AS REDESMETROS EM DESTAQUE QUE CONTEM UNIDADES CADASTRADAS -- cidade especifíca 
                    $resultado_redemetro = $redeModel->read("SELECT DISTINCT(sgl_redemetro.nome_redemetro), sgl_redemetro.cod_redemetro, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC;", $data);
                    //-- COMANDO PARA LISTA sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade, cujo em ordem alfabetica sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC; -- cidade especifíca
                    $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC;", $data);

                    $total_registro = 1;
                } else {
                    //REDE METRO
                    $data['cod_redemetro'] = addslashes($cod_redemetro);
                    //-- COMANDO PARA LISTA AS REDESMETROS EM DESTAQUE QUE CONTEM UNIDADES CADASTRADAS -- cidade especifíca é REDE METRO ESPECÍFICO
                    $resultado_redemetro = $redeModel->read("SELECT DISTINCT(sgl_redemetro.nome_redemetro), sgl_redemetro.cod_redemetro, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_redemetro.cod_redemetro=:cod_redemetro ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC;", $data);
                    //-- COMANDO PARA LISTA sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade, cujo em ordem alfabetica sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC; -- cidade especifíca é REDE METRO ESPECÍFICO
                    $resultado_unidade = $unidadeModel->read("SELECT  sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_redemetro.nome_redemetro, sgl_redemetro.cod_redemetro, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_redemetro, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_redemetro.cod_redemetro=sgl_unidade.cod_redemetro AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_redemetro.cod_redemetro=:cod_redemetro ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_redemetro.nome_redemetro ASC, sgl_unidade.nome_unidade ASC;", $data);

                    if ($resultado_redemetro) {
                        $dados['redemetro'] = array('nome' => $resultado_redemetro[0]['nome_redemetro'], 'cod' => $resultado_redemetro[0]['cod_redemetro']);
                    }
                    $total_registro = 1;
                }
            }
            //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
            if ($resultado_cidade && $resultado_redemetro && $resultado_unidade) {
                $resultado = array();
                $qtdCidade = 0;
                foreach ($resultado_cidade as $cidade) {
                    $qtdRedeMetro = 0;
                    $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'redemetro' => array());
                    foreach ($resultado_redemetro as $redemetro) {
                        $qtdUnidade = 0;
                        $resultado[$qtdCidade]['redemetro'][$qtdRedeMetro] = array('nome_redemetro' => $redemetro['nome_redemetro'], 'cod_redemetro' => $redemetro['cod_redemetro'], 'unidades' => array());
                        foreach ($resultado_unidade as $unidade) {
                            if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao'] && $redemetro['nome_redemetro'] == $unidade['nome_redemetro'] && $cidade['cidade_area_atuacao'] == $redemetro['cidade_area_atuacao']) {
                                $resultado[$qtdCidade]['redemetro'][$qtdRedeMetro]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                            }
                            $qtdUnidade = $qtdUnidade + 1;
                        }
                        $qtdRedeMetro = $qtdRedeMetro + 1;
                    }
                    $qtdCidade = $qtdCidade + 1;
                }
                //resultado da consulta
                $dados['resultadoView'] = $resultado;
            }

            //PAGINAÇÃO
            $dados['paginas'] = $total_registro / $limite;
            $dados['pagina_atual'] = $pagina_atual;

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os clientes registrados nas cidades e seus respectivos links para mais detalhes.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidades($page = 1, $cod_cidade = 0) {
        if ($this->checkUserPattern()) {
            $view = "unidade_relatorio";
            $dados = array();
            //models
            $unidadeModel = new unidade();
            $cidadeModel = new cidade();

            //array que vai ser utilizado na consulta com banco de dados
            $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']);

            //paginação
            $limite = 1;
            $indice = 0;
            $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
            $indice = ($pagina_atual - 1) * $limite;

            if (empty($cod_cidade)) {
                //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);

                //-- COMANDO PARA LISTA AS UNIDADES REGISTRADAS POR NÚCLEO E ORDEM ALFABETICA DAS CIDADE
                $resultado_unidade = $unidadeModel->read('SELECT sgl_unidade.nome_unidade, sgl_unidade.cod_unidade, sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_unidade.nome_unidade ASC;', $data);

                //para paginação total de registro
                $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
                $total_registro = $cidadeModel->getNumRows();
            } else {
                $data['cod_cidade'] = addslashes($cod_cidade);
                //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ;", $data);
                if ($resultado_cidade) {
                    $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
                }
                //-- COMANDO PARA LISTA AS UNIDADES REGISTRADAS POR NÚCLEO E ORDEM ALFABETICA DAS CIDADE
                $resultado_unidade = $unidadeModel->read('SELECT sgl_unidade.nome_unidade, sgl_unidade.cod_unidade, sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_unidade.nome_unidade ASC;', $data);

                $total_registro = 1;
            }
            //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
            if ($resultado_cidade && $resultado_unidade) {
                $resultado = array();
                $qtdCidade = 0;
                foreach ($resultado_cidade as $cidade) {
                    $qtdUnidade = 0;
                    $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'unidades' => array());
                    foreach ($resultado_unidade as $unidade) {
                        if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao']) {
                            $resultado[$qtdCidade]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                        }
                        $qtdUnidade = $qtdUnidade + 1;
                    }
                    $qtdCidade = $qtdCidade + 1;
                }
                //resultado da consulta
                $dados['resultadoView'] = $resultado;
            }


            //PAGINAÇÃO
            $dados['paginas'] = $total_registro / $limite;
            $dados['pagina_atual'] = $pagina_atual;
            $dados['action'] = 'unidades';
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, responsável por fazer uma pesquisa avançada, opção de modo de exibição e gera pdf
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function filtro($page = array()) {
        if ($this->checkUserPattern()) {
            $view = "buscar_avancada_relatorio";
            $dados = array();
            $cidadeModel = new cidade();
            $orgaoModel = new orgao();
            $unidadeModel = new unidade();
            //seleciona cidade
            $cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao ORDER BY cidade_area_atuacao ASC', array());
            if ($cidade) {
                $dados['cidades'] = $cidade;
            }
            //seleciona orgao
            $orgao = $orgaoModel->read('SELECT * FROM sgl_orgao ORDER BY nome_orgao ASC', array());
            if ($orgao) {
                $dados['orgaos'] = $orgao;
            }
            //seleciona esferas
            $result_esfera = $orgaoModel->read('SELECT DISTINCT(categoria_orgao) FROM sgl_orgao ORDER BY categoria_orgao ASC', array());
            if ($result_esfera) {
                $dados['esferas'] = $result_esfera;
            }


            //ação de consulta
            if (isset($_POST['nBuscar']) && !empty($_POST['nBuscar'])) {
                //seleciona cidade
                if (isset($_POST['nCidade']) && !empty($_POST['nCidade']) && $_POST['nCidade'] != "Todas") {
                    $result_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod_cidade ORDER BY cidade_area_atuacao ASC", array('cod_cidade' => addslashes(trim($_POST['nCidade']))));
                } else {
                    $result_cidade = $cidadeModel->read("SELECT DISTINCT(cidade.cidade_area_atuacao), cidade.cod_area_atuacao FROM sgl_cidade_area_atuacao AS cidade INNER JOIN sgl_unidade AS unidade ON cidade.cod_area_atuacao=unidade.cod_cidade ORDER BY cidade_area_atuacao ASC", array());
                }
                //seleciona por codigo do orgao
                if (isset($_POST['nOrgao']) && !empty($_POST['nOrgao'])) {
                    if ($_POST['nOrgao'] == "Todos") {
                        $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array());
                    } else {
                        $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array('cod_orgao' => addslashes(trim($_POST['nOrgao']))));
                    }
                    //seleciona por esfera do orgao
                } else {
                    if ($_POST['nCategoria'] == "Todas") {
                        $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array());
                    } else {
                        $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE categoria_orgao=:categoria ORDER BY categoria_orgao ASC, nome_orgao ASC;', array('categoria' => addslashes($_POST['nCategoria'])));
                    }
                }

                //array que vai armazena o resultado_final
                $resultado_final = array();
                //cidade
                $qtd_cidade = 0;
                if (is_array($result_cidade) && is_array($result_orgao)) {
                    foreach ($result_cidade as $cidade) {
                        $resultado_final[$qtd_cidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'orgaos' => array());
                        //orgao
                        $qtd_orgao = 0;
                        foreach ($result_orgao as $orgao) {
                            //setando os orgãos
                            $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao] = array('orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'categoria' => $orgao['categoria_orgao'], 'unidades' => array());

                            switch ($_POST['nConexao']) {
                                case "Rádio":
                                    if (isset($_POST['nAP']) && !empty($_POST['nAP']) && $_POST['nAP'] != "Todos") {
                                        $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao AND unidade.cod_ap=:cod_ap ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao'], 'cod_ap' => addslashes(trim($_POST['nAP']))));
                                    } else {
                                        $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                    }
                                    if (is_array($result_unidade_ap)) {
                                        $result_unidade = $result_unidade_ap;
                                    }
                                    break;
                                case "Fibra":
                                    if (isset($_POST['nRedeMetro']) && !empty($_POST['nRedeMetro']) && $_POST['nRedeMetro'] != "Todos") {
                                        $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao AND unidade.cod_redemetro=:cod_redemetro ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao'], 'cod_redemetro' => $_POST['nRedeMetro']));
                                    } else {
                                        $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                    }
                                    if (is_array($result_unidade_redemetro)) {
                                        $result_unidade = $result_unidade_redemetro;
                                    }
                                    break;
                                default :
                                    $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                    $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));

                                    if (is_array($result_unidade_ap)) {
                                        $result_unidade = $result_unidade_ap;
                                    }
                                    if (is_array($result_unidade_redemetro)) {
                                        $result_unidade = $result_unidade_redemetro;
                                    }
                                    break;
                            }


                            if (isset($result_unidade) && is_array($result_unidade)) {

                                $qtd_unidade = 0;
                                foreach ($result_unidade as $unidade) {
                                    if ($cidade['cod_area_atuacao'] == $unidade['cod_cidade'] && $orgao['cod_orgao'] == $unidade['cod_orgao']) {
                                        $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade] = array('cod_unidade' => $unidade['cod_unidade'], 'unidade' => $unidade['nome_unidade'], 'ip' => $unidade['ip_unidade'], 'banda' => $unidade['banda_unidade'], 'conexao' => $unidade['conexao_unidade']);

                                        if (!empty($unidade['cod_ap'])) {
                                            $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['cod_ap'] = $unidade['cod_ap'];
                                            $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['nome_ap'] = $unidade['nome_ap'];
                                        } else {
                                            $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['cod_redemetro'] = $unidade['cod_redemetro'];
                                            $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['nome_redemetro'] = $unidade['nome_redemetro'];
                                        }
                                        ++$qtd_unidade;
                                    }
                                }
                                $dados['resultadoView'] = $resultado_final;
                            }
                            ++$qtd_orgao;
                        }
                        ++$qtd_cidade;
                    }
                }
            }

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, responsável para fazer uma buscar rápida, por unidade ou por orgão.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function buscarapida($page) {
        if ($this->checkUserPattern()) {

            if (isset($_POST['nSerachCampo']) && !empty($_POST['nSerachCampo'])) {
                $_SESSION['sgl']['buscarapida'] = array('finalidade' => addslashes($_POST['nSearchFinalidade']), 'campo' => addslashes($_POST['nSerachCampo']));
            }
            if ($_SESSION['sgl']['buscarapida']) {
                if ($_SESSION['sgl']['buscarapida']['finalidade'] == 'Unidade') {
                    $view = "unidade_relatorio";
                    $dados = array();
                    //models
                    $unidadeModel = new unidade();
                    $cidadeModel = new cidade();

                    //array que vai ser utilizado na consulta com banco de dados
                    $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo'], 'nome_unidade' => '%' . $_SESSION['sgl']['buscarapida']['campo'] . '%');

                    //paginação
                    $limite = 1;
                    $indice = 0;
                    $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                    $indice = ($pagina_atual - 1) * $limite;


                    //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
                    $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.nome_unidade LIKE :nome_unidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);

                    //-- COMANDO PARA LISTA AS UNIDADES REGISTRADAS POR NÚCLEO E ORDEM ALFABETICA DAS CIDADE
                    $resultado_unidade = $unidadeModel->read('SELECT sgl_unidade.nome_unidade, sgl_unidade.cod_unidade, sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.nome_unidade LIKE :nome_unidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_unidade.nome_unidade ASC;', $data);

                    //para paginação total de registro
                    $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.nome_unidade LIKE :nome_unidade  ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
                    $total_registro = $cidadeModel->getNumRows();

                    //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
                    if ($resultado_cidade && $resultado_unidade) {
                        $resultado = array();
                        $qtdCidade = 0;
                        foreach ($resultado_cidade as $cidade) {
                            $qtdUnidade = 0;
                            $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'unidades' => array());
                            foreach ($resultado_unidade as $unidade) {
                                if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao']) {
                                    $resultado[$qtdCidade]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                                }
                                $qtdUnidade = $qtdUnidade + 1;
                            }
                            $qtdCidade = $qtdCidade + 1;
                        }
                        //resultado da consulta
                        $dados['resultadoView'] = $resultado;
                    }

                    //PAGINAÇÃO
                    $dados['paginas'] = $total_registro / $limite;
                    $dados['pagina_atual'] = $pagina_atual;
                    $dados['action'] = 'buscarapida';
                    $this->loadTemplate($view, $dados);
                } else {

                    $view = "orgao_relatorio";
                    $dados = array();
                    //models
                    $orgaoModel = new orgao();
                    $unidadeModel = new unidade();
                    $cidadeModel = new cidade();

                    //array que vai ser utilizado na consulta com banco de dados
                    $data = array('cod_nucleo' => $_SESSION['user_sgl']['nucleo'], 'nome_orgao' => '%' . $_SESSION['sgl']['buscarapida']['campo'] . '%');

                    //paginação
                    $limite = 1;
                    $indice = 0;
                    $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                    $indice = ($pagina_atual - 1) * $limite;

                    $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_orgao.nome_orgao  FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);
                    $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC;", $data);
                    $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.categoria_orgao ASC, sgl_orgao.nome_orgao ASC,  sgl_unidade.nome_unidade;", $data);

                    //total de cidades
                    $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_orgao.nome_orgao  FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
                    $total_registro = $cidadeModel->getNumRows();
                    //SE TODOS OS CAMPOS RETORNARAM VERDADEIROS OU SEJA POSSUEM DADOS DA CONSULTA AO BANCO
                    if ($resultado_cidade && $resultado_orgao && $resultado_unidade) {
                        $resultado = array();
                        $qtdCidade = 0;
                        foreach ($resultado_cidade as $cidade) {
                            $qtdOrgao = 0;
                            $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'orgaos' => array());
                            foreach ($resultado_orgao as $orgao) {
                                $qtdUnidade = 0;
                                $resultado[$qtdCidade]['orgaos'][$qtdOrgao] = array('nome_orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'categoria_orgao' => $orgao['categoria_orgao'], 'unidades' => array());
                                foreach ($resultado_unidade as $unidade) {
                                    if ($cidade['cidade_area_atuacao'] == $unidade['cidade_area_atuacao'] && $orgao['nome_orgao'] == $unidade['nome_orgao']) {
                                        $resultado[$qtdCidade]['orgaos'][$qtdOrgao]['unidades'][$qtdUnidade] = array('nome_unidade' => $unidade['nome_unidade'], 'cod_unidade' => $unidade['cod_unidade']);
                                    }
                                    $qtdUnidade = $qtdUnidade + 1;
                                }
                                $qtdOrgao = $qtdOrgao + 1;
                            }
                            $qtdCidade = $qtdCidade + 1;
                        }
                        //resultado da consulta
                        $dados['resultadoView'] = $resultado;
                    }

                    //PAGINAÇÃO
                    $dados['paginas'] = $total_registro / $limite;
                    $dados['pagina_atual'] = $pagina_atual;
                    $dados['action'] = 'buscarapida';
                    $this->loadTemplate($view, $dados);
                }
            } else {
                header("location: /home");
            }
        }
    }

    public function avancado() {
        $cidadeModel = new cidade();
        $orgaoModel = new orgao();
        $unidadeModel = new unidade();

        $_POST['nBuscar'] = "Salvar";
        $_POST['nCidade'] = 2;
        $_POST['nOrgao'] = 2;
        //$_POST['nCategoria'] = "Estadual";
        $_POST['nConexao'] = "Fibra";

        $_POST['nAP'] = "Todos";

        $_POST['nRedeMetro'] = 1;

        if (isset($_POST['nBuscar']) && !empty($_POST['nBuscar'])) {
            //seleciona cidade
            if (isset($_POST['nCidade']) && !empty($_POST['nCidade']) && $_POST['nCidade'] != "Todas") {
                $result_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod_cidade ORDER BY cidade_area_atuacao ASC", array('cod_cidade' => addslashes(trim($_POST['nCidade']))));
            } else {
                $result_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao ORDER BY cidade_area_atuacao ASC", array());
            }
            //seleciona por codigo do orgao
            if (isset($_POST['nOrgao']) && !empty($_POST['nOrgao'])) {
                if ($_POST['nOrgao'] == "Todos") {
                    $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array());
                } else {
                    $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array('cod_orgao' => addslashes(trim($_POST['nOrgao']))));
                }
                //seleciona por esfera do orgao
            } else {
                if ($_POST['nCategoria'] == "Todas") {
                    $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao ORDER BY categoria_orgao ASC, nome_orgao ASC;', array());
                } else {
                    $result_orgao = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE categoria_orgao=:categoria ORDER BY categoria_orgao ASC, nome_orgao ASC;', array('categoria' => addslashes($_POST['nCategoria'])));
                }
            }
            //array que vai armazena o resultado_final
            $resultado_final = array();
            //cidade
            $qtd_cidade = 0;
            if (is_array($result_cidade) && is_array($result_orgao)) {
                foreach ($result_cidade as $cidade) {
                    $resultado_final[$qtd_cidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'cod_cidade' => $cidade['cod_area_atuacao'], 'orgaos' => array());

                    //orgao
                    $qtd_orgao = 0;
                    foreach ($result_orgao as $orgao) {
                        //setando os orgãos
                        $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao] = array('orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'categoria' => $orgao['categoria_orgao'], 'unidades' => array());


                        switch ($_POST['nConexao']) {
                            case "Rádio":
                                if (isset($_POST['nAP']) && !empty($_POST['nAP']) && $_POST['nAP'] != "Todos") {
                                    $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao AND unidade.cod_ap=:cod_ap ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao'], 'cod_ap' => addslashes(trim($_POST['nAP']))));
                                } else {
                                    $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                }
                                if (is_array($result_unidade_ap)) {
                                    $result_unidade = $result_unidade_ap;
                                }
                                break;
                            case "Fibra":
                                if (isset($_POST['nRedeMetro']) && !empty($_POST['nRedeMetro']) && $_POST['nRedeMetro'] != "Todos") {
                                    $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao AND unidade.cod_redemetro=:cod_redemetro ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao'], 'cod_redemetro' => $_POST['nRedeMetro']));
                                } else {
                                    $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                }
                                if (is_array($result_unidade_redemetro)) {
                                    $result_unidade = $result_unidade_redemetro;
                                }
                                break;
                            default :
                                $result_unidade_ap = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, ap.ip_ap, ap.nome_ap, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_ap AS ap, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND ap.cod_ap=unidade.cod_ap AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, ap.ip_ap ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));
                                $result_unidade_redemetro = $unidadeModel->read("SELECT cidade.cidade_area_atuacao, orgao.categoria_orgao, orgao.nome_orgao, rede.nome_redemetro, unidade.* FROM sgl_cidade_area_atuacao AS cidade, sgl_orgao AS orgao, sgl_redemetro AS rede, sgl_unidade AS unidade WHERE cidade.cod_area_atuacao=unidade.cod_cidade AND orgao.cod_orgao=unidade.cod_orgao AND rede.cod_redemetro=unidade.cod_redemetro AND unidade.cod_cidade=:cod_cidade AND unidade.cod_orgao=:cod_orgao ORDER BY cidade.cidade_area_atuacao ASC, orgao.categoria_orgao ASC, orgao.nome_orgao ASC, rede.nome_redemetro ASC, unidade.nome_unidade ASC", array('cod_cidade' => $cidade['cod_area_atuacao'], 'cod_orgao' => $orgao['cod_orgao']));

                                if (is_array($result_unidade_ap)) {
                                    $result_unidade = $result_unidade_ap;
                                }
                                if (is_array($result_unidade_redemetro)) {
                                    $result_unidade = $result_unidade_redemetro;
                                }
                                break;
                        }


                        if (isset($result_unidade) && is_array($result_unidade)) {
                            $qtd_unidade = 0;
                            foreach ($result_unidade as $unidade) {
                                $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade] = array('cod_unidade' => $unidade['cod_unidade'], 'unidade' => $unidade['nome_unidade'], 'ip' => $unidade['ip_unidade'], 'banda' => $unidade['banda_unidade'], 'conexao' => $unidade['conexao_unidade']);

                                if (!empty($unidade['cod_ap'])) {
                                    $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['cod_ap'] = $unidade['cod_ap'];
                                    $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['nome_ap'] = $unidade['nome_ap'];
                                } else {
                                    $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['cod_redemetro'] = $unidade['cod_redemetro'];
                                    $resultado_final[$qtd_cidade]['orgaos'][$qtd_orgao]['unidades'][$qtd_unidade]['nome_redemetro'] = $unidade['nome_redemetro'];
                                }
                                ++$qtd_unidade;
                            }
                        }
                        ++$qtd_orgao;
                    }
                    ++$qtd_cidade;
                }
            }
        }
    }

}
