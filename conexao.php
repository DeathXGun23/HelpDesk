<?php

$host = 'localhost';
$usuario = 'root';
$pass = '';
$dbname = 'HelpDesk';
$dsn = "mysql:host=$host;dbname=$dbname";

try{
    $conexao = new PDO($dsn, $usuario, $pass);
}catch(PDOExpection $e){
    echo $e;
}