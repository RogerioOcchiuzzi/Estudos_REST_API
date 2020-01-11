<?php

header("Content-Type: text/html; charset=utf-8");

function exibirJson(array $data){

    $stringPrint =  json_encode($data, JSON_UNESCAPED_UNICODE);

    echo $stringPrint;

}

function pesquisarId(string $id) : array{

    $db = connectionDB();
    $query = 'SELECT id,nome,saldo_cliente,sexo,nascimento FROM cliente WHERE id = '.$id;
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();
    
    if(!empty($rows[0])){

        return $rows[0];

    }else{

        return array("erro" => "Id não encontrado");
    }
}

function pesquisarNome(string $nome) : array{

    $db = connectionDB();
    $query = "SELECT id,nome,saldo_cliente,sexo,nascimento FROM cliente WHERE nome = '$nome'";
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();

    if(!empty($rows[0])){

        return $rows[0];

    }else{

        return array("erro" => "Nome não encontrado");
    }
    
    
}

function cadastrarCliente(array $postParameter){

    $arrayParameters = json_decode($postParameter['json'], true);
    
    var_dump($arrayParameters);
    $sucesso = array('sucesso' => 'Cliente foi cadastrado com sucesso');
    $erro = array('erro' => 'Erro ao cadastrar cliente');

        /* $db = connectionDB();
        $query = "INSERT INTO cliente (nome, password, saldo_cliente, sexo, nascimento)
            VALUES ('$postParameter[nome]','$postParameter[password]',
            '$postParameter[saldo_cliente]','$postParameter[sexo]','$postParameter[nascimento]')";
        $statement = $db->prepare($query);
        $sucesso = $statement->execute(); */
        
    if('$sucesso'){        
        return $sucesso;
    }else{
        return $erro;
    }

}

function connectionDB() : PDO{

    $db = new PDO('mysql:host=127.0.0.1;dbname=bank_api', 'webmaster', 'webmaster');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db; 
}