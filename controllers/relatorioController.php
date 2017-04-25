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
        $this->cidade(1);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável para mostra todas as cidades  em atuação que o núcleo é responsável, lógico isso é definido pelo cod_nucleo do usuario, chamando link para os orgãos, ap's e clientes registrado da quela cidade.
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidade($page = array()) {
        $view = "cidade_relatorio";
        $dados = array();
        $cidadeModel = new cidade();
        $data = array("cod" => 2);
        $limite = 6;
        $indice = 0;
        $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
        $indice = ($pagina_atual - 1) * $limite;

        $dados['cidades'] = $cidadeModel->read("SELECT sgl_cidade_area_atuacao.* FROM sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC LIMIT " . $indice . "," . $limite, $data);
        $total_registro = $cidadeModel->getNumRows();
        $dados['paginas'] = $total_registro / $limite;
        $dados['pagina_atual'] = $pagina_atual;
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os orgãos registrados.
     * @param String
     * @param int $page - paginação
     * @param int $cod_cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($page = array(), $cod_cidade = array()) {
        $view = "orgao_relatorio";
        $dados = array();
        //model Orgao
        $orgaoModel = new orgao();
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();

        //array que vai ser utilizado na consulta com banco de dados
        $data = array('cod_nucleo' => 2);

        //paginação
        $limite = 20;
        $indice = 0;
        $pagina_atual = (isset($page) && !empty($page)) ? addslashes($page) : 1;
        $indice = ($pagina_atual - 1) * $limite;

        if (empty($cod_cidade)) {
            //lista todos os orgãos que tem unidade cadastrada de todas as cidades
            $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_orgao.nome_orgao ASC", $data);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=2 ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade ASC LIMIT " . $indice . "," . $limite, $data);
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao) FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
        
            //total de registros
            $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade ASC", $data);
            $total_registro = $unidadeModel->getNumRows();
        } else {
            $data['cod_cidade'] = addslashes($cod_cidade);
            $dados['cod_cidade'] = addslashes($cod_cidade);
            $resultado_orgao = $orgaoModel->read("SELECT DISTINCT(sgl_orgao.nome_orgao), sgl_orgao.cod_orgao FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_orgao.nome_orgao ASC", $data);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade ASC LIMIT " . $indice . "," . $limite, $data);
            $resultado_cidade = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao) FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC ", $data);
        
            //total de registros
            $unidadeModel->read("SELECT sgl_orgao.nome_orgao,sgl_orgao.cod_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao, sgl_unidade.cod_unidade, sgl_unidade.nome_unidade FROM sgl_orgao, sgl_unidade, sgl_cidade_area_atuacao, sgl_cidade_nucleo WHERE sgl_orgao.cod_orgao=sgl_unidade.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_cidade_area_atuacao.cod_nucleo=sgl_cidade_nucleo.cod_nucleo AND sgl_cidade_nucleo.cod_nucleo=:cod_nucleo AND sgl_cidade_area_atuacao.cod_area_atuacao=:cod_cidade ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC, sgl_orgao.nome_orgao ASC, sgl_unidade.nome_unidade ASC", $data);
            $total_registro = $unidadeModel->getNumRows();
        }

        $resultado = array();
        $qtdCidade = 0;
        foreach ($resultado_cidade as $cidade) {
            $qtdOrgao = 0;
            $resultado[$qtdCidade] = array('cidade' => $cidade['cidade_area_atuacao'], 'orgaos' => array());
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
        $dados['resultadoView'] = $resultado;
        
        //PAGINAÇÃO
        $dados['paginas'] = $total_registro / $limite;
        $dados['pagina_atual'] = $pagina_atual;
        
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os ap's registrados nas cidades e seus respectivos links cadastrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($page = array(), $cod_cidade = array()) {
        $view = "ap_relatorio";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os clientes registrados nas cidades e seus respectivos links para mais detalhes.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($page = array(), $cod_cidade = array()) {
        $view = "unidade_relatorio";
        $dados = array();
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
        echo $page;
    }

}
