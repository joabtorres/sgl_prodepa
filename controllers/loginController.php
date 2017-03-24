<?php
/**
 * A classe 'loginController' é responsável por fazer validação de login para que tenha acesso ao sistema, podendo verifica se o e-mail e valido e exibindo a opção de recupera senha, 
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe loginController
 */
class loginController extends controller {

	/**
	 * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/login.php, além disso, ela faz validações de usuário, tenha digitado corretamento todos os campos do login e o usuário esteja registrado no banco será criado um array $_SESSION['usuario'] com os seguintes dados, nome, url da foto, nível de acesso e usuário ativo e chama a função recupera,caso usuário deseja recupera a senha.
	 * @access public
	 * @author Joab Torres <joabtorres1508@gmail.com
	 */
	public function index() {
            echo "LoginController <br/>";
	}

	/**
	 * Está função verifica se o usuário está cadastrado no sistema, se ele estive será criado uma nova senha e enviado para o respectivo email
	 * @return bollean 
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 * 
	 */
	private function recuperar($email) {
		return false;
	}

	/**
	 * Está função verifica  se o e-mail do usuário é valido, ou seja, se seu servido de email existe.
	 * @param String $email
	 * @return bollean 
	 * @access private
	 * @author Joab Torres <joabtorres1508@gmail.com>
	 */
	private function validar_email($email) {
		return false;
	}
}
