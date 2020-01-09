<?php

if(!empty($_GET)){

    $urlArray = explode('/', $_GET['q']);

    if($urlArray[0] == "ver1.0"){

        urlHandler($urlArray);

    }else{

        echo "{ 'Erro' : 'Versão não encontrada' }";
    }
}else{ 

    echo "{ 'Erro' : 'Erro na requizição' }";
}

function urlHandler(array $urlArray){

if($urlArray[1] == "funcionario"){

}elseif($urlArray[1] == "cliente"){

}else{
    
    echo "{ 'Erro' : 'Erro na requizição' }";
}

}
