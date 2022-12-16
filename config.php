<?php

/*
 * config.php  - Este arquivo contem informações referente a: Conexão com banco de dados e URL Pádrão
 */

require 'environment.php';

global $config;
$config = array();
if (ENVIRONMENT == 'development') {
    //Raiz
    define("BASE_URL", "http://localhost/sgl_prodepa");
    //Nome do banco
    $config['dbname'] = 'prodepa_sgl';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = 'root';
    //senha
    $config['dbpass'] = '';
} else {
//Raiz
    define("BASE_URL", "");
    //Nome do banco
    $config['dbname'] = '';
    //host
    $config['host'] = 'localhost';
    //usuario
    $config['dbuser'] = '';
    //senha
    $config['dbpass'] = '';
}
?>
