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
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            //dados da view
            $dados = array();
            //view a ser carregada
            $viewName = 'cidade_editar';
            //model cidade
            $cidadeModel = new cidade();
            $dados['nucleos'] = $cidadeModel->read('SELECT * FROM sgl_cidade_nucleo', array());
            $resultado_cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod ;', array('cod' => addslashes($cod_cidade)));
            if ($resultado_cidade) {
                $dados['cidade'] = $resultado_cidade[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                //este array vai armazena os valores do formulário;
                $cidade = array();
                if (isset($_POST['neditCidade']) && !empty($_POST['neditCidade'])) {
                    $cidade['cod'] = addslashes($_POST['neditCod']);
                    //CAMPO cidade
                    $cidade['cidade'] = addslashes($_POST['neditCidade']);
                    //campo codigo do  nucleo
                    $cidade['nucleo'] = addslashes($_POST['neditNucleo']);
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        //update
                        $resultado = $cidadeModel->update('UPDATE sgl_cidade_area_atuacao SET cidade_area_atuacao=:cidade, cod_nucleo=:nucleo WHERE cod_area_atuacao=:cod ', $cidade);
                        if ($resultado) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Edição realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $resultado_cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod ;', array('cod' => addslashes($cod_cidade)));
                            if ($resultado_cidade) {
                                $dados['cidade'] = $resultado_cidade[0];
                            }
                            $_POST = array();
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Informe o nome da cidade!';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($viewName, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um orgão e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_orgao - código do orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_orgao) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "orgao_editar";
            $orgaoModel = new orgao();

            $result = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod', array('cod' => addslashes(trim($cod_orgao))));
            if ($result) {
                $dados['orgao'] = $result[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (isset($_POST['neditOrgao']) && !empty($_POST['neditOrgao'])) {
                    //array com os dados do formulário
                    $orgaoModel = new orgao();
                    $data = array("nome" => addslashes($_POST['neditOrgao']), "categoria" => addslashes($_POST['neditCategoria']), 'cod' => addslashes(trim($_POST['neditCod'])));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $result = $orgaoModel->update("UPDATE sgl_orgao SET nome_orgao=:nome, categoria_orgao=:categoria WHERE cod_orgao=:cod", $data);
                        if ($result) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                            $result = $orgaoModel->read('SELECT * FROM sgl_orgao WHERE cod_orgao=:cod', array('cod' => addslashes(trim($cod_orgao))));
                            if ($result) {
                                $dados['orgao'] = $result[0];
                            }
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Informe o nome do orgão!';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um ap e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_ap - código da ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_ap) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "ap_editar";
            $apModel = new ap();
            $resultado = $apModel->read("SELECT ap.*, c.cidade_area_atuacao FROM  sgl_ap AS ap INNER JOIN sgl_cidade_area_atuacao AS c ON ap.cod_area_atuacao=c.cod_area_atuacao WHERE ap.cod_ap = :cod", array('cod' => addslashes(trim($cod_ap))));
            if ($resultado) {
                $dados['ap'] = $resultado[0];
            }

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['neditNome']) || !empty($_POST['neditBanda']) || !empty($_POST['neditCCode']) || !empty($_POST['neditIP'])) {
                    //array que armazena os dados do formulário
                    $data = array("nome" => addslashes(strtoupper($_POST['neditNome'])), "banda" => addslashes($_POST['neditBanda']), "color_code" => addslashes($_POST['neditCCode']), "ip" => addslashes($_POST['neditIP']), 'cod' => addslashes($_POST['neditCod']));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $resultado = $apModel->update('UPDATE sgl_ap SET nome_ap=:nome, banda_ap=:banda, color_code_ap=:color_code, ip_ap=:ip WHERE cod_ap=:cod', $data);
                        if ($resultado) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $resultado = $apModel->read("SELECT ap.*, c.cidade_area_atuacao FROM  sgl_ap AS ap INNER JOIN sgl_cidade_area_atuacao AS c ON ap.cod_area_atuacao=c.cod_area_atuacao WHERE ap.cod_ap = :cod", array('cod' => addslashes(trim($cod_ap))));
                            if ($resultado) {
                                $dados['ap'] = $resultado[0];
                            }
                            $_POST = array();
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos.';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações em editar os campos de  uma rede metro e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_redemetro - código do registro no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($cod_redemetro) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "redemetro_editar";
            $redeModel = new redemetro();

            $result = $redeModel->read("SELECT r.*, c.cidade_area_atuacao FROM sgl_redemetro AS r INNER JOIN sgl_cidade_area_atuacao AS c ON r.cod_area_atuacao=c.cod_area_atuacao WHERE r.cod_redemetro=:cod", array('cod' => addslashes(trim($cod_redemetro))));
            if ($result) {
                $dados['redemetro'] = $result[0];
            }
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['neditNome']) || !empty($_POST['neditEstensao'])) {
                    //array que armazena os dados do formulário
                    $data = array("nome" => addslashes(strtoupper($_POST['neditNome'])), "estensao" => addslashes($_POST['neditEstensao']), 'cod' => addslashes($_POST['neditCod']));
                    if (!isset($dados['erro']) && empty($dados['erro'])) {
                        $result = $redeModel->update('UPDATE sgl_redemetro SET nome_redemetro=:nome, estensao_redemetro=:estensao WHERE cod_redemetro=:cod', $data);
                        if ($result) {
                            $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                            $dados['erro']['class'] = 'alert-success';
                            $_POST = array();
                            $result = $redeModel->read("SELECT r.*, c.cidade_area_atuacao FROM sgl_redemetro AS r INNER JOIN sgl_cidade_area_atuacao AS c ON r.cod_area_atuacao=c.cod_area_atuacao WHERE r.cod_redemetro=:cod", array('cod' => addslashes(trim($cod_redemetro))));
                            if ($result) {
                                $dados['redemetro'] = $result[0];
                            }
                        } else {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Foi encontrado um erro na sintaxe SQL!';
                            $dados['erro']['class'] = 'alert-warning';
                        }
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos.';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod_unidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = "unidade_editar";
            $orgaoModel = new orgao();
            $cidadeModel = new cidade();
            $unidadeModel = new unidade();
            $dados['orgaos'] = $orgaoModel->read("SELECT * FROM sgl_orgao ORDER BY nome_orgao ASC", array());
            $dados['cidades'] = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cod_nucleo FROM sgl_cidade_area_atuacao, sgl_ap WHERE sgl_cidade_area_atuacao.cod_area_atuacao=sgl_ap.cod_area_atuacao GROUP BY sgl_cidade_area_atuacao.cod_area_atuacao ORDER BY sgl_cidade_area_atuacao.cod_area_atuacao ASC;", array());
            //array que vai armazena os dados recebido do formulário
            $unidade = array();

            //dados para cláusulas de restrições
            $data = array('cod_unidade' => addslashes(trim($cod_unidade)), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']);
            $resultado_unidade = $unidadeModel->read("SELECT sgl_unidade.*, sgl_orgao.*, sgl_cidade_area_atuacao.* FROM sgl_unidade, sgl_orgao, sgl_cidade_area_atuacao WHERE sgl_unidade.cod_orgao=sgl_orgao.cod_orgao AND sgl_unidade.cod_cidade=sgl_cidade_area_atuacao.cod_area_atuacao AND sgl_unidade.cod_unidade=:cod_unidade AND sgl_cidade_area_atuacao.cod_nucleo=:cod_nucleo", $data);
            if ($resultado_unidade) {
                $resultado_unidade = $resultado_unidade[0];
                $resultado_unidade['data_ativacao_unidade'] = $this->formatDateView($resultado_unidade['data_ativacao_unidade']);

                //consulta contratos
                if ($resultado_unidade['cod_unidade']) {
                    $data = array('cod_unidade' => $resultado_unidade['cod_unidade']);
                    $resultado_contrato = $unidadeModel->read("SELECT sgl_unidade_contrato.* FROM sgl_unidade_contrato, sgl_unidade WHERE sgl_unidade_contrato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade ORDER BY sgl_unidade_contrato.cod_contrato DESC;", $data);
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
                    $resultado_contato = $unidadeModel->read("SELECT sgl_unidade_contato.* FROM sgl_unidade_contato, sgl_unidade WHERE sgl_unidade_contato.cod_unidade=sgl_unidade.cod_unidade AND sgl_unidade.cod_unidade=:cod_unidade ORDER BY sgl_unidade_contato.cod_contato DESC;", $data);
                    if ($resultado_contato) {
                        $resultado_unidade['contatos'] = $resultado_contato;
                    }
                }
                //dados da unidade;
                $dados['unidade'] = $resultado_unidade;
            }

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                /*
                 * ADCIONANDO CÓDIGO DA UNIDADE
                 */
                $unidade['cod_unidade'] = addslashes($_POST['nCodUnidade']);
                //orgão
                $unidade['cod_orgao'] = addslashes($_POST['nOrgao']);
                //cidade
                $unidade['cod_area_atuacao'] = addslashes($_POST['nCidade']);


                if (!empty($_POST['nUnidade']) && isset($_POST['nUnidade'])) {
                    //nome da unidade
                    $unidade['nome_unidade'] = addslashes($_POST['nUnidade']);
                } else {
                    $dados['unidade_erro']['nome']['msg'] = 'Informe a unidade';
                    $dados['unidade_erro']['nome']['class'] = 'has-error';
                }

                if (!empty($_POST['nConexao']) && isset($_POST['nConexao'])) {
                    //conexao
                    $unidade['conexao_unidade'] = addslashes($_POST['nConexao']);
                }

                if (!empty($_POST['nAP']) && isset($_POST['nAP'])) {
                    //ap
                    $unidade['cod_ap'] = addslashes($_POST['nAP']);
                } else {
                    $unidade['cod_ap'] = null;
                }

                if (!empty($_POST['nRedeMetro']) && isset($_POST['nRedeMetro'])) {
                    //redemetro
                    $unidade['cod_redemetro'] = addslashes($_POST['nRedeMetro']);
                } else {
                    $unidade['cod_redemetro'] = null;
                }

                if (!empty($_POST['nIP']) && isset($_POST['nIP'])) {
                    //ip
                    $unidade['ip_unidade'] = addslashes($_POST['nIP']);
                } else {
                    $dados['unidade_erro']['ip']['msg'] = 'Informe o ip';
                    $dados['unidade_erro']['ip']['class'] = 'has-error';
                }

                if (!empty($_POST['nVLAN']) && isset($_POST['nVLAN'])) {
                    //vlan
                    $unidade['nome_vlan_unidade'] = addslashes($_POST['nVLAN']);
                } else {
                    $dados['unidade_erro']['vlan']['msg'] = 'Informe o nome da VLAN';
                    $dados['unidade_erro']['vlan']['class'] = 'has-error';
                }

                if (!empty($_POST['nTagVlan']) && isset($_POST['nTagVlan'])) {
                    //tag_vlan
                    $unidade['tag_vlan_unidade'] = addslashes($_POST['nTagVlan']);
                } else {
                    $dados['unidade_erro']['tag_vlan']['msg'] = 'Informe a TAG VLAN';
                    $dados['unidade_erro']['tag_vlan']['class'] = 'has-error';
                }

                if (!empty($_POST['nBanda']) && isset($_POST['nBanda'])) {
                    //banda
                    $unidade['banda_unidade'] = addslashes($_POST['nBanda']);
                } else {
                    $dados['unidade_erro']['banda']['msg'] = 'Informe o valor da banda';
                    $dados['unidade_erro']['banda']['class'] = 'has-error';
                }

                if (!empty($_POST['nStatus']) && isset($_POST['nStatus'])) {
                    //statu
                    $unidade['statu_unidade'] = addslashes($_POST['nStatus']);
                } else {
                    $dados['unidade_erro']['statu']['msg'] = 'Informe o status';
                    $dados['unidade_erro']['statu']['class'] = 'has-error';
                }

                if (!empty($_POST['nDataAtivacao']) && isset($_POST['nDataAtivacao'])) {
                    //data
                    $unidade['data_ativacao_unidade'] = addslashes($_POST['nDataAtivacao']);
                    if ($unidade['data_ativacao_unidade'] == false) {
                        $dados['unidade_erro']['data']['msg'] = 'DIA/MÊS/ANO';
                        $dados['unidade_erro']['data']['class'] = 'has-error';
                    }
                } else {
                    $dados['unidade_erro']['data']['msg'] = 'Informe a data de ativação';
                    $dados['unidade_erro']['data']['class'] = 'has-error';
                }

                //zabbix
                $unidade['zabbix_unidade'] = addslashes($_POST['nZabbix']);
                //url
                $unidade['url_zabbix_unidade'] = addslashes($_POST['nUrlZabbix']);

                /*
                 * capturando contrato
                 */
                for ($qtd = addslashes($_POST['nQtdContrato']); $qtd >= 1; $qtd--) {
                    if (!empty($_POST['nNumeroContrato' . $qtd]) || !empty($_POST['nTipoContratro' . $qtd]) || !empty($_POST['nDataInicial' . $qtd]) || !empty($_POST['nDataVigencia' . $qtd])) {
                        if (isset($_POST['nCodContrato' . $qtd]) && !empty($_POST['nCodContrato' . $qtd])) {
                            //cod contrato
                            $unidade['contratos'][$qtd]['cod_contrato'] = addslashes(trim($_POST['nCodContrato' . $qtd]));
                        }
                        //cod unidade
                        $unidade['contratos'][$qtd]['cod_unidade'] = $unidade['cod_unidade'];
                        //numero do contrato
                        $unidade['contratos'][$qtd]['numero_contrato'] = addslashes($_POST['nNumeroContrato' . $qtd]);
                        //numero data inicial
                        $unidade['contratos'][$qtd]['nome_contrato'] = addslashes($_POST['nTipoContratro' . $qtd]);
                        //numero data inicial
                        $unidade['contratos'][$qtd]['data_inicial_contrato'] = addslashes($_POST['nDataInicial' . $qtd]);
                        //numero data vigencia
                        $unidade['contratos'][$qtd]['data_vigencia_contrato'] = addslashes($_POST['nDataVigencia' . $qtd]);
                    }
                }
                /*
                 * capturando endereço da unidade
                 */
                $unidade['endereco']['cod_unidade'] = $unidade['cod_unidade'];
                //logradouro
                $unidade['endereco']['logradouro_endereco'] = addslashes($_POST['nLogradouro']);
                //numero
                $unidade['endereco']['numero_endereco'] = addslashes($_POST['nNumero']);
                //bairro
                $unidade['endereco']['bairro_endereco'] = addslashes($_POST['nBairro']);
                //complemento
                $unidade['endereco']['complemento_endereco'] = addslashes($_POST['nComplemento']);
                //latitude
                $unidade['endereco']['latitude_endereco'] = addslashes($_POST['nLatitude']);
                //longitude
                $unidade['endereco']['longitude_endereco'] = addslashes($_POST['nLongitude']);
                //gps
                $unidade['endereco']['gps_endereco'] = addslashes($_POST['nGPS']);

                $unidade['endereco']['cod_endereco'] = addslashes($_POST['nCodEndereco']);
                /*
                 * Capturando contato da unidade
                 */

                for ($qtd = $_POST['nQtdContato']; $qtd >= 1; $qtd--) {
                    if (!empty($_POST['nNome' . $qtd]) || !empty($_POST['nEmail' . $qtd]) || !empty($_POST['nTelefone1_' . $qtd]) || !empty($_POST['nTelefone2_' . $qtd])) {
                        if (isset($_POST['nCodContato' . $qtd]) && !empty($_POST['nCodContato' . $qtd])) {
                            //cod_contato
                            $unidade['contatos'][$qtd]['cod_contato'] = addslashes(trim($_POST['nCodContato' . $qtd]));
                        }
                        $unidade['contatos'][$qtd]['cod_unidade'] = $unidade['cod_unidade'];
                        //gps/
                        $unidade['contatos'][$qtd]['nome_contato'] = addslashes($_POST['nNome' . $qtd]);
                        //email
                        $unidade['contatos'][$qtd]['email_contato'] = addslashes($_POST['nEmail' . $qtd]);
                        //telefone1
                        $unidade['contatos'][$qtd]['telefone1_contato'] = addslashes($_POST['nTelefone1_' . $qtd]);
                        //telefone2
                        $unidade['contatos'][$qtd]['telefone2_contato'] = addslashes($_POST['nTelefone2_' . $qtd]);
                    }
                }
                $dados['unidade'] = $unidade;
                //se todos os campos forem preenchidos
                if (isset($dados['unidade_erro']) && !empty($dados['unidade_erro'])) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                    $dados['erro']['class'] = 'alert-danger';
                } else {
                    if (isset($resultado_unidade['contratos'])) {
                        $unidade['contratos_bd'] = $resultado_unidade['contratos'];
                    }
                    if (isset($resultado_unidade['contatos'])) {
                        $unidade['contatos_bd'] = $resultado_unidade['contatos'];
                    }
                    $unidadeModel->update($unidade);
                    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            }

            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  um usuario e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_usuario - Código do usuario
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod_usuario = array()) {

        if (($this->checkUserPattern() && $cod_usuario == $_SESSION['user_sgl']['cod']) || ($this->checkUserPattern() && $this->checkUserAdministrator())) {
            $view = "usuario_editar";
            $dados = array();
            $cidadeModel = new cidade();
            $usuarioModel = new usuario();
            $result_cidade = $cidadeModel->read("SELECT * FROM sgl_cidade_nucleo ORDER BY cidade_nucleo ", array());
            if ($result_cidade) {
                $dados['cidades_nucleo'] = $result_cidade;
            }
            //pesquisa usuário
            $result_usuario = $usuarioModel->read_specific("SELECT * FROM sgl_usuario WHERE cod_usuario=:cod AND cod_cidade_nucleo=:cod_nucleo", array('cod' => addslashes(trim($cod_usuario)), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']));
            if ($result_usuario) {

                $dados['usuario'] = $result_usuario;

                if (isset($_POST['nSalvar'])) {
                    //codigo
                    $usuario = array('cod_usuario' => addslashes(trim($_POST['nCodUsuario'])));
                    //nome
                    if (!empty($_POST['nNome'])) {
                        $usuario['nome_usuario'] = addslashes($_POST['nNome']);
                    } else {
                        $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                        $dados['usuario_erro']['nome']['class'] = 'has-error';
                    }
                    //sobrenome
                    if (!empty($_POST['nSobrenome'])) {
                        $usuario['sobrenome_usuario'] = addslashes($_POST['nSobrenome']);
                    } else {
                        $dados['usuario_erro']['sobrenome']['msg'] = 'Informe o sobrenome';
                        $dados['usuario_erro']['sobrenome']['class'] = 'has-error';
                    }
                    //sobrenome
                    if (!empty($_POST['nUsuario'])) {
                        $usuario['usuario_usuario'] = addslashes($_POST['nUsuario']);
                        if ($usuarioModel->read_specific('SELECT * FROM sgl_usuario WHERE usuario_usuario=:usuario AND cod_usuario != :cod ', array('usuario' => $usuario['usuario_usuario'], 'cod' => $usuario['cod_usuario']))) {
                            $dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
                            $dados['usuario_erro']['usuario']['class'] = 'has-error';
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível alterar um usuario para um nome de usuário já cadastrado, por favor informe outro nome de usuário';
                            $dados['erro']['class'] = 'alert-danger';
                            $usuario['usuario'] = null;
                        }
                    } else {
                        $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
                        $dados['usuario_erro']['usuario']['class'] = 'has-error';
                    }
                    //senha
                    if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                        //senha
                        if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                            $usuario['senha_usuario'] = addslashes($_POST['nSenha']);
                        } else {
                            $dados['usuario_erro']['senha']['msg'] = "Os campos 'Nova Senha' e 'Repetir Nova Senha' não estão iguais! ";
                            $dados['usuario_erro']['senha']['class'] = 'has-error';
                        }
                    }
                    //nucleo
                    $usuario['cod_cidade_nucleo'] = addslashes($_POST['nNucleo']);
                    //cargo
                    if (!empty($_POST['nCargo'])) {
                        $usuario['cargo_usuario'] = addslashes($_POST['nCargo']);
                    } else {
                        $dados['usuario_info']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
                        $dados['usuario_info']['cargo']['class'] = 'has-warning';
                    }
                    //sexo
                    $usuario['sexo_usuario'] = addslashes($_POST['nSexo']);

                    //nivel de acesso
                    if (!empty($_POST['tNivelDeAcesso'])) {
                        $usuario['statu_admin_usuario'] = addslashes($_POST['tNivelDeAcesso']);
                    } else {
                        $usuario['statu_admin_usuario'] = 0;
                    }
                    //status
                    if (isset($_POST['nStatuUsuario']) && !empty($_POST['nStatuUsuario'])) {
                        $usuario['statu_usuario'] = addslashes($_POST['nStatuUsuario']);
                    } else {
                        $usuario['statu_usuario'] = 0;
                    }


                    //imagem
                    if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
                        $usuario['img_usuario'] = $_FILES['tImagem-1'];
                        $usuario['img_atual'] = $result_usuario['img_usuario'];
                    } else if (!empty($_POST['nImagem-user'])) {
                        $usuario['img_usuario'] = addslashes($_POST['nImagem-user']);
                    } else {
                        $usuario['img_usuario'] = $result_usuario['img_usuario'];
                        $usuario['delete_img'] = true;
                    }

                    if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                        $dados['erro']['class'] = 'alert-danger';
                    } else {
                        $resultado = $usuarioModel->update($usuario);
                        $dados['usuario'] = $resultado;

                        //SE O USUÁRIO EM EDIÇÃO E O MESMO QUE ESTÁ LOGADO NO SITEMA ELE VAI ALTERAR OS DADOS DO USUÁRIO LOGADO
                        if ($cod_usuario == $_SESSION['user_sgl']['cod'] && !empty($resultado)) {
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
                        }

                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
                    }
                }
                $this->loadTemplate($view, $dados);
            } else {
                header('Location: /home');
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de historico da unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_historico - código do historico registrado no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function historico($cod_historico) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $dados = array();
            $view = 'historico_editar';
            $historicoModel = new historico();
            $result_historico = $historicoModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_historico = :cod", array('cod' => addslashes($cod_historico)));
            $result_historico = $result_historico[0];
            if ($result_historico) {
                $result_unidade = $historicoModel->read("SELECT * FROM sgl_unidade WHERE cod_unidade = :cod", array('cod' => $result_historico['cod_unidade']));
                $result_usuario = $historicoModel->read("SELECT cod_usuario, usuario_usuario FROM sgl_usuario WHERE cod_usuario = :cod ", array('cod' => $result_historico['cod_usuario']));
                $historico = array();
                $dados['unidade'] = $result_unidade[0];
                $dados['usuario'] = $result_usuario[0];
                $dados['historico'] = $result_historico;
                if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                    $historico['descricao_historico'] = addslashes(trim($_POST['ncadDescricao']));
                    $historico['cod_historico'] = $result_historico['cod_historico'];
                    if ($historicoModel->update('UPDATE sgl_unidade_historico SET descricao_historico=:descricao_historico WHERE cod_historico=:cod_historico', $historico)) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Alteração realizada com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
                        $dados['historico'] = $historico;
                    }
                }
            } else {
                header("Location: /home");
            }
            $this->loadTemplate($view, $dados);
        }
    }

}
