<?php

/**
 * A classe 'usuarioController' é responsável para fazer o carregamento da view/usuarios-lista.php
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe usuarioController
 */
class usuarioController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável para mostra todos os usuários registrados, com opção de buscar, usuário especifico.
     * 
     * OBS: Usuário cargo "Gerente do Núcleo" mostra somente usuário do seu núcleo e cargo Adminstradores do Sistema, exibi todos usuários.
     * 
     * @param int $page - paginação
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($page = 1) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "usuario_listar";
            $dados = array();
            $usuarioModel = new usuario();
            //consulta todos os usuários pertencente ao respecito núcleo
            $resultado_usuario = $usuarioModel->read('SELECT * FROM sgl_usuario WHERE cod_cidade_nucleo=:cod_nucleo AND statu_usuario=1;', array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']));
            if ($resultado_usuario) {
                $dados['usuarios'] = $resultado_usuario;
            }
            //criando nova senha
            if (isset($_POST['nEnviar'])) {
                $email = addslashes(trim($_POST['nEmail']));
                if ($this->validar_email($email)) {
                    $this->recuperar($email);
                    $_POST = null;
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função verifica se o usuário está cadastrado no sistema, se ele estive será criado uma nova senha e enviado para o respectivo email
     * @param $email e-mail que está efetuando requisição
     * @return bollean 
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com> 
     */
    private function recuperar($email) {
        $usuarioModel = new usuario();
        $senha = $usuarioModel->newpassword($email);
        if ($senha) {
            // envia email ao usuário
            $assunto = 'Sistema de Gerenciamento de Link&lsquo;s - Nova Senha';
            $destinatario = $email;
            $mensagem = '<!DOCTYPE html>
			<html lang="pt-br">
			<head>
				<meta charset="UTF-8">
				<title>' . $assunto . '</title>
			</head>
			<body>
				<div style="width: 98%;display: block;margin: 10px auto;padding: 0;font-family: sans-serif, Arial;border : 2px solid #357ca5;">
				<h3 style="background: #357ca5;color: white;padding: 10px;margin: 0;">Nova Senha! <br/> <small>Sistema de Gerenciamento de Link&lsquo;s</small></h3>
					<p style="padding: 10px;line-height: 30px;">
                                            Você solicitou uma nova senha de acesso ao <b>SGL</b> (Sistema de Gerenciamento de Link&lsquo;s), confira abaixo sua nova senha de acesso: <br/>
                                            <span style="font-weight:bold">Email: </span><span style="color: #357ca5;">' . $email . '</span><br/>
                                            <span style="font-weight:bold">Nova Senha: </span> <span style="color: #357ca5;">' . $senha . '</span><br/>
                                                 <a href="' . BASE_URL . '" style="text-decoration: none;">Carregar Página</a>
					</p>
				</div>
			</body>
			</html>';
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
            $headers .= 'From: Sistema de Gerenciamento de Link&lsquo;s <contato@kananda.imb.br>' . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            mail($destinatario, $assunto, $mensagem, $headers);
        }
    }

    /**
     * Está função verifica  se o e-mail do usuário é valido, ou seja, se seu servido de email existe.
     * @param String $email
     * @return bollean 
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function validar_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            list($usuario, $dominio) = explode("@", $email);
            if (checkdnsrr($dominio, 'MX')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responsável desloga o usuário do sistema, limpando a $_SESSION['usuario']
     * 
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function sair() {
        $_SESSION['user_sgl'] = array();
        header("Location: /login");
    }

}
