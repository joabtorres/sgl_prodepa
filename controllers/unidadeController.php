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
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod_unidade) {
        if ($this->checkUserPattern()) {
            $view = "unidade_detalhada";
            $dados = array();
            //model
            $unidadeModel = new unidade();
            $apModel = new ap();
            $redeModel = new redemetro();
            $historicoModel = new historico();

            //dados para cláusulas de restrições
            $data = array('cod_unidade' => addslashes($cod_unidade), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_orgao.*, sgl_cidade_area_atuacao.* FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade AND sgl_cidade_area_atuacao.cod_nucleo=:cod_nucleo", $data);
            if ($resultado_unidade) {
                $resultado_unidade = $resultado_unidade[0];
                $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);

                //views - breadcrumb
                $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
                $dados['cidade'] = array('cod' => $resultado_unidade['cod_area_atuacao'], 'nome' => $resultado_unidade['cidade_area_atuacao']);

                //verifica se é conexão ap
                if (intval($resultado_unidade['cod_ap']) > 0) {
                    $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                    $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                    $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                    $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
                    $resultado_unidade['color_code_ap'] = $resultado_ap[0]['color_code_ap'];
                    $resultado_unidade['banda_ap'] = $resultado_ap[0]['banda_ap'];
                } else {
                    //senão então é conexao via rede metro
                    $resultado_redemetro = $redeModel->read('SELECT * FROM sgl_redemetro AS r WHERE r.cod_redemetro =:cod_redemetro; ', array('cod_redemetro' => $resultado_unidade['cod_redemetro']));
                    $resultado_unidade['nome_redemetro'] = $resultado_redemetro[0]['nome_redemetro'];
                    $resultado_unidade['estensao_redemetro'] = $resultado_redemetro[0]['estensao_redemetro'];
                }

                //consulta contratos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contrato = $unidadeModel->read("SELECT sgl_unidade_contrato.* FROM sgl_unidade_contrato, sgl_unidade WHERE sgl_unidade_contrato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade;", $data);
                    if ($resultado_contrato) {
                        foreach ($resultado_contrato as $row => $columns) {
                            $resultado_contrato[$row]['data_inicial_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_inicial_contrato']);
                            $resultado_contrato[$row]['data_vigencia_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_vigencia_contrato']);
                        }
                        $resultado_unidade['contratos'] = $resultado_contrato;
                    }
                }
                //consulta endereco
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_endereco = $unidadeModel->read("SELECT e.* FROM sgl_unidade_endereco AS e INNER JOIN sgl_unidade AS u ON e.cod_unidade=u.cod_unidade WHERE u.cod_unidade=:cod_unidade", $data);
                    if ($resultado_endereco) {
                        $resultado_unidade['endereco'] = $resultado_endereco[0];
                    }
                }
                //consulta contatos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                    if ($resultado_contato) {
                        $resultado_unidade['contatos'] = $resultado_contato;
                    }
                }

                //consulta históricos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_historico = $historicoModel->read('SELECT h.*, u.usuario_usuario AS usuario FROM sgl_unidade_historico AS h INNER JOIN sgl_usuario AS u ON h.cod_usuario=u.cod_usuario WHERE h.cod_unidade=:cod_unidade;', $data);
                    if ($resultado_historico) {
                        $resultado_unidade['historicos'] = $resultado_historico;
                    }
                }

                //dados da unidade;
                $dados['resultado_unidade'] = $resultado_unidade;
                $this->loadTemplate($view, $dados);
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_unidade) {
        if ($this->checkUserPattern()) {
            $view = "unidade_detalhada";
            $dados = array();
            //model
            $unidadeModel = new unidade();
            $apModel = new ap();
            $redeModel = new redemetro();
            $historicoModel = new historico();

            //dados para cláusulas de restrições
            $data = array('cod_unidade' => addslashes($cod_unidade), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_orgao.*, sgl_cidade_area_atuacao.* FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade AND sgl_cidade_area_atuacao.cod_nucleo=:cod_nucleo", $data);
            if ($resultado_unidade) {
                $resultado_unidade = $resultado_unidade[0];
                $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);

                //views - breadcrumb
                $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
                $dados['cidade'] = array('cod' => $resultado_unidade['cod_area_atuacao'], 'nome' => $resultado_unidade['cidade_area_atuacao']);
                $dados['orgao'] = array('cod' => $resultado_unidade['cod_orgao'], 'nome' => $resultado_unidade['nome_orgao']);
                //verifica se é conexão ap
                if (intval($resultado_unidade['cod_ap']) > 0) {
                    $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                    $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                    $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                    $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
                    $resultado_unidade['color_code_ap'] = $resultado_ap[0]['color_code_ap'];
                    $resultado_unidade['banda_ap'] = $resultado_ap[0]['banda_ap'];
                } else {
                    //senão então é conexao via rede metro
                    $resultado_redemetro = $redeModel->read('SELECT * FROM sgl_redemetro AS r WHERE r.cod_redemetro =:cod_redemetro; ', array('cod_redemetro' => $resultado_unidade['cod_redemetro']));
                    $resultado_unidade['nome_redemetro'] = $resultado_redemetro[0]['nome_redemetro'];
                    $resultado_unidade['estensao_redemetro'] = $resultado_redemetro[0]['estensao_redemetro'];
                }

                //consulta contratos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contrato = $unidadeModel->read("SELECT sgl_unidade_contrato.* FROM sgl_unidade_contrato, sgl_unidade WHERE sgl_unidade_contrato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade;", $data);
                    if ($resultado_contrato) {
                        foreach ($resultado_contrato as $row => $columns) {
                            $resultado_contrato[$row]['data_inicial_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_inicial_contrato']);
                            $resultado_contrato[$row]['data_vigencia_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_vigencia_contrato']);
                        }
                        $resultado_unidade['contratos'] = $resultado_contrato;
                    }
                }
                //consulta endereco
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_endereco = $unidadeModel->read("SELECT e.* FROM sgl_unidade_endereco AS e INNER JOIN sgl_unidade AS u ON e.cod_unidade=u.cod_unidade WHERE u.cod_unidade=:cod_unidade", $data);
                    if ($resultado_endereco) {
                        $resultado_unidade['endereco'] = $resultado_endereco[0];
                    }
                }
                //consulta contatos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                    if ($resultado_contato) {
                        $resultado_unidade['contatos'] = $resultado_contato;
                    }
                }

                //consulta históricos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_historico = $historicoModel->read('SELECT h.*, u.usuario_usuario AS usuario FROM sgl_unidade_historico AS h INNER JOIN sgl_usuario AS u ON h.cod_usuario=u.cod_usuario WHERE h.cod_unidade=:cod_unidade;', $data);
                    if ($resultado_historico) {
                        $resultado_unidade['historicos'] = $resultado_historico;
                    }
                }

                //dados da unidade;
                $dados['resultado_unidade'] = $resultado_unidade;
                $this->loadTemplate($view, $dados);
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_unidade) {
        if ($this->checkUserPattern()) {
            $view = "unidade_detalhada";
            $dados = array();
            //model
            $unidadeModel = new unidade();
            $apModel = new ap();
            $redeModel = new redemetro();
            $historicoModel = new historico();

            //dados para cláusulas de restrições
            $data = array('cod_unidade' => addslashes($cod_unidade), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_orgao.*, sgl_cidade_area_atuacao.* FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade AND sgl_cidade_area_atuacao.cod_nucleo=:cod_nucleo", $data);
            if ($resultado_unidade) {
                $resultado_unidade = $resultado_unidade[0];
                $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);

                //views - breadcrumb
                $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
                $dados['cidade'] = array('cod' => $resultado_unidade['cod_area_atuacao'], 'nome' => $resultado_unidade['cidade_area_atuacao']);
                //verifica se é conexão ap
                if (intval($resultado_unidade['cod_ap']) > 0) {
                    $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                    $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                    $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                    $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
                    $resultado_unidade['color_code_ap'] = $resultado_ap[0]['color_code_ap'];
                    $resultado_unidade['banda_ap'] = $resultado_ap[0]['banda_ap'];
                    $dados['ap'] = array('cod' => $resultado_ap[0]['cod_ap'], 'nome' => $resultado_ap[0]['nome_ap']);
                } else {
                    //senão então é conexao via rede metro
                    $resultado_redemetro = $redeModel->read('SELECT * FROM sgl_redemetro AS r WHERE r.cod_redemetro =:cod_redemetro; ', array('cod_redemetro' => $resultado_unidade['cod_redemetro']));
                    $resultado_unidade['nome_redemetro'] = $resultado_redemetro[0]['nome_redemetro'];
                    $resultado_unidade['estensao_redemetro'] = $resultado_redemetro[0]['estensao_redemetro'];
                }

                //consulta contratos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contrato = $unidadeModel->read("SELECT sgl_unidade_contrato.* FROM sgl_unidade_contrato, sgl_unidade WHERE sgl_unidade_contrato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade;", $data);
                    if ($resultado_contrato) {
                        foreach ($resultado_contrato as $row => $columns) {
                            $resultado_contrato[$row]['data_inicial_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_inicial_contrato']);
                            $resultado_contrato[$row]['data_vigencia_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_vigencia_contrato']);
                        }
                        $resultado_unidade['contratos'] = $resultado_contrato;
                    }
                }
                //consulta endereco
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_endereco = $unidadeModel->read("SELECT e.* FROM sgl_unidade_endereco AS e INNER JOIN sgl_unidade AS u ON e.cod_unidade=u.cod_unidade WHERE u.cod_unidade=:cod_unidade", $data);
                    if ($resultado_endereco) {
                        $resultado_unidade['endereco'] = $resultado_endereco[0];
                    }
                }
                //consulta contatos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                    if ($resultado_contato) {
                        $resultado_unidade['contatos'] = $resultado_contato;
                    }
                }

                //consulta históricos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_historico = $historicoModel->read('SELECT h.*, u.usuario_usuario AS usuario FROM sgl_unidade_historico AS h INNER JOIN sgl_usuario AS u ON h.cod_usuario=u.cod_usuario WHERE h.cod_unidade=:cod_unidade;', $data);
                    if ($resultado_historico) {
                        $resultado_unidade['historicos'] = $resultado_historico;
                    }
                }

                //dados da unidade;
                $dados['resultado_unidade'] = $resultado_unidade;
                $this->loadTemplate($view, $dados);
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel por carrega a view  presente no diretorio views/unidade_detalhe.php com seus respectivos dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($cod_unidade) {
        if ($this->checkUserPattern()) {
            $view = "unidade_detalhada";
            $dados = array();
            //model
            $unidadeModel = new unidade();
            $apModel = new ap();
            $redeModel = new redemetro();
            $historicoModel = new historico();

            //dados para cláusulas de restrições
            $data = array('cod_unidade' => addslashes($cod_unidade), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_orgao.*, sgl_cidade_area_atuacao.* FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade AND sgl_cidade_area_atuacao.cod_nucleo=:cod_nucleo", $data);
            if ($resultado_unidade) {
                $resultado_unidade = $resultado_unidade[0];
                $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);

                //views - breadcrumb
                $dados['unidade'] = array('cod' => $resultado_unidade['cod_unidade'], 'nome' => $resultado_unidade['nome_unidade']);
                $dados['cidade'] = array('cod' => $resultado_unidade['cod_area_atuacao'], 'nome' => $resultado_unidade['cidade_area_atuacao']);
                //verifica se é conexão ap
                if (intval($resultado_unidade['cod_ap']) > 0) {
                    $data = array('cod_ap' => $resultado_unidade['cod_ap']);
                    $resultado_ap = $apModel->read("SELECT * FROM sgl_ap WHERE sgl_ap.cod_ap=:cod_ap", $data);
                    $resultado_unidade['nome_ap'] = $resultado_ap[0]['nome_ap'];
                    $resultado_unidade['ip_ap'] = $resultado_ap[0]['ip_ap'];
                    $resultado_unidade['color_code_ap'] = $resultado_ap[0]['color_code_ap'];
                    $resultado_unidade['banda_ap'] = $resultado_ap[0]['banda_ap'];
                } else {
                    //senão então é conexao via rede metro
                    $resultado_redemetro = $redeModel->read('SELECT * FROM sgl_redemetro AS r WHERE r.cod_redemetro =:cod_redemetro; ', array('cod_redemetro' => $resultado_unidade['cod_redemetro']));
                    $resultado_unidade['nome_redemetro'] = $resultado_redemetro[0]['nome_redemetro'];
                    $resultado_unidade['estensao_redemetro'] = $resultado_redemetro[0]['estensao_redemetro'];
                    // view redemetro
                    $dados['redemetro'] = array('cod' => $resultado_redemetro[0]['cod_redemetro'], 'nome' => $resultado_redemetro[0]['nome_redemetro']);
                }

                //consulta contratos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contrato = $unidadeModel->read("SELECT sgl_unidade_contrato.* FROM sgl_unidade_contrato, sgl_unidade WHERE sgl_unidade_contrato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade;", $data);
                    if ($resultado_contrato) {
                        foreach ($resultado_contrato as $row => $columns) {
                            $resultado_contrato[$row]['data_inicial_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_inicial_contrato']);
                            $resultado_contrato[$row]['data_vigencia_contrato'] = $this->formatDateView($resultado_contrato[$row]['data_vigencia_contrato']);
                        }
                        $resultado_unidade['contratos'] = $resultado_contrato;
                    }
                }
                //consulta endereco
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_endereco = $unidadeModel->read("SELECT e.* FROM sgl_unidade_endereco AS e INNER JOIN sgl_unidade AS u ON e.cod_unidade=u.cod_unidade WHERE u.cod_unidade=:cod_unidade", $data);
                    if ($resultado_endereco) {
                        $resultado_unidade['endereco'] = $resultado_endereco[0];
                    }
                }
                //consulta contatos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade", $data);
                    if ($resultado_contato) {
                        $resultado_unidade['contatos'] = $resultado_contato;
                    }
                }

                //consulta históricos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_historico = $historicoModel->read('SELECT h.*, u.usuario_usuario AS usuario FROM sgl_unidade_historico AS h INNER JOIN sgl_usuario AS u ON h.cod_usuario=u.cod_usuario WHERE h.cod_unidade=:cod_unidade;', $data);
                    if ($resultado_historico) {
                        $resultado_unidade['historicos'] = $resultado_historico;
                    }
                }

                //dados da unidade;
                $dados['resultado_unidade'] = $resultado_unidade;
                $this->loadTemplate($view, $dados);
            }
        }
    }

}
