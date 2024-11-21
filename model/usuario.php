<?php

class Usuario{

  public function addUsuario($email,$nome,$senha){

    try{
      sql="INSERT INTO usuario VALUES (?,?,?,?,?,?)";
      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$email);
      $stmt->bindValue(2,md5($email));
      $stmt->bindValue(3,$nome);
      $stmt->bindValue(4,$senha);
      $stmt->bindValue(5,$date('y-m-d'));
      $stmt->bindValue(6,'padrao.jpg');
      $stmt->execute();

      return 'Usuario Cadastrado com Sucesso';   
    } catch (Exception $ex){
      if ($ex->errorInfo[1] == 1062){
        return 'Usuario já existente';
      } else {
        return 'Erro ao cadastrar Usuario';
      }
    } 
}

public function validarUsuario($email,$senha){
  try{
    $sql="SELECT * FROM usuario WHERE email=? AND senha=?";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->bindValue(1,$email);
    $stmt->bindValue(2,$senha);
    $stmt->execute();
    $result = $stmt->rowCount();

    return $result;   
  } catch (Exception $ex){
    return false;
  }
}

public function recebeUsuario($email){
  try{
    $sql = "SELECT * FROM usuario WHERE email='$email'";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->bindValue(1,$email);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $result = $stmt->fetch(PDO::FETCH_BOTH);

      return $result;
    }
    return false;
  } catch (Exception $ex){
    return false;
  }
}
public function recebeUsuarioPorCampo($campo,$valor){
  try{
    $sql = "SELECT * FROM usuario WHERE $campo like '%$valor%'";

    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->execute();

    if($stmt->rowCount()>0){
      $result = $stmt->fetchAll(PDO::FETCH_BOTH);
       return $result;
    }
    return false;
  } catch (Excecption $ex){
    return false;
  }
}

public function recebeUsuarios(){
  try{
    $sql= "SELECT * FROM usuario";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount()>0){
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }
    return false;
  } catch (Exception $ex){
    return false;
  }
  
}

public function adicionaFoto($email,$foto){
  try{
    $sql = "UPDATE usuario SET foto=? WHERE email=?";
    $stmt = Conexao::getConexao()->prepare($sql);
    $stmt->bindValue(1,$foto);
    $stmt->bindValue(2,$email);
    $stmt->execute();

    return 'Foto Inserida';
      } catch (Exception $ex){
        return 'Erro ao inserir foto';
      }
}
}
?>