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
    
}

function fazer_login(){

}
//document.getElementById("page").innerHTML = value;
//document.getElementById("page").innerHTML = '<object class="object_width" type="text/html" data="'+value+'.html"></object>';
//<button class="button_operation" type="button" onclick="operation()">Select Operetion</button>
//var operationValue = document.getElementById("operation").innerHTML;  
//<object class="object_width" type="text/html" data="read_account.html"></object>
