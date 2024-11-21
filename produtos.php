<?php
require_once 'config.php';

$c= new Controller();
$c->produtos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Página de Produtos</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/css/estilo.css" rel="stylesheet" >
</head>
<body>
  <div class="container">
    <header class="roe clearfix">
      <img src="bootstrap/img/logomarca.png" alt="logomarca">
    </header>
  </div>

<nav class="row clearfix caixa">
  <ul class="nav nav-pills menu estilo">
    <li>
      <a href="index.html">Index</a>
    </li>
    <li>
      <a href="listas.html">Listas</a>
    </li>
    <li>
      <a href="produtos.html">Produtos</a>
    </li>
  </ul>
</nav>

<div>
  <?php 
  if($c->mensagemProduto)
  echo '<h4 class= "alert alert-warning" style="margin: 10px auto ;text-align: center">'.$c->mensagemProduto.'<h4>';43?>
  <hr>
  <h2 class="titulo">
    <strong>Produtos para sua lija</strong>
      </h2>
</div>
<?php 
foreach($c->listaProdutos as $produto){ ?>
<section class="row clearfix caixa centralizado">
  <img src="bootsatrap/img/produto/<?php echo $produto['foto'];?>" alt="foto" class="img-responsive center-block"/>
  <h2><?php $produto['nome'];?></h2>
  <?php $produto['descricao'];?></p>
  <p><a href=<?php $produto['buscar'];?>">Buscar Produto</a></p>
  <?php if($c->loginProduto){?>
  <form method="post">
    <input type="hidden" name="codigo" value="<?php echo $produto['codigo'];?>"/>
    <button name="add" class="btn btn-default btn-lg">Adicionar á lista</button>
  </form>
</section>
<?php }?>
    <?php }?>
  </div>  
  </body>
</html>