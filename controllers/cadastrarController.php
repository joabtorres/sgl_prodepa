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
class cadastrarController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é chama a função cidade();
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index() {
        $this->cidade();
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma nova  cidade, seja ela o núcleo ou uma área de representção. 
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidade() {
        $view = "cidade_cadastrar";
        $dados = array();
        $cidadeModel = new cidade();
        $dados['nucleos'] = $cidadeModel->read('SELECT * FROM sgl_cidade_nucleo', array());
        print_r( $dados['nucleos']);
        if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
            //este array vai armazena os valores do formulário;
            $cidade = array();
            if (isset($_POST['ncadCidade']) && !empty($_POST['ncadCidade'])) {
                //CAMPO cidade
                $cidade['cidade'] = addslashes($_POST['ncadCidade']);
                if ($_POST['ncadCategoria'] == 'Núcleo') {
                    $resultado = $cidadeModel->read("SELECT * FROM sgl_cidade_nucleo WHERE cidade_nucleo=:cidade", $cidade);
                    if ($cidadeModel->getNumRows()) {
                        $dados['erro']['msg'] = "Não é possível cadastrar um núcleo duas vezes!";
                        $dados['erro']['class'] = 'alert-danger';
                    }
                    //insert
                    $sql_command = "INSERT INTO sgl_cidade_nucleo (cidade_nucleo) VALUES (:cidade)";
                } else {
                    //campo codigo do  nucleo
                    $cidade['nucleo'] = addslashes($_POST['ncadNucleo']);
                    //verifica se já está cadastrado
                    $resultado = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao WHERE cidade_area_atuacao=:cidade AND cod_nucleo=:nucleo", $cidade);
                    if ($cidadeModel->getNumRows()) {
                        $dados['erro']['msg'] = "Não é possível cadastrar uma cidade duas vezes!";
                        $dados['erro']['class'] = 'alert-danger';
                    }
                    //insert
                    $sql_command = "INSERT INTO sgl_cidade_area_atuacao (cidade_area_atuacao, cod_nucleo) VALUES (:cidade, :nucleo)";
                }
                if (!isset($dados['erro']) && empty($dados['erro']) && $cidadeModel->create($sql_command, $cidade)) {
                    $dados['erro']['msg'] = "Cadastro realizado com sucesso!";
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            } else {
                $dados['erro']['msg'] = "Informe o nome da cidade!";
                $dados['erro']['class'] = 'alert-warning';
            }
        }

        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um orgão e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao() {
        $view = "orgao_cadastrar";
        $dados = array();
        if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
            if (isset($_POST['ncadOrgao']) && !empty($_POST['ncadOrgao'])) {
                //array com os dados do formulário
                $orgaoModel = new orgao();
                $orgao = array("nome" => addslashes($_POST['ncadOrgao']), "categoria" => addslashes($_POST['ncadCategoria']));
                //Verifica se já está cadastrado
                $resultado = $orgaoModel->read("SELECT * FROM sgl_orgao WHERE nome_orgao=:nome AND categoria_orgao=:categoria", $orgao);
                if ($orgaoModel->getNumRows() && count($resultado) > 0) {
                    $dados['erro']['msg'] = "Não é possível cadastrar um orgão duas vezes!";
                    $dados['erro']['class'] = 'alert-danger';
                }
                if (!isset($dados['erro']) && empty($dados['erro']) && $orgaoModel->create("INSERT INTO sgl_orgao (nome_orgao, categoria_orgao) VALUES (:nome, :categoria);", $orgao)) {
                    $dados['erro']['msg'] = "Cadastro realizado com sucesso!";
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            } else {
                $dados['erro']['msg'] = "Informe o nome do orgão!";
                $dados['erro']['class'] = 'alert-warning';
            }
        }

        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um ap em determinada cidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap() {
        $view = "ap_cadastrar";
        $dados = array();
        $cidadeModel = new cidade();
        $dados['cidades'] = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao ORDER BY cidade_area_atuacao ASC;", array());

        if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
            if (!empty($_POST['ncadNome']) || !empty($_POST['ncadIP'])) {
                //array que armazena os dados do formulário
                $ap = array("nome" => addslashes(strtoupper($_POST['ncadNome'])), "ip" => addslashes($_POST['ncadIP']), "cidade" => addslashes($_POST['ncadCidade']));
                //Verifica se já está cadastrado
                $apModel = new ap();
                $resultado = $apModel->read("SELECT * FROM sgl_ap WHERE nome_ap=:nome AND ip_ap=:ip AND cod_area_atuacao=:cidade", $ap);
                if ($apModel->getNumRows() && count($resultado) > 0) {
                    $dados['erro']['msg'] = "Não é possível cadastrar um ap duas vezes!";
                    $dados['erro']['class'] = 'alert-danger';
                }
                if (!isset($dados['erro']) && empty($dados['erro']) && $apModel->create("INSERT INTO sgl_ap (nome_ap, ip_ap,cod_area_atuacao) VALUES (:nome, :ip, :cidade);", $ap)) {
                    $dados['erro']['msg'] = "Cadastro realizado com sucesso!";
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            } else {
                $dados['erro']['msg'] = "Preencha todos os campos.";
                $dados['erro']['class'] = 'alert-warning';
            }
        }

        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma unidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade() {
        $view = "unidade_cadastrar";
        $dados = array();
        $orgaoModel = new orgao();
        $cidadeModel = new cidade();
        $unidadeModel = new unidade();
        $dados['orgaos'] = $orgaoModel->read("SELECT * FROM sgl_orgao ORDER BY nome_orgao ASC", array());
        $dados['cidades'] = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cod_nucleo FROM sgl_cidade_area_atuacao, sgl_ap WHERE sgl_cidade_area_atuacao.cod_area_atuacao=sgl_ap.cod_area_atuacao GROUP BY sgl_cidade_area_atuacao.cod_area_atuacao ORDER BY sgl_cidade_area_atuacao.cod_area_atuacao ASC;", array());

        if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
            //array que vai armazena os dados recebido do formulário
            $unidade = array();
            //orgão
            $unidade['orgao'] = addslashes($_POST['nOrgao']);
            //cidade
            $unidade['cidade'] = addslashes($_POST['nCidade']);

            if (!empty($_POST['nUnidade']) && isset($_POST['nUnidade'])) {
                //nome da unidade
                $unidade['unidade'] = addslashes($_POST['nUnidade']);
            } else {
                $dados['unidade']['nome']['msg'] = 'Informe a unidade';
                $dados['unidade']['nome']['class'] = 'has-error';
            }
            if (!empty($_POST['nIP']) && isset($_POST['nIP'])) {
                //ip
                $unidade['ip'] = addslashes($_POST['nIP']);
            } else {
                $dados['unidade']['ip']['msg'] = 'Informe o ip';
                $dados['unidade']['ip']['class'] = 'has-error';
            }
            if (!empty($_POST['nAP']) && isset($_POST['nAP'])) {
                //ap
                $unidade['ap'] = addslashes($_POST['nAP']);
            } else {
                $unidade['ap'] = null;
            }
            if (!empty($_POST['nIP']) && isset($_POST['nIP'])) {
                //ip
                $unidade['ip'] = addslashes($_POST['nIP']);
            } else {
                $dados['unidade']['ip']['msg'] = 'Informe o ip';
                $dados['unidade']['ip']['class'] = 'has-error';
            }

            if (!empty($_POST['nVLAN']) && isset($_POST['nVLAN'])) {
                //vlan
                $unidade['vlan'] = addslashes($_POST['nVLAN']);
            } else {
                $dados['unidade']['vlan']['msg'] = 'Informe a vlan';
                $dados['unidade']['vlan']['class'] = 'has-error';
            }

            if (!empty($_POST['nConexao']) && isset($_POST['nConexao'])) {
                //conexao
                $unidade['conexao'] = addslashes($_POST['nConexao']);
            }
            if (!empty($_POST['nBanda']) && isset($_POST['nBanda'])) {
                //banda
                $unidade['banda'] = addslashes($_POST['nBanda']);
            } else {
                $dados['unidade']['banda']['msg'] = 'Informe o valor da banda';
                $dados['unidade']['banda']['class'] = 'has-error';
            }
            if (!empty($_POST['nStatus']) && isset($_POST['nStatus'])) {
                //statu
                $unidade['statu'] = addslashes($_POST['nStatus']);
            } else {
                $dados['unidade']['statu']['msg'] = 'Informe o status';
                $dados['unidade']['statu']['class'] = 'has-error';
            }
            if (!empty($_POST['nZabbix']) && isset($_POST['nZabbix'])) {
                //zabbix
                $unidade['zabbix'] = addslashes($_POST['nZabbix']);
            } else {
                $dados['unidade']['zabbix']['msg'] = 'Informe o status no zabbix';
                $dados['unidade']['zabbix']['class'] = 'has-error';
            }
            if (!empty($_POST['nUrlZabbix']) && isset($_POST['nUrlZabbix'])) {
                //url
                $unidade['url'] = addslashes($_POST['nUrlZabbix']);
            } else {
                $dados['unidade']['url']['msg'] = 'Informe a url do zabbix';
                $dados['unidade']['url']['class'] = 'has-error';
            }
            if (!empty($_POST['nDataAtivacao']) && isset($_POST['nDataAtivacao'])) {
                //data
                $unidade['data'] = $this->formatDateBD(addslashes($_POST['nDataAtivacao']));
                if ($unidade['data'] == false) {
                    $dados['unidade']['data']['msg'] = 'DIA/MÊS/ANO';
                    $dados['unidade']['data']['class'] = 'has-error';
                }
            } else {
                $dados['unidade']['data']['msg'] = 'Informe a data de ativação';
                $dados['unidade']['data']['class'] = 'has-error';
            }
            //se todos os campos forem preenchidos
            if (isset($dados['unidade']) && !empty($dados['unidade'])) {
                $dados['erro']['msg'] = "Preencha todos os campos obrigatórios (*).";
                $dados['erro']['class'] = 'alert-danger';
            } else {
                /*
                 * ADCIONANDO CÓDIGO DA UNIDADE
                 */
                $ultimo_codigo = $unidadeModel->read("SELECT MAX(cod_unidade) AS qtd FROM sgl_unidade ORDER BY cod_unidade DESC");
                $unidade['cod'] = ++$ultimo_codigo[0]['qtd'];

                //cadastrar unidade
                if ($unidadeModel->create("INSERT INTO sgl_unidade (cod_unidade, cod_orgao, cod_cidade, nome_unidade, ip_unidade, cod_ap, tag_vlan_unidade, conexao_unidade, banda_unidade, statu_unidade, zabbix_unidade, url_zabbix_unidade, data_ativacao_unidade) VALUES (:cod, :orgao, :cidade, :unidade, :ip, :ap, :vlan, :conexao, :banda, :statu, :zabbix, :url, :data)", $unidade)) {
                    /*
                     * capturando endereço da unidade
                     */

                    $unidade['endereco']['cod'] = $unidade['cod'];
                    //logradouro
                    $unidade['endereco']['logradouro'] = addslashes($_POST['nLogradouro']);
                    //numero
                    $unidade['endereco']['numero'] = addslashes($_POST['nNumero']);
                    //logradouro
                    $unidade['endereco']['bairro'] = addslashes($_POST['nBairro']);
                    //complemento
                    $unidade['endereco']['complemento'] = addslashes($_POST['nComplemento']);
                    //latitude
                    $unidade['endereco']['latitude'] = addslashes($_POST['nLatitude']);
                    //longitude
                    $unidade['endereco']['longitude'] = addslashes($_POST['nLongitude']);
                    //gps
                    $unidade['endereco']['gps'] = addslashes($_POST['nGPS']);

                    //cadastrar endereço da unidade
                    $unidadeModel->create("INSERT INTO sgl_unidade_endereco (cod_unidade, logradouro_endereco, numero_endereco, bairro_endereco, complemento_endereco, latitude_endereco, longitude_endereco, gps_endereco) VALUES (:cod, :logradouro, :numero, :bairro, :complemento, :latitude, :longitude, :gps)", $unidade['endereco']);

                    /*
                     * Capturando contato da unidade
                     */

                    for ($qtd = 1; $qtd <= $_POST['nQtdContato']; $qtd++) {
                        if (!empty($_POST['nNome' . $qtd]) || !empty($_POST['nEmail' . $qtd]) || !empty($_POST['nTelefone1_' . $qtd]) || !empty($_POST['nTelefone2_' . $qtd])) {

                            $unidade['contato']['cod'] = $unidade['cod'];
                            //gps/
                            $unidade['contato']['nome'] = addslashes($_POST['nNome' . $qtd]);
                            //email
                            $unidade['contato']['email'] = addslashes($_POST['nEmail' . $qtd]);
                            //telefone1
                            $unidade['contato']['telefone1'] = addslashes($_POST['nTelefone1_' . $qtd]);
                            //telefone2
                            $unidade['contato']['telefone2'] = addslashes($_POST['nTelefone2_' . $qtd]);
                            $unidadeModel->create("INSERT INTO sgl_unidade_contato (cod_unidade, nome_contato, email_contato, telefone1_contato, telefone2_contato) VALUES (:cod, :nome, :email, :telefone1, :telefone2)", $unidade['contato']);
                        }
                    }
                    $dados['erro']['msg'] = "Cadastro realizado com sucesso!";
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            }
        }
        $this->loadTemplate($view, $dados);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de cadastra usuario e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario() {
        $view = "usuario_cadastrar";
        $dados = array();
        $this->loadTemplate($view, $dados);
    }

}
