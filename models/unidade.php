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
                    //$sql = $this->db->prepare('INSERT INTO sgl_unidade_contrato (cod_unidade, numero_contrato, nome_contrato, data_inicial_contrato, data_vigencia_contrato) VALUES (:cod, :nome, :tipocontrato, :data_inicial, :data_vigencia); ');
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
        /*
          $sql = $this->db->prepare($sql_command);
          foreach ($data as $indice => $valor) {
          $sql->bindValue(":" . $indice, $valor);
          }
          $sql->execute(); */
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
    public function update($sql_command, $data) {
        return false;
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
        return false;
    }

}
