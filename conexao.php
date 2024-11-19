<?php

$host = "localhost";
$bancodedados = "login";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($host, $usuario, $senha, $bancodedados);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}