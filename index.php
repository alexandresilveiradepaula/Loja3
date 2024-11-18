<?php
require_once 'config.php';

$c= new Controller();
$c->index();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Página Inicial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="bootstrap/css/bootsatrap.min.css">
    <link href="bootstrap/css/estilo.css" rel="stylesheet">
</head>
<body>
    <div class = "container">
        <header class="row-clearfix">
            <img src="bootstrap/img/logomarca.png" alt="logomarca"/>
        </header>

        <nav class="row clearfix caixa">
            <ul class="nav-pills menu-estilo">
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
            <section class="col-md-6">
                <form method="POST" class="form-estilo">
                <?php
                    if ($c->loginIndex) {
                        echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center;">' . $c->loginIndex . '</h4>';}
                ?>

                    <hr>
                    <h2 class="titulo">
                        <strong>Efetue o Login</strong>
                    </h2>
                    <hr>
                    <p><input type="email" name="email" class="form-control" placeholder="Digit seu email" required/></p>
                    <p><input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required/></p>
                    <label class="checkbox">
                        <input type="radio" name="lembrete"/>Lembrar Senha
                    </label>
                    <p><button name="login" type="submit" class="btn-lg btn-info btn-block">Entrar</button></p>
                </form>
            </section>

            <section class="col-md-6">
                <form method="POST" class="form-estilo">
                <?php
                    if ($c->cadastroIndex) {
                        echo '<h4 class="alert alert-warning" style="margin: 10px auto; text-align: center;">' . $c->cadastroIndex . '</h4>';
                        }
                ?>
                <hr>
                <h2 class="titulo">
                    <strong>Cadastre-se agora</strong>
                </h2>

                <hr>
                <p><input type="text" name="nome" class="form-control" placeholder="Digite seu nome" required/></p>
                <p><input type="email" name="email" class="form-control" placeholder="Digite seu email" required/></p>
                <p><button name="cadastrar" type="submit" class="btn btn-lg btn-info btn-clock">Cadastrar</button></p>>
                </form>
            </section>
        </div>
        <section class="row clearfix caixa">
            <hr>
            <h2 class="titulo">
                <strong>Como Criar sua própria lista?</strong>                
            </h2>
            <hr>


            <div class="col-md-6">
                <img alt="tutorial_1" src="bootstrap/img/index/tutorial.jpg" class="img-responsive">
            </div>
            <div class="col-md-6">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam vel molestiae cupiditate laudantium ducimus dicta, ullam recusandae qui explicabo? Tempora laborum omnis, minima voluptatem ad incidunt perferendis aspernatur amet porro!
                </p>
            </div>
        </section>
    </div>
</body>
</html>



