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
                <li><a class="button" href="meusPosts.php">Voltar</a></li>

                <!-- <li><a class="button" href="">Login</a></li> -->
            </nav>
        </header>
        <section id="title">
            <section class="post" style="display: block;">
                <form action="pesquisarMeusPosts.php" method="POST">
                    <input type="hidden" name="USUARIO_ID" value="<?=$usuarioId?>">
                
                    <h1 class="h1Pesquisa">Meus Posts</h1>
                
                    <input type="text" name="TITULO" placeholder="Título" style="text-align: center; color: #006699;">
                    <button style="margin-top: 20px;">Buscar</button>
                </form>
            </section>
        </section>

        <?php 
            require_once '../Model/Conexao.php';
            @$titulo=$_POST["TITULO"];
            @$userId=$_POST["USUARIO_ID"];
            
            if($titulo){


            /* echo "SELECT * FROM usuarios 
                WHERE nome = '$nome' or 
                    email = '$email'";

                    echo "<br>";*/

            $lista=[];

            $con = Conexao::getInstance();
            $sql = $con->query("SELECT * FROM postagens WHERE titulo = '$titulo' AND usuarios_id = '$userId'");
                
                if($sql->rowCount()>0){
                    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                }
            
                else{
                    /*echo "SELECT * FROM usuarios where nome like '%$nome%'";*/

                    $con = Conexao::getInstance();
                    $sql = $con->query("SELECT * FROM postagens WHERE usuarios_id = '$userId' AND titulo LIKE '%$titulo%'");
                    
                    if($sql->rowCount()>0){
                        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                    }
                }

        ?>
            <?php
                foreach ($lista as $post) {
                    $date1 = date('d/m/Y H:i', strtotime($post["DATAPUBLICACAO"]));

                ?>
                    <section id="posts">
                        <div class="post">
                            <a href="verMais.php?id=<?php echo $post["ID"] ?>">
                                <div id="backImg" style="background-image: url('../Control/<?= $post["IMAGEM"] ?>');" class="imgPost"></div>
                            </a>
                            <div class="content">
                                <h3>Título: <?= $post["TITULO"] ?></h3>
                                <p id="tipo">Tipo: <?= $post["TIPO"] ?></p>
                                <div class="description"> <strong>Descrição:</strong><?= $post["DESCRICAO"] ?></div>
                                <div class="espaco_botao">
                                    <p id="preco">Preço R$ <?= $post["PRECO"] ?></p>
                                    <p id="data"><?= $date1 ?></p>
                                </div>
                                <div class="espaco_botao">
                                    <a href="verMais.php?id=<?php echo $post["ID"] ?>">Ver mais</a>
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