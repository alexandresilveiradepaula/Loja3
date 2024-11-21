<?php
require_once 'config.php';

$c=new Controller();
$c->listas();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Página de Listas</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootsrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/css/estilo">
 </head>
<body>
  <div class="container">
    <header class="row clearfix">
      <div class="col-md-8">
        <img src="bootstrap/img/logomarca.png" alt="logomarca"/>
      </div>

      <div class="col-md-4" style="margin-top: 25px;">
        <form method="get" class="form-inline text-right">
          <input type="text" class="form-control" name="nome" placeholder="Nome do Usuário" required/>
          <button class="btn btn-sucess" type="submit">Buscar</button>
        </form>
      </div>
    </header>

    <nav class="row clearfix caixa">
      <ul class="nav nav pills menu estilo">
        <li>
          <a href="index.html">Inicio</a>
        </li>
        <li>
          <a href="listas.html">Listas</a>
        </li>
        <li>
          <a href="produtos.html">Produtos</a>
        </li>
      </ul>
    </nav>


<?php
  if($c->listas){
    foreach($c->listas as $perfil){
      ?>
      <div class="row clearfix caixa">
        <hr>
        <h2 class="titulo">
          <strong>
            <?php 
            echo isset($perfil['lista'][0])?
            $perfil['lista'][0]['descricao']:'Sem itens';
            ?>
          </strong>
        </h2>
        <hr>
        <section class="col-md-6 centralizado">
          <h4>Perfil</h4>
          <img src="bootsatrap/img/usuario/<?php echo 
          $c->Perfil['foto'];?>"
          class="img-responsive center block" alt="">
          <p>Nome:<?php echo $perfil['nome'];?></p>
          <p>Email:<?php echo $perfil['email'];?></p>
          <p><a href="listas.php?id=<?php echo $perfil['id'];?>">
            <span class="glyphicon glyphicon-link">
            </span> Link</a></p>
            <p>Data de Criacao:<?php echo $perfil['criacao'];?></p>
        </section>

        <section class="col-md-6">
          <?php if (isset($perfil['lista']))?>

          <h4 class="titulo">Itens da Lista</h4>
          <table class="table table-striped">
          <thead>
          <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>Detalhes</th>
          </tr>
          </thead>
          
          <tbody>
          <?php foreach ($perfil ['lista'] as $item) {?>
          <tr>
            <td><?php echo $item['codigo'];?></td>
            <td><?php echo $item['nome'];?></td>
            <td><a href="produtos.php" class=btn-"btn info">
              <span class="glyphicon glyphicon-gift">
              </span>Ver</a></td>
          </tr>
          <?php } ?>
        </tbody>
        </table>
        <?php } ?>
        </section>
      </div>
      <?php
    }
   
  ?>
  </div>
</body>
</html>