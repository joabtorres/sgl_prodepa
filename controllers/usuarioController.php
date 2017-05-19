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
        $view = "usuario_listar";
        $dados = array();
        $usuarioModel = new usuario();
        //consulta todos os usuários pertencente ao respecito núcleo
        $resultado_usuario = $usuarioModel->read('SELECT * FROM sgl_usuario WHERE cod_cidade_nucleo=:cod_nucleo AND statu_usuario=1;', array('cod_nucleo' => $_SESSION['user_sgl']['nucleo']));
        if ($resultado_usuario) {
            $dados['usuarios'] = $resultado_usuario;
        }
        $this->loadTemplate($view, $dados);
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
