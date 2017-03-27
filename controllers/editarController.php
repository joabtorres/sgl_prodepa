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
        
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um orgão e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_orgao - código do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_orgao) {
        
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um ap e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_ap - código da ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_ap) {
        
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod_unidade) {
        
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um usuario e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_usuario - Código do usuario
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod_usuario) {
        $view = "usuario_editar";
        $dados = array();
        $this->loadTemplate($view, $dados);
        echo $cod_usuario;
    }

}
