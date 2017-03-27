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
    public function cidade($page) {
        $view = "cidade_relatorio";
        $dados = array();
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
    public function orgao($page, $cod_cidade = array()) {
        $view = "orgao_relatorio";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, mostra os ap's registrados nas cidades e seus respectivos links cadastrados.
     * @param int $page - paginação
     * @param int $cod_cidade - codigo cidade area de atuação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($page, $cod_cidade = array()) {
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
    public function unidade($page, $cod_cidade = array()) {
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
    public function filtro($page) {
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
