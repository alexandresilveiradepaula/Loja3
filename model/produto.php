<?php 

class Produto{
  public function recebeProdutos(){
    try{
      $sql = "SELECT * FROM produto";
      $stmt = Conexao::getConexao()->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_BOTH);

      return $result;
    } catch(Exception $ex){
      return $ex;
    }
  } 
}


?>