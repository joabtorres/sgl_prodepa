<?php

/**
 * A classe 'cadastrarController' é responsável para fazer o gerenciamento no cadastro de cidades, orgãos, ap's e unidades
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe cadastrarController
 */
class cadastrarController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cidade();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
        $this->cidade();
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma nova  cidade, seja ela o núcleo ou uma área de representção. 
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidade() {
        $view = "cidade_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um orgão e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao() {
        $view = "orgao_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um ap em determinada cidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap() {
        $view = "ap_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma unidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade() {
        $view = "unidade_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de cadastra usuario e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario() {
        $view = "usuario_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

}
