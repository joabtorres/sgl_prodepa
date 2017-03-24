<?php
/**
 * A classe 'core' é responsável para fazer o controle da navegação via url, setando as classes controllers e suas respectivas actions e params 
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package core
 * @example classe core
 */
class core {
	/**
	 * String $controller - referente a classe controller
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	private $controller;
	/**
	 * String $action - referente a ação ou método presente na classe da variavel $controller
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	private $action;
	/**
	 * Array $params - referente aos parametros que serão setados na action solicitada 
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	private $params;
	/**
	 * String $url - referente aos caminhos acessados na url do navegador
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	private $url;

	/**
	 * Está função tem como objetivo: captura um $_GET['url] e armazena na váriavel $url para que possa fazer o controle de requisção digitado na url, sendo acessa um controller, action e params.
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	public function run() {
	}
}
