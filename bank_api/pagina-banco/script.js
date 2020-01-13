var fileHtml = null;

function FileHelper(pathOfFileToReadFrom){

        var request = new XMLHttpRequest();
        request.open("GET", pathOfFileToReadFrom, false);
        request.send(null);
        var returnValue = request.responseText;

        return returnValue;
}   

function operacao(value){
    
    fileHtml = FileHelper("./"+value+".html"); 
    document.getElementById("page").innerHTML = fileHtml;
}

function criar_conta(){

    var dados_cliente = {
        nome : document.getElementById("nome").value,
        nascimento : document.getElementById("nascimento").value,
        sexo : document.getElementById("sexo").value,
        saldo_cliente : document.getElementById("saldo_cliente").value,
        senha : document.getElementById("senha").value
    };
    
    var json_string = JSON.stringify(dados_cliente);

    if(dados_cliente.senha == document.getElementById("confirma_senha").value){

        var request = new XMLHttpRequest();
        request.open("POST", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/cadastrar/" , false);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("json="+json_string);

        var returnValue = request.responseText;
        var obj = JSON.parse(returnValue);

        if (typeof obj.erro === 'undefined') {

            alert(obj.sucesso);
        }else{

            alert(obj.erro);
        }
    }else{

        alert("Senhas diferentes.")
    }
    
    document.getElementById("page").innerHTML = fileHtml;

}

function procura(procuraValor){

    var request = new XMLHttpRequest();
    elementoValor = document.getElementById(procuraValor).value;
    request.open("GET", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/pesquisar/"+
        procuraValor+"/"+elementoValor , false);
    request.send(null);
    var returnValue = request.responseText;

    document.getElementById("page").innerHTML = fileHtml;

    var obj = JSON.parse(returnValue);
    
    if (typeof obj.erro === 'undefined') {
        
        document.getElementById("id").value = obj.id;
        document.getElementById("nome").value = obj.nome;
        document.getElementById("nascimento").value = obj.nascimento;
        document.getElementById("sexo").value = obj.sexo;
        document.getElementById("saldo_cliente").value = obj.saldo_cliente;
        document.getElementById("senha").value = obj.senha;
        document.getElementById("confirma_senha").value = obj.senha;
            
    }else{

        alert(obj.erro);
    }
    
}

function atualizar_conta(){

    var dados_cliente = {
        id : document.getElementById("id").value,
        nome : document.getElementById("nome").value,
        nascimento : document.getElementById("nascimento").value,
        sexo : document.getElementById("sexo").value,
        saldo_cliente : document.getElementById("saldo_cliente").value,
        senha : document.getElementById("senha").value
    };
    
    var json_string = JSON.stringify(dados_cliente);

    if(dados_cliente.senha == document.getElementById("confirma_senha").value){

        var request = new XMLHttpRequest();
        request.open("PUT", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/atualizar/" , false);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("json="+json_string);

        var returnValue = request.responseText;
        var obj = JSON.parse(returnValue);

        if (typeof obj.erro === 'undefined') {

            alert(obj.sucesso);
        }else{

            alert(obj.erro);
        }
    }else{

        alert("Senhas diferentes.")
    }
    
    var request = new XMLHttpRequest();
    request.open("GET", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/pesquisar/id/"+dados_cliente.id , false);
    request.send(null);
    var returnValue = request.responseText;

    document.getElementById("page").innerHTML = fileHtml;

    var obj = JSON.parse(returnValue);

    document.getElementById("id").value = obj.id;
    document.getElementById("nome").value = obj.nome;
    document.getElementById("nascimento").value = obj.nascimento;
    document.getElementById("sexo").value = obj.sexo;
    document.getElementById("saldo_cliente").value = obj.saldo_cliente;
    document.getElementById("senha").value = obj.senha;
    document.getElementById("confirma_senha").value = obj.senha;
}

function fazer_login(){

}

function ir_transacoes(){
    
}

