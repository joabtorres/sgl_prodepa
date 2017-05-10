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
        $view = "login";
        $dados = array();
        if (isset($_POST['nEntrar']) && !empty($_POST['nEntrar'])) {
            if (!empty($_POST['nSerachUsuario']) && !empty($_POST['nSearchSenha'])) {
                $usuario = array('usuario' => addslashes($_POST['nSerachUsuario']), 'senha' => md5(sha1($_POST['nSearchSenha'])));
                $dominio = strstr($usuario['usuario'], '@prodepa.pa.gov.br');
                $usuarioModel = new usuario();
                if ($dominio) {
                    $resultado = $usuarioModel->read_specific('SELECT * FROM sgl_usuario WHERE email_usuario=:usuario AND senha_usuario=:senha AND statu_usuario = 1', $usuario);
                    if (!$resultado) {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
                    }
                } else {
                    $resultado = $usuarioModel->read_specific('SELECT * FROM sgl_usuario WHERE usuario_usuario=:usuario AND senha_usuario=:senha AND statu_usuario = 1', $usuario);
                    if (!$resultado) {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha está incorreto!';
                    }
                }
                if (!isset($dados['erro']) && empty($dados['erro'])) {
                    //inicando sessao
                    $_SESSION['user_sgl'] = array();
                    //codigo
                    $_SESSION['user_sgl']['cod'] = $resultado['cod_usuario'];
                    //nome
                    $_SESSION['user_sgl']['nome'] = $resultado['nome_usuario'];
                    //sobrenome
                    $_SESSION['user_sgl']['sobrenome'] = $resultado['sobrenome_usuario'];
                    //cod nucleo
                    $_SESSION['user_sgl']['nucleo'] = $resultado['cod_cidade_nucleo'];
                    //cargo
                    $_SESSION['user_sgl']['cargo'] = $resultado['cargo_usuario'];
                    //img
                    $_SESSION['user_sgl']['imagem'] = $resultado['img_usuario'];
                    //nivel
                    $_SESSION['user_sgl']['nivel'] = $resultado['statu_admin_usuario'];
                    //statu
                    $_SESSION['user_sgl']['statu'] = $resultado['statu_usuario'];
                    header("location: /home");
                }
            } else {
                $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> O Campo Usuário ou Senha não está preenchido!';
            }
        }
        $this->loadView($view, $dados);
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
