<?php 

class Lista {
  public function addLista($email, $descricao){
    try{
      $sql="INSERT INTO lista VALUES (?,?,?)";

      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,'0');
      $stmt->bindValue(2,$descricao);
      $stmt->bindValue(3,$email);

      $stmt->execute();

      return true;
    } catch (Exception $ex){
      return false;
    }
  }

  public function removeLista($email){
    try{
      $sql = "DELETE FROM lista WHERE usuario=?";
      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$email);

      $stmt->execute();

      if ($stmt->rowCount()>0){
        return 'Lista Excluida';
      } else {
        return 'Nenhuma Lista Excluida';
      }
    } catch (Exception $ex){
      return 'Erro ao excluir lista';
    }
  }

   public function getLista($email){
    try{
      $sql="SELECT * FROM lista WHERE usuario=?";
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

   public function addItem($email,$produto){
    try{
      $lista = $this->getLista($email);
      if (!lista){
        return 'Lista não encontrada';
      }

      $sql = "INSERT INTO item VALUES (?,?)";
      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$lista['codigo']);
      $stmt->bindvalue(2,$produto);
      $stmt->execute();

      return 'Produto adicionado a lista';
    } catch (Exception $ex){
      if($ex->erroInfo[1]==1062){
        return 'Pdorudo já adicionado a lista';
      } else {
        return 'Produto não adicionado';
      }
   }
}

  public function removeItem($lista,$produto){
    try{
      $sql="DELETE FROM item WHERE lista_codigo=$lista AND produto_codigo = $produto";
      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$lista);
      $stmt->bindValue(2,$produto);

      $stmt->execute();

      if($stmt->rowCount()>0){
        return 'Produto Excluido com sucessor';
      } else {
        return 'Nengum item excluido';
      }
    } catch (Exception $ex){
      return 'Erro ao excluir item';
    }
  }

  public function getItens($lista){
    try{
      $sql = "SELECT prdotuo.codigo, produto.nome FROM produto INNER JOIN item.produto_codigo = produto.codigo INNER JOIN lista on lista.codigo = item.lista_codigo WHERE lista.codigo = ?";
      
      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$lista);
    
      $stmt->execute();

      if($stmt->rowCount()>0){
        $sresult = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $result;
      }
      return false;
    } catch (Exception $ex){
      return false;
    }
  }

  public function getItensUsuario($email){
    try{
      $sql = "SELECT produto.codigo, produto.nome, lista.descricao FROM produto INNER JOIN item on item.produto_codigo = produto.codigo INNER JOIN lista on lista.codigo = item.lista_codigo INNER JOIN usuario on usuario.email = lista.usuario WHERE usuario.email = ?";

      $stmt = Conexao::getConexao()->prepare($sql);
      $stmt->bindValue(1,$email);

      $stmt->execute();

      if($stmt->rowCOunt()>0){
        $result = $stmt->fetchAll(PDO::FETCH_BOTH);
        return $result;
      }
      return false;
         } catch (Exception $ex){
          return false;
         }
      }
   }

