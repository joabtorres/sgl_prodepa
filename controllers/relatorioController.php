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
        $view = "cidade_relatorio";
        $dados = array();
        $cidadeModel = new cidade();
        $data = array("cod" => 2);
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

    /**
     * Está função pertence a uma action do controle MVC, mostra os orgãos registrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo da cidade area de atuação
     * @param int $cod_orgao - codigo do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgaos($page = 1, $cod_cidade = 0, $cod_orgao = 0) {

        $view = "orgao_relatorio";
        $dados = array();
        //models
        $orgaoModel = new orgao();
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();

        //array que vai ser utilizado na consulta com banco de dados
        $data = array('cod_nucleo' => 2);

        //paginação
        $limite = 1;
        $indice = 0;
        $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
        $indice = ($pagina_atual - 1) * $limite;

        //se não for setado a cidade
        if (empty($cod_cidade)) {
            //lista todos os orgãos que tem unidade cadastrada de todas as cidades
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);
            $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_orgao.nome_orgao ASC", $data);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade;", $data);

            //total de cidades
            $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC", $data);
            $total_registro = $cidadeModel->getNumRows();
        } else {

            $data['cod_cidade'] = addslashes($cod_cidade);
            //lista todos os orgãos que tem unidade cadastrada de cidade específica
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo  AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ;", $data);
            if ($resultado_cidade) {
                $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
            }
            //se não for setado o orgão
            if (empty($cod_orgao)) {
                $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_orgao.nome_orgao ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade;", $data);

                $total_registro = 1;
            } else {
                //lista todos os orgãos que tem unidade cadastrada de cidade específica e orgão específico
                $data['cod_orgao'] = addslashes($cod_orgao);

                $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_orgao.cod_orgao=:cod_orgao ORDER BY sgl_orgao.nome_orgao ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_orgao.cod_orgao=:cod_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade;", $data);

                if ($resultado_orgao) {
                    $dados['orgao'] = array('nome' => $resultado_orgao[0]['nome_orgao'], 'cod' => $resultado_orgao[0]['cod_orgao']);
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
                    $resultado[$qtdCidade]['orgaos'][$qtdOrgao] = array('nome_orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'unidades' => array());
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

    /**
     * Está função pertence a uma action do controle MVC, mostra os ap's registrados nas cidades e seus respectivos links cadastrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @param $cod_ap  - código do ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function aps($page = 1, $cod_cidade = 0, $cod_ap = 0) {
        $view = "ap_relatorio";
        $dados = array();
        //models
        $apModel = new ap();
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();

        //array que vai ser utilizado na consulta com banco de dados
        $data = array('cod_nucleo' => 2);

        //paginação
        $limite = 1;
        $indice = 0;
        $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
        $indice = ($pagina_atual - 1) * $limite;

        //se não for setado a cidade
        if (empty($cod_cidade)) {
            //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);

            $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=2 ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade ASC;", $data);

            //total de cidades
            $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC", $data);
            $total_registro = $cidadeModel->getNumRows();
        } else {

            $data['cod_cidade'] = addslashes($cod_cidade);
            //lista todos os orgãos que tem unidade cadastrada de cidade específica
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo  AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ;", $data);
            if ($resultado_cidade) {
                $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
            }
            //se não for setado o orgão
            if (empty($cod_ap)) {
                $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade;", $data);

                $total_registro = 1;
            } else {
                //lista todos os orgãos que tem unidade cadastrada de cidade específica e orgão específico
                $data['cod_ap'] = addslashes($cod_ap);

                $resultado_ap = $apModel->read("SELECT DISTINCT(sgl_ap.nome_ap), sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_ap.cod_ap=:cod_ap ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC;", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_ap.nome_ap, sgl_ap.cod_ap, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_ap, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_ap.cod_ap=sgl_unidade.cod_ap AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade AND sgl_ap.cod_ap=:cod_ap ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_ap.nome_ap ASC, sgl_unidade.nome_unidade;", $data);

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
                    $resultado[$qtdCidade]['aps'][$qtdAps] = array('nome_ap' => $ap['nome_ap'], 'cod_ap' => $ap['cod_ap'], 'unidades' => array());
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

    public function redemetro() {
        $view = "redemetro_relatorio";
        $dados = array();
        //models
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();

        //array que vai ser utilizado na consulta com banco de dados
        $data = array('cod_nucleo' => 2, 'conexao' => "Fibra");

        //paginação
        $limite = 1;
        $indice = 0;
        $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
        $indice = ($pagina_atual - 1) * $limite;

        if (empty($cod_cidade)) {
            //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade  AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.conexao_unidade=:conexao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . ',' . $limite, $data);

            //-- COMANDO PARA LISTA AS UNIDADES REGISTRADAS POR NÚCLEO E ORDEM ALFABETICA DAS CIDADE
            $resultado_unidade = $unidadeModel->read('SELECT sgl_unidade.nome_unidade, sgl_unidade.cod_unidade, sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.conexao_unidade=:conexao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_unidade.nome_unidade ASC;', $data);

            //para paginação total de registro
            $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.conexao_unidade=:conexao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
            $total_registro = $cidadeModel->getNumRows();
        } else {
            $data['cod_cidade'] = addslashes($cod_cidade);
            //-- COMANDO PARA LISTA AS  CIDADES DESTACADAS QUE CONTEM UNIDADE REGISTRADA;
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo, sgl_unidade WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=sgl_unidade.cod_cidade AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.conexao_unidade=:conexao AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ;", $data);
            if ($resultado_cidade) {
                $dados['cidade'] = array("nome" => $resultado_cidade[0]['cidade_area_atuacao'], "cod" => $resultado_cidade[0]['cod_area_atuacao']);
            }
            //-- COMANDO PARA LISTA AS UNIDADES REGISTRADAS POR NÚCLEO E ORDEM ALFABETICA DAS CIDADE
            $resultado_unidade = $unidadeModel->read('SELECT sgl_unidade.nome_unidade, sgl_unidade.cod_unidade, sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_unidade.conexao_unidade=:conexao AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_unidade.nome_unidade ASC;', $data);

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

        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os clientes registrados nas cidades e seus respectivos links para mais detalhes.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidades($page = 1, $cod_cidade = 0) {
        $view = "unidade_relatorio";
        $dados = array();
        //models
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();

        //array que vai ser utilizado na consulta com banco de dados
        $data = array('cod_nucleo' => 2);

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

    /**
     * Está função pertence a uma action do controle MVC, responsável por fazer uma pesquisa avançada, opção de modo de exibição e gera pdf
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function filtro($page = array()) {
        $view = "buscar_avancada_relatorio";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, responsável para fazer uma buscar rápida, por unidade ou por orgão.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function buscarapida($page) {
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
                $data = array('cod_nucleo' => 2, 'nome_unidade' => '%' . $_SESSION['sgl']['buscarapida']['campo'] . '%');

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
                $data = array('cod_nucleo' => 2, 'nome_orgao' => '%' . $_SESSION['sgl']['buscarapida']['campo'] . '%');

                //paginação
                $limite = 1;
                $indice = 0;
                $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
                $indice = ($pagina_atual - 1) * $limite;

                //lista todos os orgãos que tem unidade cadastrada de todas as cidades
                $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_orgao.nome_orgao FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC LIMIT " . $indice . ',' . $limite, $data);
                $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao  ORDER BY sgl_orgao.nome_orgao ASC", $data);
                $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade;", $data);

                //total de cidades
                $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_orgao.nome_orgao FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_orgao.nome_orgao LIKE :nome_orgao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC", $data);
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
                            $resultado[$qtdCidade]['orgaos'][$qtdOrgao] = array('nome_orgao' => $orgao['nome_orgao'], 'cod_orgao' => $orgao['cod_orgao'], 'unidades' => array());
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
