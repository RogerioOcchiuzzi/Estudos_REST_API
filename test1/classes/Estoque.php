<?php

class Estoque{
    
    public function mostrar() {
        
        $con = new PDO("mysql: host=localhost;
        dbname=filial;", "webmaster", "webmaster");
        
        $query = "SELECT * FROM estoque ORDER BY id ASC";
        $sql = $con->prepare($query);
        $sql->execute();
        
        $resultados = array();
        
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }
        
        if(!$resultados){
            
            throw new Exception("Nenhum produto");
            
        }
        
        return $resultados;
        
    }
    
}