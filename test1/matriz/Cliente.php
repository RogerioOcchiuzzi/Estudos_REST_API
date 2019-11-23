<?php

//http://localhost/tests_resp/test1/estoque/mostrar

$url = "http://localhost/tests_resp/test1";
$classe = "estoque";
$metodo = "mostrar";

$montar = $url."/".$classe."/".$metodo;

$retorno = file_get_contents($montar);

echo $retorno;

//var_dump(json_decode($retorno, 1));