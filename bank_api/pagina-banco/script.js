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

function ir_transacoes(){
    
}

function procura_id(){

        var request = new XMLHttpRequest();
        id = document.getElementById("id").value;
        request.open("GET", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/pesquisar/id/"+id , false);
        request.send(null);
        var returnValue = request.responseText;

        document.getElementById("page").innerHTML = fileHtml;

        var obj = JSON.parse(returnValue);

        if (typeof obj.erro === 'undefined') {

            document.getElementById("id").value = obj.id;
            document.getElementById("nome").value = obj.nome;
            document.getElementById("nascimento").value = obj.nascimento;
            document.getElementById("sexo").value = obj.sexo;
            document.getElementById("saldo_cliente").value = "Saldo cliente: " + obj.saldo_cliente;
              
          }else{

            alert(obj.erro);

          }
                

            
       
        
        
}

function procura_nome(){

    var request = new XMLHttpRequest();
    nome = document.getElementById("nome").value;
    request.open("GET", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/pesquisar/nome/"+nome , false);
    request.send(null);
    var returnValue = request.responseText;

    document.getElementById("page").innerHTML = fileHtml;

    var obj = JSON.parse(returnValue);
    
        if (typeof obj.erro === 'undefined') {
            
            document.getElementById("id").value = obj.id;
            document.getElementById("nome").value = obj.nome;
            document.getElementById("nascimento").value = obj.nascimento;
            document.getElementById("sexo").value = obj.sexo;
            document.getElementById("saldo_cliente").value = "Saldo cliente: " + obj.saldo_cliente;
              
        }else{

            alert(obj.erro);

        }
    
}

function criar_conta(){

    var dados_cliente = {
        nome : document.getElementById("nome").value,
        nascimento : document.getElementById("nascimento").value,
        sexo : document.getElementById("sexo").value,
        saldo_cliente : document.getElementById("saldo_cliente").value,
        senha : document.getElementById("senha").value,
        confirma_senha : document.getElementById("confirma_senha").value
    };
    
    var json_string = JSON.stringify(dados_cliente);

    if(dados_cliente.senha == dados_cliente.confirma_senha){

        var request = new XMLHttpRequest();
        request.open("POST", "http://localhost/Estudos_REST_API/bank_api/api/ver1.0/funcionario/cadastrar/" , false);
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("json="+json_string);

    }else{

        alert("Senhas diferentes.")
    }
    
        document.getElementById("page").innerHTML = fileHtml;

}

function fazer_login(){

}

