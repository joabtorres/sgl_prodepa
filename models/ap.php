<?php

/**
 * A classe 'ap' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe ap
 */
class ap extends model {

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
     * @param String $sql_command  - Comando SQL;
     * @param Array $data - Dados salvo em array para seres setados por um foreach;
     * @access public
     * @return boolean 
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function create($sql_command, $data) {

        try {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $sql->execute();
            //salva novo arquivo json
            $this->saveJson();
            return TRUE;
        } catch (Exception $ex) {
            echo "Erro: " . $ex->getMessage();
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
    public function read($sql_command, $data) {
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
        //salva novo arquivo json
        $this->saveJson();
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
        //salva novo arquivo json
        $this->saveJson();
        return false;
    }

    private function saveJson() {
        //array que vai salva o json
        $json = array();
        //arquivo
        $fileJson = "assets/json/ap.json";

        //deleta json atual se existi
        if (file_exists($fileJson)) {
            unlink($fileJson);
        }

        $cidadeModel = new cidade();
        $cidades = $cidadeModel->read("SELECT DISTINCT(sgl_cidade_area_atuacao.cidade_area_atuacao), sgl_cidade_area_atuacao.cod_area_atuacao, sgl_cidade_area_atuacao.cod_nucleo FROM sgl_cidade_area_atuacao, sgl_ap WHERE sgl_cidade_area_atuacao.cod_area_atuacao=sgl_ap.cod_area_atuacao GROUP BY sgl_cidade_area_atuacao.cod_area_atuacao ORDER BY sgl_cidade_area_atuacao.cod_area_atuacao ASC;", array());
        $aps = $this->read("SELECT * FROM sgl_ap ORDER BY nome_ap ASC", array());

        foreach ($cidades as $cidade) {
            foreach ($aps as $ap) {
                if ($cidade['cod_area_atuacao'] == $ap['cod_area_atuacao']) {
                    $json[$cidade['cod_area_atuacao']][] = array("cod" => $ap['cod_ap'], "nome" => $ap['nome_ap']);
                }
            }
        }
        file_put_contents($fileJson, json_encode($json));
    }

}
