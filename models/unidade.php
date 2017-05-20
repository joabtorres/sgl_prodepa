<?php

/**
 * A classe 'unidade' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe unidade
 */
class unidade extends model {

    /**
     * String $numRows - referente q quantidade de linhas obtidas no select;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private $numRows;

    /**
     * Está função tem como objetivo retorna a quantidade de registro encontrados armazenados na variavel $numRows
     * @access public
     * @return int
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function getNumRows() {
        return $this->numRows;
    }

    /**
     * Está função é responsável para cadastrar novos registros;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($data) {
        try {
            $sql = $this->db->prepare('INSERT INTO sgl_unidade (cod_unidade, cod_orgao, cod_cidade, cod_ap, cod_redemetro, nome_unidade, ip_unidade, nome_vlan_unidade, tag_vlan_unidade, conexao_unidade, banda_unidade, statu_unidade, zabbix_unidade, url_zabbix_unidade, data_ativacao_unidade) VALUES (:cod, :orgao, :cidade, :ap, :redemetro, :unidade, :ip, :vlan, :tag_vlan, :conexao, :banda, :statu, :zabbix, :url, :data_ativacao);');
            $sql->bindValue(':cod', $data['cod']);
            $sql->bindValue(':orgao', $data['orgao']);
            $sql->bindValue(':cidade', $data['cidade']);
            $sql->bindValue(':ap', $data['ap']);
            $sql->bindValue(':redemetro', $data['redemetro']);
            $sql->bindValue(':unidade', $data['unidade']);
            $sql->bindValue(':ip', $data['ip']);
            $sql->bindValue(':vlan', $data['vlan']);
            $sql->bindValue(':tag_vlan', $data['tag_vlan']);
            $sql->bindValue(':conexao', $data['conexao']);
            $sql->bindValue(':banda', $data['banda']);
            $sql->bindValue(':statu', $data['statu']);
            $sql->bindValue(':zabbix', $data['zabbix']);
            $sql->bindValue(':url', $data['url']);
            $sql->bindValue(':data_ativacao', $this->formatDateBD($data['data']));
            $sql->execute();

            if ($this->read("SELECT cod_unidade FROM sgl_unidade WHERE cod_unidade  = :cod ORDER BY cod_unidade DESC", array('cod' => $data['cod']))) {
                //CADASTRAR CONTRATO
                if (!empty($data['contratos'])) {
                    foreach ($data['contratos'] as $contrato) {
                        $sql = $this->db->prepare('INSERT INTO sgl_unidade_contrato (cod_unidade, numero_contrato, nome_contrato, data_inicial_contrato, data_vigencia_contrato) VALUES (?, ?, ?, ?, ?); ');
                        $sql->bindValue(1, $contrato['cod']);
                        $sql->bindValue(2, $contrato['numero']);
                        $sql->bindValue(3, $contrato['tipocontrato']);
                        $sql->bindValue(4, $this->formatDateBD($contrato['data_inicial']));
                        $sql->bindValue(5, $this->formatDateBD($contrato['data_vigencia']));
                        $sql->execute();
                    }
                }
                //cadastrar endereco
                $sql = $this->db->prepare('INSERT INTO sgl_unidade_endereco (cod_unidade, logradouro_endereco, numero_endereco, bairro_endereco, complemento_endereco, latitude_endereco, longitude_endereco, gps_endereco) VALUES (:cod, :logradouro, :numero, :bairro, :complemento, :latitude, :longitude, :gps)');
                foreach ($data['endereco'] as $indice => $valor) {
                    $sql->bindValue(":" . $indice, $valor);
                }
                $sql->execute();
                //CADASTRAR CONTATO
                if (!empty($data['contato'])) {
                    foreach ($data['contato'] as $contato) {
                        $sql = $this->db->prepare('INSERT INTO sgl_unidade_contato (cod_unidade, nome_contato, email_contato, telefone1_contato, telefone2_contato) VALUES (?, ?, ?, ?, ?);');
                        $sql->bindValue(1, $contato['cod']);
                        $sql->bindValue(2, $contato['nome']);
                        $sql->bindValue(3, $contato['email']);
                        $sql->bindValue(4, $contato['telefone1']);
                        $sql->bindValue(5, $contato['telefone2']);
                        $sql->execute();
                    }
                }
            }
            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    /**
     * Está função é responsável para consultas no banco e retorna os resultados obtidos;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return array $sql->fetchAll() [caso encontre] | bollean FALSE [caso contrário] 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function read($sql_command, $data = array()) {
        if (!empty($data)) {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
        } else {
            $sql = $this->db->query($sql_command);
        }
        if ($sql->rowCount() > 0) {
            $this->numRows = $sql->rowCount();
            return $sql->fetchAll();
        } else {
            $this->numRows = 0;
            return FALSE;
        }
    }

    /**
     * Está função é responsável para altera um registro específico;
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return bollean TRUE ou FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function update($data) {
        try {
            $sql = $this->db->prepare('UPDATE sgl_unidade SET cod_unidade=:cod_unidade, cod_orgao=:cod_orgao, cod_cidade=:cod_cidade, cod_ap=:cod_ap, cod_redemetro=:cod_redemetro, nome_unidade=:nome_unidade, ip_unidade=:ip_unidade, nome_vlan_unidade=:nome_vlan_unidade, tag_vlan_unidade=:tag_vlan_unidade, conexao_unidade=:conexao_unidade, banda_unidade=:banda_unidade, statu_unidade=:statu_unidade, zabbix_unidade=:zabbix_unidade, url_zabbix_unidade=:url_zabbix_unidade, data_ativacao_unidade=:data_ativacao_unidade WHERE cod_unidade=:cod_unidade;');
            $sql->bindValue(':cod_unidade', $data['cod_unidade']);
            $sql->bindValue(':cod_orgao', $data['cod_orgao']);
            $sql->bindValue(':cod_cidade', $data['cod_area_atuacao']);
            $sql->bindValue(':cod_ap', $data['cod_ap']);
            $sql->bindValue(':cod_redemetro', $data['cod_redemetro']);
            $sql->bindValue(':nome_unidade', $data['nome_unidade']);
            $sql->bindValue(':ip_unidade', $data['ip_unidade']);
            $sql->bindValue(':nome_vlan_unidade', $data['nome_vlan_unidade']);
            $sql->bindValue(':tag_vlan_unidade', $data['tag_vlan_unidade']);
            $sql->bindValue(':conexao_unidade', $data['conexao_unidade']);
            $sql->bindValue(':banda_unidade', $data['banda_unidade']);
            $sql->bindValue(':statu_unidade', $data['statu_unidade']);
            $sql->bindValue(':zabbix_unidade', $data['zabbix_unidade']);
            $sql->bindValue(':url_zabbix_unidade', $data['url_zabbix_unidade']);
            $sql->bindValue(':data_ativacao_unidade', $this->formatDateBD($data['data_ativacao_unidade']));
            $sql->bindValue(':cod_unidade', $data['cod_unidade']);
            $sql->execute();


            //CADASTRAR,ALTERAR,DELETA CONTRATO
            if (!empty($data['contratos'])) {
                foreach ($data['contratos'] as $contrato) {
                    if (isset($contrato['cod_contrato'])) {
                        $sql = $this->db->prepare('UPDATE sgl_unidade_contrato SET cod_unidade = ?, numero_contrato = ?, nome_contrato = ?, data_inicial_contrato = ? , data_vigencia_contrato = ? WHERE cod_contrato = ?');
                        $sql->bindValue(1, $data['cod_unidade']);
                        $sql->bindValue(2, $contrato['numero_contrato']);
                        $sql->bindValue(3, $contrato['nome_contrato']);
                        $sql->bindValue(4, $this->formatDateBD($contrato['data_inicial_contrato']));
                        $sql->bindValue(5, $this->formatDateBD($contrato['data_vigencia_contrato']));
                        $sql->bindValue(6, $contrato['cod_contrato']);
                        $sql->execute();
                    } else {
                        $sql = $this->db->prepare('INSERT INTO sgl_unidade_contrato (cod_unidade, numero_contrato, nome_contrato, data_inicial_contrato, data_vigencia_contrato) VALUES (?, ?, ?, ?, ?); ');
                        $sql->bindValue(1, $data['cod_unidade']);
                        $sql->bindValue(2, $contrato['numero_contrato']);
                        $sql->bindValue(3, $contrato['nome_contrato']);
                        $sql->bindValue(4, $this->formatDateBD($contrato['data_inicial_contrato']));
                        $sql->bindValue(5, $this->formatDateBD($contrato['data_vigencia_contrato']));
                        $sql->execute();
                    }
                }

                //váriavel $cod_form_atual - armazena todos os codigos de contratos passado pelo formulário atualmente;
                $cod_form_atual = array();
                foreach ($data['contratos'] as $contrato) {
                    if (isset($contrato['cod_contrato'])) {
                        $cod_form_atual[] = $contrato['cod_contrato'];
                    }
                }

                //váriavel $cod_contrato_atual - armazena todos os codigos de contratos armazenados no banco;
                $cod_bd_atual = array();
                if ($data['contratos_bd']) {
                    foreach ($data['contratos_bd'] as $contrato) {
                        if ($contrato['cod_contrato']) {
                            $cod_bd_atual[] = $contrato['cod_contrato'];
                        }
                    }
                }

                //verificar qual os dados diferentes e armazena na $contrato_atual_bd que sera utilizada para exclusao dos resgistro;
                $contrato_atual_bd = array_diff($cod_bd_atual, $cod_form_atual);
                array_multisort($contrato_atual_bd);
                //excluindo os contratos do banco
                for ($i = 0; $i < count($contrato_atual_bd); $i++) {
                    $sql = $this->db->prepare('DELETE FROM sgl_unidade_contrato WHERE cod_unidade = ? AND cod_contrato = ?');
                    $sql->bindValue(1, $data['cod_unidade']);
                    $sql->bindValue(2, $contrato_atual_bd[$i]);
                    $sql->execute();
                }
            }


            //ALTERAR ENDEREÇO
            $sql = $this->db->prepare('UPDATE sgl_unidade_endereco SET cod_unidade=:cod_unidade, logradouro_endereco=:logradouro_endereco, numero_endereco=:numero_endereco, bairro_endereco=:bairro_endereco, complemento_endereco=:complemento_endereco, latitude_endereco=:latitude_endereco, longitude_endereco=:longitude_endereco, gps_endereco=:gps_endereco WHERE cod_endereco=:cod_endereco');
            foreach ($data['endereco'] as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();

            //CADASTRAR, alterar e excluir CONTATO
            if (isset($data['contatos'])) {

                foreach ($data['contatos'] as $contato) {

                    if (isset($contato['cod_contato'])) {
                        $sql = $this->db->prepare('UPDATE sgl_unidade_contato SET cod_unidade = ?, nome_contato = ?, email_contato = ?, telefone1_contato = ?, telefone2_contato = ? WHERE cod_contato = ?');
                        $sql->bindValue(1, $contato['cod_unidade']);
                        $sql->bindValue(2, $contato['nome_contato']);
                        $sql->bindValue(3, $contato['email_contato']);
                        $sql->bindValue(4, $contato['telefone1_contato']);
                        $sql->bindValue(5, $contato['telefone2_contato']);
                        $sql->bindValue(6, $contato['cod_contato']);
                        $sql->execute();
                    } else {
                        $sql = $this->db->prepare('INSERT INTO sgl_unidade_contato (cod_unidade, nome_contato, email_contato, telefone1_contato, telefone2_contato) VALUES (?, ?, ?, ?, ?);');
                        $sql->bindValue(1, $contato['cod_unidade']);
                        $sql->bindValue(2, $contato['nome_contato']);
                        $sql->bindValue(3, $contato['email_contato']);
                        $sql->bindValue(4, $contato['telefone1_contato']);
                        $sql->bindValue(5, $contato['telefone2_contato']);
                        $sql->execute();
                    }
                }

                $cod_form_atual = array();
                foreach ($data['contatos'] as $contato) {
                    if (isset($contato['cod_contato'])) {
                        $cod_form_atual[] = $contato['cod_contato'];
                    }
                }
                $cod_bd_atual = array();
                if (isset($data['contatos_bd'])) {
                    foreach ($data['contatos_bd'] as $contato) {
                        if (isset($contato['cod_contato'])) {
                            $cod_bd_atual[] = $contato['cod_contato'];
                        }
                    }
                }
                $contato_atual_bd = array_diff($cod_bd_atual, $cod_form_atual);
                array_multisort($contato_atual_bd);

                for ($i = 0; $i < count($contato_atual_bd); $i++) {
                    $sql = $this->db->prepare('DELETE FROM sgl_unidade_contato WHERE cod_unidade = ? AND cod_contato = ?');
                    $sql->bindValue(1, $data['cod_unidade']);
                    $sql->bindValue(2, $contato_atual_bd[$i]);
                    $sql->execute();
                }
            }

            return true;
        } catch (PDOException $ex) {
            return false;
        }
    }

    /**
     * Está é responsável excluir um registro específico
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean TRUE or FALSE
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function delete($sql_command, $data) {
        try {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
            return TRUE;
        } catch (PDOException $ex) {
            echo "Erro: " . $ex->getMessage();
            return false;
        }
    }

}
