<?php
session_start();
if (!isset($_SESSION['USUARIO'])) {
      session_destroy();
      header('location: login.php');
      die();
}

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
echo $msg;

$usuarioId = $_SESSION['USUARIO']["id"];

echo $usuarioId;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="../css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">

    <title>Illustr8</title>
</head>

<body id="page-posts">
    <div id="container">
        <header style="justify-content: flex-end;">

            <nav>
                <li><a class="button" href="posts.php">Voltar</a></li>

                <!-- <li><a class="button" href="">Login</a></li> -->
            </nav>
        </header>
        <section id="title">
            <section class="post" style="display: block;">
                <form action="pesquisarUsuarios.php" method="POST">
                
                
                    <h1 class="h1Pesquisa">Usuários</h1>
                
                    <input type="text" name="NOME" placeholder="Usuário" style="text-align: center; color: #006699;">
                    <button style="margin-top: 20px;">Buscar</button>
                </form>
            </section>
        </section>

        <?php 
            require_once '../Model/Conexao.php';
            @$nome=$_POST["NOME"];
            
            if($nome){


            /* echo "SELECT * FROM usuarios 
                WHERE nome = '$nome' or 
                    email = '$email'";

                    echo "<br>";*/

            $lista=[];

            $con = Conexao::getInstance();
            $sql = $con->query("SELECT * FROM usuarios WHERE nome = '$nome'");
                
                if($sql->rowCount()>0){
                    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                }
            
                else{
                    /*echo "SELECT * FROM usuarios where nome like '%$nome%'";*/

                    $con = Conexao::getInstance();
                    $sql = $con->query("SELECT * FROM usuarios WHERE nome LIKE '%$nome%'");
                    
                    if($sql->rowCount()>0){
                        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                    }
                }

        ?>
            <?php
                foreach ($lista as $usuario) {
                ?>
                    <section id="posts">
                        <div class="post">
                            <a href="visitarPerfil.php?id=<?php echo $usuario["ID"] ?>">
                                <div id="backImg" style="background-image: url('../Control/<?= $usuario["FOTO"] ?>');" class="imgPost"></div>
                            </a>
                            <div class="content">
                                <h3>Nome: <?= $usuario["NOME"] ?></h3>
                                <p id="tipo">Nickname: <?= $usuario["NICKNAME"] ?></p>
                                <div class="description"> <strong>Descrição:</strong><?= $usuario["DESCRICAO_USUARIO"] ?></div>
                                <div class="espaco_botao">
                                    <p id="preco">Perfil: <?= $usuario["PERFIL"] ?></p>
                                </div>
                                <div class="espaco_botao">
                                    <a href="visitarPerfil.php?id=<?php echo $usuario["ID"] ?>">Visitar perfil</a>
                                </div>
                            </div>
                        </div>
                    </section>


                <?php
                }
                ?>

            <?php } ?>

        <footer></footer>
    </div>
</body>

</html>