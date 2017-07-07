<?php

require '../autoload.php';

use Trabalho\Usuario;
use Trabalho\Produto;

$u = new Usuario();
$p = new Produto();


$u->populate(array(
    "email" => "guilherme@email.com",
    "senha" => 123456
));

$p->populate(array(
    "nome" => "Cadeira",
    "valor" => 150.00
));

$config = file_get_contents("../config.json");
$config = json_decode($config);
$conn = \Trabalho\BancoDeDados::connectDb($config->usuario, $config->senha, $config->host, $config->db);

$u->saveBd($conn);
$p->saveBd($conn);

die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r("Salvou", true) . "</pre>");




