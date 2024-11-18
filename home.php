<?php
require_once 'config.php';

$c= new Controller();
$c->home();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página de Perfil</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/estilo.css" rel="stylesheet">    
</head>
<body>
    <div class="container">
        <header class="row clearfix">
            <img src="bootstrap/img/logomarca.png"  alt="logomarca">
        </header>

        <nav class="row clearfix caixa">
            <ul class="nav nav-pills menu-estilo">
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

        <div class="row clearfix caixa">
            <?php
                if($c->mensagemHome)
                echo '<h4 class = "alert alert-warning" style = "margin:10px auto; text-align:center">'.$c->mensagemHome.'</h4>';
            ?>
            <hr>
            <h2 class="titulo">
                <strong>
                    Meu Perfil
                </strong>
           </h2>
           <hr>
           <section class="col-md-6">
            <h4 class="titulo">Imagem de Perfil</h4>
            <img src="bootstrap/img/usuario/<?php echo $c->perfil['foto'];?>" class="img-responsive center-block" alt="">
            <hr/>
            <form class="form-estilo" method="POST" enctype="multipart/form-data">
                <p><button name="enviarFoto" type="submit" class="btn btn-info btn-block">Enviar</button></p>              </p>
            </form>
           </section>

           <section class="col-md-6">
            <h4 class="titulo">Dados de Perfil</h4>
            <p>Nome:<?php echo $c->perfil['nome'];?></p>
            <p>Email:<?php echo $c->perfil['email'];?></p>
            <p><a href="listas.php?id=<?php echo $c->perfil['id'];?>" >Meu link</a></p>
            <p>Data de Criação:<?php echo $c->perfil['criacao'];?></p>
            <br/>

            <div class="bg-warning">
                <h3>Minha Lista</h3>
                <?php if($c->lista){?>
                    <p>Nome:<?php echo $c->lista['descricao'];?></p>
                    <form method="post">
                        <button name="excluirLista" class="btn btn-danger" type="submit">
                            <span class="glyphicon glypchicon-remove">Excluir</span>
                        </button>
                    </form>
                    <?php } else { ?>
                        <form method="post" style="width:250px;">
                            <input type="text" name="descricao" class="form-control" placeholder="Coloque aqui o nome de sua lista" required>
                            <br/>
                            <button name="Criar Lista" class="btn btn-lg btn-info btn-block" type="submit">Criar lista</button>
                        </form>
                        <?php }?>
                    </div>   
           </section>
        </div>
        <div class="row clearfix">
            <section class="col-md-6 caixa" style="background-color:#fff;">
        <h3 class="titulo">Itens da Minha Lista</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descricao</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($c->itens){
                    foreach($c->itens as $item){
                        ?>
                        <tr>
                            <td><?php echo $item['codigo'];?></td>
                        </tr>
                    }
                }
            </tbody>
        </table>
    </section>
        </div>
    </div>
    
</body>
</html>