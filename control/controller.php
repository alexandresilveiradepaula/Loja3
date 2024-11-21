<?php 

class Controller{
  public $cadastroIndex = false;
  public $loginIndex = false;
  public $listaProdutos = false;
  public $mensagemProduto = false;
  public $loginProduto = false;
  public $mensagemHome = false;
  public $lista = false;
  public $perfil = false;
  public $itens = false;
  public $listas = false;

  public function index(){
    
    session_start();
    
    if(array_key_exists("email",$_SESSION)){
      header('Location:home.php');
      exit;
    }
    
    if(isset($_COOKIE['email'])){
      $_SESSION['email'] = $_COOKIE['email'];
      header("Location:home.php");
      exit;
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    
      if(isset($_POST['cadastrar'])){
        
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        
        $usuario = new Usuario();
        $this->cadastroIndex = $usuario->addUsuario($email,$nome,$senha);
      }

      if(isset($_POST['login'])){

        $email = $_POSt['email'];
        $email = $_POST['senha'];
        $login = new Usuario();

        if($login->validarUsuario($email,$senha)>0){
          
          if(isset($_POST['lembrete'])){
            
            setcookie ('email', $email,time()+60 * 60);

          }
          $_SESSION['email'] = $email;

          header("Location:n=home.php");
          exit;
        } else{
          $this->loginIndex = "Dados Invalidos";
        }
      }
      }
    }

    public function produtos(){
      $p = new Produto();
      $this->listaProdutos = $p->recebeProdutos();

      if($this->verificaLogin()){
        $this->loginProduto = true;
        if(isset($_POST['add'])){
          $lista = new Lista();

          $this->mensagemProduto = $lista->addItem($_SESSION['email'],$_POST['codigo']);
        }
      }
    }

    public function home(){

      if(!this->verificaLogin()){
        header('Location:index.php');
        exit;
      }
      if(isset($_POST['enviaEmail'])){

        $para=$_POST['email'];
        $nome=$_POST['nome'];
        

        $u = new Usuario();
        $usuario = $u->recebeUsuario($_SESSION['email']);

        $assunto = "Olá".$nome.".Acesse minha lista de presentes";
        $msg= "Acesse o link aseguir e confira minha lista de presentes: www.presentes.com/listas.php?id=".$usuario['id'];

        if (mail($para,$assunto,$msg)){
          $this->mensagemHome = "Envio Realizado";
         }
        }

        if(isset($_POST['enviarFoto'])){
          $this->mensagemHome = $this->enviarFoto($_SESSION['email'],$_FILES['arquivo'],'bootstrap/img/usuario/');
        }

        if(isset($_POST['criarLista'])){
          $descricao = $_POST['descricao'];
          $l = new Lista();
          $resultado = $l->addLista($_SESSION['email'],$descricao);

          if(!$resultado){
            $this->mensagemHome = 'Erro ao criar lista';
          }
          }

          if(isset($_POST['excluirLista'])){
            $l = new Lista();
            $this->mensagemHome = $l->removeLista($_SESSION['email']);
          }

          $l = new Lista();
          $this->lista = $l->getLista($_SESSION['email']);

          if($this->lista){
            if(isset($_POST['excluirItem'])){

              $this->mensagemHome = $l->removeItem($this->lista['codigo'],$_POST['codProduto']); 
            }

            $this->itens = $l->getItens($this->lista['codigo']);
          }

          $u = new Usuario();
          $this->perfil = $u->recebeUsuario($_SESSION['email']);
      }
    
      public function listas(){
      $u = new Usuario();

      if(isset($_GET['nome'])){
        $this->listas = $u->recebeUsuarioPorCampo('nome',$_GET['nome']);
      }else if(isset($_GET['id'])){
        $this->listas = $u->recebeUsuarioPorCampo('id',$_GET['id']);
      }else {
        $this->listas = $u->recebeUsuarios();
      }

      if($this->listas){
        $l = new Lista();

        $i = 0;
        foreach($this->listas as $itens){
          $getItens = $l->getItensUsuario($itens['email']);

          if($getItens){
            $this->listas[$i]['lista'] = $getItens;
          }
          $i++;
        }
      }
    }

    private function enviarFoto($email,$arquivo,$pasta){
      $nome = $arquivo['name'];
      $temp = $arquivo['tmp_name'];

      $foto = md5($nome).rand(0,10000).'jpg';
      $foto = md5($nome).rand(0,10000).'jpg';

      if (!move_uploaded_file($temp,$pasta.$foto)){
        return 'Erro ao fazer upload de arquivo';
      }

      $u = new Usuario();
      $fotoAntiga = $u->recebeUsuario($email);
      if($fotoAntiga['foto'] != 'padrao.jpg'){
        unlink($pasta.$fotoAntiga['foto']);
      }
      return $u->adicionaFoto($email,$foto);
    }

    public function verificaLogin(){

      session_start();

      if(!array_key_exists("email",$_SESSION)){
        return false;
      }
      return true;
    }
    public function efetuarLogout(){
      session_start();
      if(isset($_SESSION['email'])){
        session_destroy();
        setcookie('email','',time()-3600);

        header('Location:index.php');
        exit;
      }else
      header ('Location: index.php');
    }
}