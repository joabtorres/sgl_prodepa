<?php

/**
 * A classe 'controller' é responsável por fazer o carregamento das views, concebe paginação e verifica nível de usuário
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package core
 * @example classe controller
 */
class controller {

    /**
     * Está função verifica se a $_SESSION['usuario'] está inicializada, caso esteja setada então usuario tem permissao de acesso.
     * @return bollean 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function checkUserPattern() {
        return false;
    }

    /**
     * Está função verifica se o usuário está logado é se ele tem privilegio de administrador, caso esteja lojado e tenha o privilegio nessário, então, usuario tem permissao de acesso.
     * @return bollean 
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function checkUserAdministrator() {
        return false;
    }

    /**
     * Está função é responsável para carrega uma view;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function loadView($viewName, $viewData = array()) {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para carrega um template estático, a onde ela chama chama uma função lo;
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function loadTemplate($viewName, $viewData = array()) {
        include 'views/template.php';
    }

    /**
     * Está função é responsável para carrega uma view dinamica dentro de um template estático
     * @param String viewName - nome da view;
     * @param array $viewData - Dados para serem carregados na view
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);
        include 'views/' . $viewName . ".php";
    }

    /**
     * Está função é responsável para gera uma paginação, quando necessário mostra vários dados;
     * @param  int $pageAtual - pagina atual acessada
     * @param  int $limit - limit de itens por página
     * @param String $action - nome do método que solicita a paginação
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function pagination($pageAtual, $limit, $action) {
       
    }

    /**
     * Está função é responsável para formata datas padrão do Banco de Dados e retorna o formato Brasileiro para view
     * @param String $date : Data no padrão ANO-MES-DIA (1999-02-20)
     * @return String data formatada OR boollean False
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateView($date) {
        $arrayDate = explode("-", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '/' . $arrayDate[1] . '/' . $arrayDate[0];
        } else {
            return false;
        }
    }

    /**
     * Está função é responsável para formata datas padrão Brasil e retorna no padrão Banco de Dados
     * @param String $date : Data no padrão DIA/MES/ANO (20/02/1999)
     * @return String data formatada OR boollean False
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected function formatDateBD($date) {
        $arrayDate = explode("/", $date);
        if (count($arrayDate) == 3) {
            return $arrayDate[2] . '-' . $arrayDate[1] . '-' . $arrayDate[0];
        } else {
            return false;
        }
    }

}
