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
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "cidade_cadastrar";
            $dados = array();
            $cidadeModel = new cidade();
            $dados['nucleos'] = $cidadeModel->read('SELECT * FROM sgl_cidade_nucleo', array());
            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                //este array vai armazena os valores do formulário;
                $cidade = array();
                if (isset($_POST['ncadCidade']) && !empty($_POST['ncadCidade'])) {
                    //CAMPO cidade
                    $cidade['cidade'] = addslashes($_POST['ncadCidade']);
                    if ($_POST['ncadCategoria'] == 'Núcleo') {
                        $resultado = $cidadeModel->read("SELECT * FROM sgl_cidade_nucleo WHERE cidade_nucleo=:cidade", $cidade);
                        if ($cidadeModel->getNumRows()) {
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um núcleo duas vezes!';
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
                            $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar uma cidade duas vezes!';
                            $dados['erro']['class'] = 'alert-danger';
                        }
                        //insert
                        $sql_command = "INSERT INTO sgl_cidade_area_atuacao (cidade_area_atuacao, cod_nucleo) VALUES (:cidade, :nucleo)";
                    }
                    if (!isset($dados['erro']) && empty($dados['erro']) && $cidadeModel->create($sql_command, $cidade)) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
                    }
                } else {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Informe o nome da cidade!';
                    $dados['erro']['class'] = 'alert-warning';
                }
            }
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um orgão e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao() {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
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
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um orgão duas vezes!';
                        $dados['erro']['class'] = 'alert-danger';
                    }
                    if (!isset($dados['erro']) && empty($dados['erro']) && $orgaoModel->create("INSERT INTO sgl_orgao (nome_orgao, categoria_orgao) VALUES (:nome, :categoria);", $orgao)) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
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
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra um ap em determinada cidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap() {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "ap_cadastrar";
            $dados = array();
            $cidadeModel = new cidade();
            $dados['cidades'] = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao ORDER BY cidade_area_atuacao ASC;", array());

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['ncadNome']) || !empty($_POST['ncadBanda']) || !empty($_POST['ncadCCode']) || !empty($_POST['ncadIP'])) {
                    //array que armazena os dados do formulário
                    $ap = array("cidade" => addslashes($_POST['ncadCidade']), "nome" => addslashes(strtoupper($_POST['ncadNome'])), "banda" => addslashes($_POST['ncadBanda']), "color_code" => addslashes($_POST['ncadCCode']), "ip" => addslashes($_POST['ncadIP']));
                    //Verifica se já está cadastrado
                    $apModel = new ap();
                    $resultado = $apModel->read("SELECT * FROM sgl_ap WHERE nome_ap=:nome AND ip_ap=:ip AND cod_area_atuacao=:cidade AND color_code_ap=:color_code AND banda_ap=:banda", $ap);
                    if ($apModel->getNumRows() && count($resultado) > 0) {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um ap duas vezes!';
                        $dados['erro']['class'] = 'alert-danger';
                    }
                    if (!isset($dados['erro']) && empty($dados['erro']) && $apModel->create("INSERT INTO sgl_ap (cod_area_atuacao,nome_ap,banda_ap,color_code_ap,ip_ap) VALUES (:cidade, :nome, :banda, :color_code, :ip);", $ap)) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
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
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma rede metro em determinada cidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro() {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "redemetro_cadastrar";
            $dados = array();
            $cidadeModel = new cidade();
            $dados['cidades'] = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao ORDER BY cidade_area_atuacao ASC;", array());

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                if (!empty($_POST['ncadNome']) || !empty($_POST['ncadEstensao'])) {
                    //array que armazena os dados do formulário
                    $redemetro = array("nome" => addslashes(strtoupper($_POST['ncadNome'])), "estensao" => addslashes($_POST['ncadEstensao']), "cidade" => addslashes($_POST['ncadCidade']));
                    //Verifica se já está cadastrado
                    $redeModel = new redemetro();
                    $resultado = $redeModel->read("SELECT * FROM sgl_redemetro WHERE nome_redemetro=:nome AND nome_redemetro=:estensao AND cod_area_atuacao=:cidade", $redemetro);
                    if ($redeModel->getNumRows() && count($resultado) > 0) {
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar uma rede metro duas vezes!';
                        $dados['erro']['class'] = 'alert-danger';
                    }
                    if (!isset($dados['erro']) && empty($dados['erro']) && $redeModel->create("INSERT INTO sgl_redemetro (nome_redemetro, estensao_redemetro,cod_area_atuacao) VALUES (:nome, :estensao, :cidade);", $redemetro)) {
                        $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                        $dados['erro']['class'] = 'alert-success';
                        $_POST = array();
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
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra uma unidade e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade() {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "unidade_cadastrar";
            $dados = array();
            $orgaoModel = new orgao();
            $cidadeModel = new cidade();
            $unidadeModel = new unidade();
            $dados['orgaos'] = $orgaoModel->read("SELECT * FROM sgl_orgao ORDER BY nome_orgao ASC", array());
            $dados['cidades'] = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cod_nucleo FROM sgl_cidade_area_atuacao, sgl_ap WHERE sgl_cidade_area_atuacao.cod_area_atuacao=sgl_ap.cod_area_atuacao GROUP BY sgl_cidade_area_atuacao.cod_area_atuacao ORDER BY sgl_cidade_area_atuacao.cod_area_atuacao ASC;", array());
            //array que vai armazena os dados recebido do formulário
            $unidade = array();

            if (isset($_POST['nSalvar']) && !empty($_POST['nSalvar'])) {
                /*
                 * ADCIONANDO CÓDIGO DA UNIDADE
                 */
                $ultimo_codigo = $unidadeModel->read("SELECT MAX(cod_unidade) AS qtd FROM sgl_unidade ORDER BY cod_unidade DESC");
                $unidade['cod'] = ++$ultimo_codigo[0]['qtd'];
                //orgão
                $unidade['orgao'] = addslashes($_POST['nOrgao']);
                //cidade
                $unidade['cidade'] = addslashes($_POST['nCidade']);


                if (!empty($_POST['nUnidade']) && isset($_POST['nUnidade'])) {
                    //nome da unidade
                    $unidade['unidade'] = addslashes($_POST['nUnidade']);
                } else {
                    $dados['unidade_erro']['nome']['msg'] = 'Informe a unidade';
                    $dados['unidade_erro']['nome']['class'] = 'has-error';
                }

                if (!empty($_POST['nConexao']) && isset($_POST['nConexao'])) {
                    //conexao
                    $unidade['conexao'] = addslashes($_POST['nConexao']);
                }

                if (!empty($_POST['nAP']) && isset($_POST['nAP'])) {
                    //ap
                    $unidade['ap'] = addslashes($_POST['nAP']);
                } else {
                    $unidade['ap'] = null;
                }

                if (!empty($_POST['nRedeMetro']) && isset($_POST['nRedeMetro'])) {
                    //redemetro
                    $unidade['redemetro'] = addslashes($_POST['nRedeMetro']);
                } else {
                    $unidade['redemetro'] = null;
                }

                if (!empty($_POST['nIP']) && isset($_POST['nIP'])) {
                    //ip
                    $unidade['ip'] = addslashes($_POST['nIP']);
                } else {
                    $dados['unidade_erro']['ip']['msg'] = 'Informe o ip';
                    $dados['unidade_erro']['ip']['class'] = 'has-error';
                }

                if (!empty($_POST['nVLAN']) && isset($_POST['nVLAN'])) {
                    //vlan
                    $unidade['vlan'] = addslashes($_POST['nVLAN']);
                } else {
                    $dados['unidade_erro']['vlan']['msg'] = 'Informe o nome da VLAN';
                    $dados['unidade_erro']['vlan']['class'] = 'has-error';
                }

                if (!empty($_POST['nTagVlan']) && isset($_POST['nTagVlan'])) {
                    //tag_vlan
                    $unidade['tag_vlan'] = addslashes($_POST['nTagVlan']);
                } else {
                    $dados['unidade_erro']['tag_vlan']['msg'] = 'Informe a TAG VLAN';
                    $dados['unidade_erro']['tag_vlan']['class'] = 'has-error';
                }

                if (!empty($_POST['nBanda']) && isset($_POST['nBanda'])) {
                    //banda
                    $unidade['banda'] = addslashes($_POST['nBanda']);
                } else {
                    $dados['unidade_erro']['banda']['msg'] = 'Informe o valor da banda';
                    $dados['unidade_erro']['banda']['class'] = 'has-error';
                }

                if (!empty($_POST['nStatus']) && isset($_POST['nStatus'])) {
                    //statu
                    $unidade['statu'] = addslashes($_POST['nStatus']);
                } else {
                    $dados['unidade_erro']['statu']['msg'] = 'Informe o status';
                    $dados['unidade_erro']['statu']['class'] = 'has-error';
                }

                if (!empty($_POST['nDataAtivacao']) && isset($_POST['nDataAtivacao'])) {
                    //data
                    $unidade['data'] = addslashes($_POST['nDataAtivacao']);
                    if ($unidade['data'] == false) {
                        $dados['unidade_erro']['data']['msg'] = 'DIA/MÊS/ANO';
                        $dados['unidade_erro']['data']['class'] = 'has-error';
                    }
                } else {
                    $dados['unidade_erro']['data']['msg'] = 'Informe a data de ativação';
                    $dados['unidade_erro']['data']['class'] = 'has-error';
                }

                //zabbix
                $unidade['zabbix'] = addslashes($_POST['nZabbix']);
                //url
                $unidade['url'] = addslashes($_POST['nUrlZabbix']);

                /*
                 * capturando contrato
                 */
                for ($qtd = addslashes($_POST['nQtdContrato']); $qtd >= 1; $qtd--) {
                    if (!empty($_POST['nNumeroContrato' . $qtd]) || !empty($_POST['nTipoContratro' . $qtd]) || !empty($_POST['nDataInicial' . $qtd]) || !empty($_POST['nDataVigencia' . $qtd])) {
                        //cod unidade
                        $unidade['contratos'][$qtd]['cod'] = $unidade['cod'];
                        //numero do contrato
                        $unidade['contratos'][$qtd]['numero'] = addslashes($_POST['nNumeroContrato' . $qtd]);
                        //numero data inicial
                        $unidade['contratos'][$qtd]['tipocontrato'] = addslashes($_POST['nTipoContratro' . $qtd]);
                        //numero data inicial
                        $unidade['contratos'][$qtd]['data_inicial'] = addslashes($_POST['nDataInicial' . $qtd]);
                        //numero data vigencia
                        $unidade['contratos'][$qtd]['data_vigencia'] = addslashes($_POST['nDataVigencia' . $qtd]);
                    }
                }
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

                /*
                 * Capturando contato da unidade
                 */

                for ($qtd = $_POST['nQtdContato']; $qtd >= 1; $qtd--) {
                    if (!empty($_POST['nNome' . $qtd]) || !empty($_POST['nEmail' . $qtd]) || !empty($_POST['nTelefone1_' . $qtd]) || !empty($_POST['nTelefone2_' . $qtd])) {

                        $unidade['contato'][$qtd]['cod'] = $unidade['cod'];
                        //gps/
                        $unidade['contato'][$qtd]['nome'] = addslashes($_POST['nNome' . $qtd]);
                        //email
                        $unidade['contato'][$qtd]['email'] = addslashes($_POST['nEmail' . $qtd]);
                        //telefone1
                        $unidade['contato'][$qtd]['telefone1'] = addslashes($_POST['nTelefone1_' . $qtd]);
                        //telefone2
                        $unidade['contato'][$qtd]['telefone2'] = addslashes($_POST['nTelefone2_' . $qtd]);
                    }
                }


                //se todos os campos forem preenchidos
                if (isset($dados['unidade_erro']) && !empty($dados['unidade_erro'])) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                    $dados['erro']['class'] = 'alert-danger';
                } else {
                    $unidadeModel->create($unidade);
                    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                    $unidade = array();
                }
            }
            $dados['unidade'] = $unidade;
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controle nas ações de cadastra usuario e valida os campus preenchidos via formulário.
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario() {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $view = "usuario_cadastrar";
            $dados = array();
            $cidadeModel = new cidade();
            $usuarioModel = new usuario();
            $dados['cidades_nucleo'] = $cidadeModel->read("SELECT * FROM sgl_cidade_nucleo ORDER BY cidade_nucleo ", array());

            //Array que vai armazena os dados do usuário;
            $usuario = array();
            if (isset($_POST['nSalvar'])) {
                //nome
                if (!empty($_POST['nNome'])) {
                    $usuario['nome'] = addslashes($_POST['nNome']);
                } else {
                    $dados['usuario_erro']['nome']['msg'] = 'Informe o nome';
                    $dados['usuario_erro']['nome']['class'] = 'has-error';
                }
                //sobrenome
                if (!empty($_POST['nSobrenome'])) {
                    $usuario['sobrenome'] = addslashes($_POST['nSobrenome']);
                } else {
                    $dados['usuario_erro']['sobrenome']['msg'] = 'Informe o sobrenome';
                    $dados['usuario_erro']['sobrenome']['class'] = 'has-error';
                }
                //sobrenome
                if (!empty($_POST['nUsuario'])) {
                    $usuario['usuario'] = addslashes($_POST['nUsuario']);
                    if ($usuarioModel->read_specific('SELECT * FROM sgl_usuario WHERE usuario_usuario=:usuario', array('usuario' => $usuario['usuario']))) {
                        $dados['usuario_erro']['usuario']['msg'] = 'usuário já cadastrado';
                        $dados['usuario_erro']['usuario']['class'] = 'has-error';
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um usuario já cadastrado, por favor informe outro nome de usuário';
                        $dados['erro']['class'] = 'alert-danger';
                        $usuario['usuario'] = null;
                    }
                } else {
                    $dados['usuario_erro']['usuario']['msg'] = 'Informe o usuário';
                    $dados['usuario_erro']['usuario']['class'] = 'has-error';
                }
                //email
                if (!empty($_POST['nEmail'])) {
                    $usuario['email'] = addslashes($_POST['nEmail']);
                    if ($usuarioModel->read_specific('SELECT * FROM sgl_usuario WHERE email_usuario=:email', array('email' => $usuario['email']))) {
                        $dados['usuario_erro']['email']['msg'] = 'E-mail já cadastrado';
                        $dados['usuario_erro']['email']['class'] = 'has-error';
                        $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Não é possível cadastrar um e-mail já cadastrado, por favor informe outro endereço de e-mail';
                        $dados['erro']['class'] = 'alert-danger';
                        $usuario['email'] = null;
                    }
                } else {
                    $dados['usuario_erro']['email']['msg'] = 'Informe o e-mail';
                    $dados['usuario_erro']['email']['class'] = 'has-error';
                }
                //email
                if (!empty($_POST['nSenha']) && !empty($_POST['nRepetirSenha'])) {
                    //senha
                    if ($_POST['nSenha'] == $_POST['nRepetirSenha']) {
                        $usuario['senha'] = $_POST['nSenha'];
                    } else {
                        $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' não estão iguais! ";
                        $dados['usuario_erro']['senha']['class'] = 'has-error';
                    }
                } else {
                    $dados['usuario_erro']['senha']['msg'] = "Os campos 'Senha' e 'Repetir Senha' devem ser preenchidos";
                    $dados['usuario_erro']['senha']['class'] = 'has-error';
                }
                //nucleo
                $usuario['nucleo'] = addslashes($_POST['nNucleo']);
                //cargo
                if (!empty($_POST['nCargo'])) {
                    $usuario['cargo'] = addslashes($_POST['nCargo']);
                } else {
                    $dados['usuario_erro']['cargo']['msg'] = 'Informe o cargo, senão não será exibido o cargo';
                    $dados['usuario_erro']['cargo']['class'] = 'has-warning';
                }
                //sexo
                $usuario['sexo'] = addslashes($_POST['nSexo']);

                //nivel de acesso
                $usuario['nivel'] = addslashes($_POST['tNivelDeAcesso']);

                //imagem
                if (isset($_FILES['tImagem-1']) && $_FILES['tImagem-1']['error'] == 0) {
                    $usuario['imagem'] = $_FILES['tImagem-1'];
                }
                if (isset($dados['usuario_erro']) && !empty($dados['usuario_erro'])) {
                    $dados['erro']['msg'] = '<i class="fa fa-info-circle" aria-hidden="true"></i> Preencha todos os campos obrigatórios (*).';
                    $dados['erro']['class'] = 'alert-danger';
                } else {
                    $usuarioModel->create($usuario);
                    $dados['erro']['msg'] = '<i class="fa fa-check" aria-hidden="true"></i> Cadastro realizado com sucesso!';
                    $dados['erro']['class'] = 'alert-success';
                    $_POST = array();
                }
            }
            $dados['usuario'] = $usuario;
            $this->loadTemplate($view, $dados);
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações de cadastra históricos de unidade e valida os campus preenchidos via formulário.
     * @access public
     * @param int $cod_unidade - código da unidade registrada no banco
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function historico($cod_unidade) {
        if($this->checkUserPattern()){
            
        }
    }

}
