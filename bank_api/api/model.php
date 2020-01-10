<?php

header("Content-Type: text/html; charset=utf-8");

function exibirJson(array $data){

    $stringPrint =  json_encode($data, JSON_UNESCAPED_UNICODE);

    echo $stringPrint;

}

function pesquisarId(string $id) : array{

    $db = connectionDB();
    $query = 'SELECT * FROM cliente WHERE id = '.$id;
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();
    
    return $rows[0];
}

function pesquisarNome(string $nome) : array{

    $db = connectionDB();
    $query = "SELECT * FROM cliente WHERE nome = '$nome'";
    $statement = $db->prepare($query);
    $statement->execute();
    $rows = $statement->fetchAll();

    if(!empty($rows[0])){

        return $rows[0];

    }else{

        return array("Erro" => "Nome não encontrado");
    }
    
    
}

function cadastrarCliente(array $postParameter){

    $mensagem = array('Sucesso' => 'Cliente foi cadastrado com sucesso',
        'Erro' => 'Erro ao cadastrar cliente');

        $db = connectionDB();
        $query = "INSERT INTO cliente (nome, password, saldo_cliente, sexo, nascimento)
            VALUES ('$postParameter[nome]','$postParameter[password]',
            '$postParameter[saldo_cliente]','$postParameter[sexo]','$postParameter[nascimento]')";
        $statement = $db->prepare($query);
        $sucesso = $statement->execute();
        
    if($sucesso){        
        return $mensagem[0];
    }else{
        return $mensagem[1];
    }

}

function connectionDB() : PDO{

    $db = new PDO('mysql:host=127.0.0.1;dbname=bank_api', 'webmaster', 'webmaster');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db; 
}