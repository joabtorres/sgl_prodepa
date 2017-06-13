<?php

/*
 * config.php  - Este arquivo contem informações referente a: Conexão com banco de dados e URL Pádrão
 */

require 'environment.php';

global $config;
$config = array();
if (ENVIRONMENT == 'development') {
    //Raiz
    define("BASE_URL", "http://sgl.prodepa.pc");
    //Nome do banco
    $config['dbname'] = 'prodepa_sgl';
    //$config['dbname'] = 'sgl_prodepa_2';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'root';
    //senha
    $config['dbpass'] = '';
} else {
//Raiz
    define("BASE_URL", "http://sgl.endogenese.com.br");
    //Nome do banco
    $config['dbname'] = 'endog103_joab';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'endog103_joab';
    //senha
    $config['dbpass'] = '[}4+ZK62L^om';
}
?>
