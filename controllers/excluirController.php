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
class excluirController extends controller {

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
	 * @param int $cod_unidade - código da unidade
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function index($cod) {
	}

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel para excluir uma cidade, todos seus ap's e todos os as unidades atendente. 
	 * @param int $cod_cidade - Código da cidade
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function cidade($cod_cidade) {
	}

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um orgão específico e todos os as unidades. 
	 * @param int $cod_orgao - Código da orgão
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function orgao($cod_orgao) {
	}

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um ap específico. 
	 * @param int $cod_ap - Código da ap
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function ap($cod_ap) {
	}

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel para excluir uma unidade específico.
	 * @param int $cod_unidade - Código da unidade
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function unidade($cod_unidade) {
	}

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um usuario específico.
	 * @param int $cod_usuario - Código do usuario
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function usuario($cod_usuario) {
	}
}
