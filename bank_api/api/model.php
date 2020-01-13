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
    
    if(!empty($rows[0])){

        return $rows[0];

    }else{

        return array("erro" => "Id não encontrado");
    }
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

        return array("erro" => "Nome não encontrado");
    }
}

function cadastrarCliente(array $postParameter){

    $arrayParameters = json_decode($postParameter['json'], true);    
    $sucessoMensagem = array('sucesso' => 'Cliente foi cadastrado com sucesso');
    $erroMensasem = array('erro' => 'Erro ao cadastrar cliente');

    $stringNascimento = addslashes($arrayParameters['nascimento']);
    $db = connectionDB();
    $query = "INSERT INTO cliente (nome, senha, saldo_cliente, sexo, nascimento)
        VALUES ('$arrayParameters[nome]','$arrayParameters[senha]',
        '$arrayParameters[saldo_cliente]','$arrayParameters[sexo]','$stringNascimento')";
    $statement = $db->prepare($query);
    $sucesso = $statement->execute();
        
    if($sucesso){        
        return $sucessoMensagem;
    }else{
        return $erroMensasem;
    }

}

function atualizarCliente(array $postParameter){

    $arrayParameters = json_decode($postParameter['json'], true);    
    $sucessoMensagem = array('sucesso' => 'Cliente foi cadastrado com sucesso');
    $erroMensasem = array('erro' => 'Erro ao cadastrar cliente');

    $stringNascimento = addslashes($arrayParameters['nascimento']);
    $db = connectionDB();
    $query = "UPDATE cliente SET nome = '$arrayParameters[nome]',
        senha = '$arrayParameters[senha]', saldo_cliente = '$arrayParameters[saldo_cliente]',
        sexo = '$arrayParameters[sexo]', nascimento = '$stringNascimento'
        WHERE id = $arrayParameters[id]";
        
    $statement = $db->prepare($query);
    $sucesso = $statement->execute();
        
    if($sucesso){        
        return $sucessoMensagem;
    }else{
        return $erroMensasem;
    }

}

function connectionDB() : PDO{

    $db = new PDO('mysql:host=127.0.0.1;dbname=bank_api', 'webmaster', 'webmaster');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $db; 
}