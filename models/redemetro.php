<?php

/**
 * A classe 'redemetro' é responsável para efetiva comandos sql no banco de dados, como, insert, update, select, delete, count;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package models
 * @example classe redemetro
 */
class redemetro extends model {

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
            $resultado = $sql->execute();
            //salva novo arquivo json
            $this->save_json();
            return $resultado;
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
        try {
            $sql = $this->db->prepare($sql_command);
            foreach ($data as $indice => $valor) {
                $sql->bindValue(":" . $indice, $valor);
            }
            $resultado = $sql->execute();
            //salva novo arquivo json
            $this->save_json();
            return $resultado;
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
        return false;
    }

    /**
     * Está funcão tem como objetivo criar um arquivo ap.json que armazena as redemestros registradas por cidades;
     * @access private
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    private function save_json() {
        //array que vai salva o json
        $json = array();
        //arquivo
        $fileJson = "assets/json/redemetro.json";

        //deleta json atual se existi
        if (file_exists($fileJson)) {
            unlink($fileJson);
        }

        $cidadeModel = new cidade();
        $cidades = $cidadeModel->read("SELECT * FROM sgl_cidade_area_atuacao ORDER BY sgl_cidade_area_atuacao.cidade_area_atuacao ASC;", array());
        $redemetros = $this->read("SELECT DISTINCT(c.cidade_area_atuacao), rede.* FROM sgl_cidade_area_atuacao AS c INNER JOIN sgl_redemetro AS rede ON c.cod_area_atuacao=rede.cod_area_atuacao ORDER BY c.cidade_area_atuacao ASC, rede.nome_redemetro ASC;", array());

        foreach ($cidades as $cidade) {
            foreach ($redemetros as $rede) {
                if ($cidade['cod_area_atuacao'] == $rede['cod_area_atuacao']) {
                    $json[$cidade['cod_area_atuacao']][] = array("cod" => $rede['cod_redemetro'], "nome" => $rede['nome_redemetro']);
                }
            }
        }
        file_put_contents($fileJson, json_encode($json));
    }

}
