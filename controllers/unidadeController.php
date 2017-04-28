<?php

/**
 * A classe 'unidadeController' é responsável para fazer o carregamento da unidade de forma detalhada
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package controllers
 * @example classe unidadeController
 */
class unidadeController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @param int $cod_cidade - código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod_unidade, $cod_cidade = 0) {
        
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @param int $cod_cidade - código da cidade
     * @param int $cod_orgao - Código do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_unidade, $cod_cidade, $cod_orgao) {
        $view = "unidade_detalhada";
        $dados = array();
        //model
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();
        $orgaoModel = new orgao();


        //dados para cláusulas de restrições
        $data = array('cod_unidade' => addslashes($cod_unidade));
        $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_unidade_endereco.*, sgl_orgao.nome_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_unidade_endereco, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_unidade=sgl_unidade_endereco.cod_unidade AND sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade", $data);
        if ($resultado_unidade) {
            $resultado_unidade = $resultado_unidade[0];
            $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);
            $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
            //verifica se é conexão ap
            if (intval($resultado_unidade['cod_ap']) > 0) {
                $apModel = new ap();
                $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
            }
            //consulta contatos
            if ($resultado_unidade['cod_unidade']) {
                $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                if ($resultado_contato) {
                    $resultado_unidade['contatos'] = $resultado_contato;
                }
            }

            //consulta cidade
            $data = array('cod_cidade' => addslashes($cod_cidade));
            $resultado_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod_cidade;", $data);
            if ($resultado_cidade) {
                $dados['cidade'] = array('cod' => $resultado_cidade[0]['cod_area_atuacao'], 'nome' => $resultado_cidade[0]['cidade_area_atuacao']);
            }
            //consulta orgao
            $data = array('cod_orgao' => addslashes($cod_orgao));
            $resultado_orgao = $orgaoModel->read("SELECT * FROM sgl_orgao WHERE sgl_orgao.cod_orgao=:cod_orgao;", $data);
            if ($resultado_orgao) {
                $dados['orgao'] = array('cod' => $resultado_orgao[0]['cod_orgao'], 'nome' => $resultado_orgao[0]['nome_orgao']);
            }

            //dados da unidade;
            $dados['resultado_unidade'] = $resultado_unidade;
        }
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @param int $cod_cidade - código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_unidade, $cod_cidade, $cod_ap) {
        $view = "unidade_detalhada";
        $dados = array();
        //model
        $unidadeModel = new unidade();
        $cidadeModel = new cidade();
        $apModel = new ap();


        //dados para cláusulas de restrições
        $data = array('cod_unidade' => addslashes($cod_unidade));
        $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_unidade_endereco.*, sgl_orgao.nome_orgao, sgl_orgao.categoria_orgao, sgl_cidade_area_atuacao.cidade_area_atuacao FROM sgl_unidade, sgl_unidade_endereco, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_unidade=sgl_unidade_endereco.cod_unidade AND sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade", $data);
        if ($resultado_unidade) {
            $resultado_unidade = $resultado_unidade[0];
            $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);
            $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
            //verifica se é conexão ap
            if (intval($resultado_unidade['cod_ap']) > 0) {
                $apModel = new ap();
                $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
            }
            //consulta contatos
            if ($resultado_unidade['cod_unidade']) {
                $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                if ($resultado_contato) {
                    $resultado_unidade['contatos'] = $resultado_contato;
                }
            }

            //consulta cidade
            $data = array('cod_cidade' => addslashes($cod_cidade));
            $resultado_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod_cidade;", $data);
            if ($resultado_cidade) {
                $dados['cidade'] = array('cod' => $resultado_cidade[0]['cod_area_atuacao'], 'nome' => $resultado_cidade[0]['cidade_area_atuacao']);
            }
            //consulta ap
            $data = array('cod_ap' => addslashes($cod_ap));
            $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap;", $data);
            if ($resultado_ap) {
                $dados['ap'] = array('cod' => $resultado_ap[0]['cod_ap'], 'nome' => $resultado_ap[0]['nome_ap']);
            }

            //dados da unidade;
            $dados['resultado_unidade'] = $resultado_unidade;
        }
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @param int $cod_cidade - código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($cod_unidade, $cod_cidade) {
        
    }

}
