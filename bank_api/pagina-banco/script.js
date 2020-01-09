function FileHelper(pathOfFileToReadFrom){

        var request = new XMLHttpRequest();
        request.open("GET", pathOfFileToReadFrom, false);
        request.send(null);
        var returnValue = request.responseText;

        return returnValue;

}   

function operacao(value){

    var fileHtml = null;

    fileHtml = FileHelper("./"+value+".html");
    
    
    document.getElementById("page").innerHTML = fileHtml;
}

function ir_transacoes(){
    
}

function procura_id(){

}

function procura_nome(){
    
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
