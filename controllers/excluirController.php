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
class excluirController extends controller {

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel pelo controlle nas ações em editar os campos de  uma unidade e valida os campus preenchidos via formulário, para posteriormente submete a alteração no banco de dados;
     * @param int $cod_unidade - código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function index($cod) {
        $this->cidade($cod_cidade);
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir uma cidade, todos seus ap's e todos os as unidades atendente. 
     * @param int $cod_cidade - Código da cidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function cidade($cod_cidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $cidadeModel = new cidade();
            $apModel = new ap();
            $redeModel = new redemetro();
            $unidadeModel = new unidade();
            $historicoModel = new historico();

            $result_cidade = $cidadeModel->read('SELECT * FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod_cidade AND cod_nucleo=:cod_nucleo', array('cod_cidade' => addslashes(trim($cod_cidade)), 'cod_nucleo' => $_SESSION['user_sgl']['nucleo']));
            if (isset($result_cidade) && is_array($result_cidade)) {
                foreach ($result_cidade as $cidade) {

                    $result_ap = $apModel->read('SELECT * FROM sgl_ap WHERE cod_area_atuacao=:cod', array('cod' => $cidade['cod_area_atuacao']));
                    if (isset($result_ap) && is_array($result_ap)) {
                        foreach ($result_ap as $ap) {

                            $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_ap=:cod AND cod_cidade=:cod_cidade", array('cod' => $ap['cod_ap'], 'cod_cidade' => $cidade['cod_area_atuacao']));
                            if (isset($result_unidade) && is_array($result_unidade)) {
                                foreach ($result_unidade as $unidade) {

                                    //contrato
                                    $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_contrato) && is_array($result_contrato)) {
                                        foreach ($result_contrato as $contrato) {
                                            //remove registro contrato
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //endereco
                                    $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_endereco) && is_array($result_endereco)) {
                                        foreach ($result_endereco as $endereco) {
                                            //remove registro endereco
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //contato
                                    $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_contato) && is_array($result_contato)) {
                                        foreach ($result_contato as $contato) {
                                            //remove registro contato
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //historico
                                    $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_historico) && is_array($result_historico)) {
                                        foreach ($result_historico as $historico) {
                                            //remove registro historico
                                            $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //removendo registro unidade
                                    $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                                }
                            }
                            //removendo registro ap
                            $apModel->delete('DELETE FROM sgl_ap WHERE cod_ap=:cod', array('cod' => $ap['cod_ap']));
                        }
                    }
                    $result_rede = $redeModel->read('SELECT * FROM sgl_redemetro WHERE cod_area_atuacao=:cod', array('cod' => $cidade['cod_area_atuacao']));
                    if (isset($result_rede) && is_array($result_rede)) {
                        foreach ($result_rede as $redemetro) {


                            $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_redemetro=:cod AND cod_cidade=:cod_cidade", array('cod' => $redemetro['cod_redemetro'], 'cod_cidade' => $cidade['cod_area_atuacao']));
                            if (isset($result_unidade) && is_array($result_unidade)) {
                                foreach ($result_unidade as $unidade) {

                                    //contrato
                                    $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_contrato) && is_array($result_contrato)) {
                                        foreach ($result_contrato as $contrato) {
                                            //remove registro contrato
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //endereco
                                    $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_endereco) && is_array($result_endereco)) {
                                        foreach ($result_endereco as $endereco) {
                                            //remove registro endereco
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //contato
                                    $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_contato) && is_array($result_contato)) {
                                        foreach ($result_contato as $contato) {
                                            //remove registro contato
                                            $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //historico
                                    $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                                    if (isset($result_historico) && is_array($result_historico)) {
                                        foreach ($result_historico as $historico) {
                                            //remove registro historico
                                            $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                                        }
                                    }
                                    //removendo registro unidade
                                    $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                                }
                            }
                            //removendo registro rede metro
                            $redeModel->delete('DELETE FROM sgl_redemetro WHERE cod_redemetro=:cod', array('cod' => $redemetro['cod_redemetro']));
                        }
                    }

                    //removendo registro cidade area de atuacao;
                    $cidadeModel->delete("DELETE FROM sgl_cidade_area_atuacao WHERE cod_area_atuacao=:cod", array('cod' => $cidade['cod_area_atuacao']));
                }
                $url = BASE_URL . '/relatorio/cidades';
                header("Location: $url");
            } else {
                $url = BASE_URL . '/relatorio/cidades';
                header("Location: $url");
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um orgão específico e todos os as unidades. 
     * @param int $cod_orgao - Código da orgão
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function orgao($cod_orgao, $cod_cidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $redeModel = new redemetro();
            $unidadeModel = new unidade();
            $historicoModel = new historico();

            $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_orgao=:cod_orgao AND cod_cidade=:cod_cidade", array('cod_orgao' => addslashes(trim($cod_orgao)), 'cod_cidade' => addslashes(trim($cod_cidade))));
            if (isset($result_unidade) && is_array($result_unidade)) {
                foreach ($result_unidade as $unidade) {

                    //contrato
                    $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_contrato) && is_array($result_contrato)) {
                        foreach ($result_contrato as $contrato) {
                            //remove registro contrato
                            $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //endereco
                    $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_endereco) && is_array($result_endereco)) {
                        foreach ($result_endereco as $endereco) {
                            //remove registro endereco
                            $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //contato
                    $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_contato) && is_array($result_contato)) {
                        foreach ($result_contato as $contato) {
                            //remove registro contato
                            $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //historico
                    $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_historico) && is_array($result_historico)) {
                        foreach ($result_historico as $historico) {
                            //remove registro historico
                            $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //removendo registro unidade
                    $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                }
            }
            $url = BASE_URL . '/relatorio/orgaos';
            header("Location: $url");
        } else {
            $url = BASE_URL . '/relatorio/orgaos';
            header("Location: $url");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um ap específico. 
     * @param int $cod_ap - Código da ap
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function ap($cod_ap) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $apModel = new ap();
            $unidadeModel = new unidade();
            $historicoModel = new historico();
            $result_ap = $apModel->read('SELECT * FROM sgl_ap WHERE cod_ap=:cod', array('cod' => addslashes(trim($cod_ap))));
            if (isset($result_ap) && is_array($result_ap)) {
                foreach ($result_ap as $ap) {

                    $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_ap=:cod AND cod_cidade=:cod_cidade", array('cod' => $ap['cod_ap'], 'cod_cidade' => $ap['cod_area_atuacao']));
                    if (isset($result_unidade) && is_array($result_unidade)) {
                        foreach ($result_unidade as $unidade) {

                            //contrato
                            $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_contrato) && is_array($result_contrato)) {
                                foreach ($result_contrato as $contrato) {
                                    //remove registro contrato
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //endereco
                            $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_endereco) && is_array($result_endereco)) {
                                foreach ($result_endereco as $endereco) {
                                    //remove registro endereco
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //contato
                            $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_contato) && is_array($result_contato)) {
                                foreach ($result_contato as $contato) {
                                    //remove registro contato
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //historico
                            $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_historico) && is_array($result_historico)) {
                                foreach ($result_historico as $historico) {
                                    //remove registro historico
                                    $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //removendo registro unidade
                            $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                        }
                    }
                    //removendo registro ap
                    $apModel->delete('DELETE FROM sgl_ap WHERE cod_ap=:cod', array('cod' => $ap['cod_ap']));
                }
                $url = BASE_URL . '/relatorio/aps';
                header("Location: $url");
            } else {
                $url = BASE_URL . '/relatorio/aps';
                header("Location: $url");
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir uma redemetro específica. 
     * @param int $cod_redemetro - codigo registrado no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function redemetro($cod_redemetro) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $redeModel = new redemetro();
            $unidadeModel = new unidade();
            $historicoModel = new historico();
            $result_rede = $redeModel->read('SELECT * FROM sgl_redemetro WHERE cod_redemetro=:cod', array('cod' => addslashes(trim($cod_redemetro))));
            if (isset($result_rede) && is_array($result_rede)) {
                foreach ($result_rede as $redemetro) {


                    $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_redemetro=:cod AND cod_cidade=:cod_cidade", array('cod' => $redemetro['cod_redemetro'], 'cod_cidade' => $redemetro['cod_area_atuacao']));
                    if (isset($result_unidade) && is_array($result_unidade)) {
                        foreach ($result_unidade as $unidade) {

                            //contrato
                            $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_contrato) && is_array($result_contrato)) {
                                foreach ($result_contrato as $contrato) {
                                    //remove registro contrato
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //endereco
                            $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_endereco) && is_array($result_endereco)) {
                                foreach ($result_endereco as $endereco) {
                                    //remove registro endereco
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //contato
                            $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_contato) && is_array($result_contato)) {
                                foreach ($result_contato as $contato) {
                                    //remove registro contato
                                    $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //historico
                            $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                            if (isset($result_historico) && is_array($result_historico)) {
                                foreach ($result_historico as $historico) {
                                    //remove registro historico
                                    $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                                }
                            }
                            //removendo registro unidade
                            $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                        }
                    }
                    //removendo registro rede metro
                    $redeModel->delete('DELETE FROM sgl_redemetro WHERE cod_redemetro=:cod', array('cod' => $redemetro['cod_redemetro']));
                }
                $url = BASE_URL . '/relatorio/redemetro';
                header("Location: $url");
            } else {
                $url = BASE_URL . '/relatorio/redemetro';
                header("Location: $url");
            }
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir uma unidade específico.
     * @param int $cod_unidade - Código da unidade
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function unidade($cod_unidade) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $redeModel = new redemetro();
            $unidadeModel = new unidade();
            $historicoModel = new historico();

            $result_unidade = $unidadeModel->read("SELECT * FROM sgl_unidade WHERE cod_unidade=:cod", array('cod' => addslashes(trim($cod_unidade))));
            if (isset($result_unidade) && is_array($result_unidade)) {
                foreach ($result_unidade as $unidade) {

                    //contrato
                    $result_contrato = $unidadeModel->read("SELECT * FROM sgl_unidade_contrato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_contrato) && is_array($result_contrato)) {
                        foreach ($result_contrato as $contrato) {
                            //remove registro contrato
                            $unidadeModel->delete("DELETE FROM sgl_unidade_contrato WHERE cod_contrato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contrato['cod_contrato'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //endereco
                    $result_endereco = $unidadeModel->read("SELECT * FROM sgl_unidade_endereco WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_endereco) && is_array($result_endereco)) {
                        foreach ($result_endereco as $endereco) {
                            //remove registro endereco
                            $unidadeModel->delete("DELETE FROM sgl_unidade_endereco WHERE cod_endereco=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $endereco['cod_endereco'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //contato
                    $result_contato = $unidadeModel->read("SELECT * FROM sgl_unidade_contato WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_contato) && is_array($result_contato)) {
                        foreach ($result_contato as $contato) {
                            //remove registro contato
                            $unidadeModel->delete("DELETE FROM sgl_unidade_contato WHERE cod_contato=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $contato['cod_contato'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //historico
                    $result_historico = $unidadeModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_unidade=:cod", array('cod' => $unidade['cod_unidade']));
                    if (isset($result_historico) && is_array($result_historico)) {
                        foreach ($result_historico as $historico) {
                            //remove registro historico
                            $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod AND cod_unidade=:cod_unidade ;", array('cod' => $historico['cod_historico'], 'cod_unidade' => $unidade['cod_unidade']));
                        }
                    }
                    //removendo registro unidade
                    $unidadeModel->delete('DELETE FROM sgl_unidade WHERE cod_unidade=:cod', array('cod' => $unidade['cod_unidade']));
                }
            }
            $url = BASE_URL . '/relatorio/unidades';
                header("Location: $url");
        } else {
            $url = BASE_URL . '/relatorio/unidades';
                header("Location: $url");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um usuario específico.
     * @param int $cod_usuario - Código do usuario
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function usuario($cod_usuario) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $usuarioModel = new usuario();
            $historicoModel = new historico();
            $resultUsuario = $usuarioModel->read("SELECT * FROM sgl_usuario WHERE cod_usuario=:cod", array('cod' => addslashes(trim($cod_usuario))));
            if ($usuarioModel->getNumRows() && is_array($resultUsuario)) {
                foreach ($resultUsuario as $usuario) {
                    $result_historico = $historicoModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_usuario=:cod", array('cod' => $usuario['cod_usuario']));
                    if (isset($result_historico) && is_array($result_historico)) {
                        foreach ($result_historico as $historico) {
                            //remove registro historico
                            $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod", array('cod' => $historico['cod_historico']));
                        }
                    }
                }
                $usuarioModel->delete(array('cod_usuario' => $usuario['cod_usuario']));
            }
            $url = BASE_URL . '/usuario/index';
            header("Location: $url");
        }
    }

    /**
     * Está função pertence a uma action do controle MVC, ela é responśavel para excluir um historico de unidade específico.
     * @param int $cod_historico - código do histórico registrado no banco
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function historico($cod_historico) {
        if ($this->checkUserPattern() && $this->checkUserAdministrator()) {
            $historicoModel = new historico();
            $result = $historicoModel->read("SELECT * FROM sgl_unidade_historico WHERE cod_historico=:cod", array('cod' => addslashes(trim($cod_historico))));
            $result = $result[0];
            if ($result) {
                $historicoModel->delete("DELETE FROM sgl_unidade_historico WHERE cod_historico=:cod", array('cod' => $result['cod_historico']));
            }
            $url = BASE_URL."/unidade/index/" . $result['cod_unidade'];
            header("Location: $url");
        }
    }

}