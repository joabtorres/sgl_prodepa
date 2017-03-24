<?php

/**
 * A classe 'model' é responsável para inicializa a instância na classe PDO e armazena na variavel $db;
 * 
 * @author Joab Torres <joabtorres1508@gmail.com>
 * @version 1.0
 * @copyright  (c) 2017, Joab Torres Alencar - Analista de Sistemas 
 * @access public
 * @package core
 * @example classe model
 */
class model {

    /**
     * Instância do objeto da classe PDO()
     * @access protected
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    protected $db;

    /**
     * Está função é inicializada ao solicita uma instáncia das classes models, fazendo com que armazene a conexão do banco de dados via classe PDO na variavel $db;
     * @access public
     * @author Joab Torres <joabtorres1508@gmail.com>
     */
    public function __construct() {
        global $config;
        try {
            $this->db = new PDO('mysql:dbname=' . $config['dbname'] . ';host=' . $config['host'], $config['dbuser'], $config['dbpass']);
            $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8_gen'");
        } catch (PDOException $e) {
            echo "Conexão ao banco de dados falhou: " . $e->getMessage();
        }
    }

}
