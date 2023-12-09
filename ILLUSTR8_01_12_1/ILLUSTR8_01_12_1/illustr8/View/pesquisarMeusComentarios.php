<?php
require_once '../Model/DTO/ComentarioDTO.php';
require_once '../Model/DAO/ComentarioDAO.php';
require_once '../Model/DTO/PostagemDTO.php';
require_once '../Model/DAO/PostagemDAO.php';

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
                <li><a class="button" href="meusComentarios.php">Voltar</a></li>
            </nav>
        </header>
        <section id="title">
            <section class="post" style="display: block;">
                <form action="pesquisarMeusComentarios.php" method="POST">
                    <input type="hidden" name="USUARIO_ID" value="<?=$usuarioId?>">
                
                    <h1 class="h1Pesquisa">Meus Comentários</h1>
                
                    <input type="text" name="TEXTO" placeholder="Palavra Chave" style="text-align: center; color: #006699;">
                    <button style="margin-top: 20px;">Buscar</button>
                </form>
            </section>
        </section>

        <?php 
            require_once '../Model/Conexao.php';
            @$texto=$_POST["TEXTO"];
            @$userId=$_POST["USUARIO_ID"];
            
            if($texto){


            /* echo "SELECT * FROM usuarios 
                WHERE nome = '$nome' or 
                    email = '$email'";

                    echo "<br>";*/

            $lista=[];

            $con = Conexao::getInstance();
            $sql = $con->query("SELECT * FROM comentarios WHERE texto = '$texto' AND usuarios_id = '$userId'");
                
                if($sql->rowCount()>0){
                    $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                }
            
                else{
                    /*echo "SELECT * FROM usuarios where nome like '%$nome%'";*/

                    $con = Conexao::getInstance();
                    $sql = $con->query("SELECT * FROM comentarios WHERE usuarios_id = '$userId' AND texto LIKE '%$texto%'");
                    
                    if($sql->rowCount()>0){
                        $lista = $sql->fetchAll(PDO::FETCH_ASSOC);
                    }else{
                        echo "Erro: 404";
                    }
                }

        ?>
            <?php
                foreach ($lista as $comment) {
                    $idPostagem = $comment["POSTAGENS_ID"];
                    $postagemDTO = new PostagemDTO();
                    $postagemDTO->setIdPostagem($idPostagem);

                    $postagemDAO = new PostagemDAO();
                    $postagens = $postagemDAO->verMais($postagemDTO);
                    $date2 = date('d/m/Y H:i', strtotime($comment["DATACRIACAO"]));

                ?>
                    <section id="posts">
                        <div class="post">
                            <a href="verMais.php?id=<?= $postagens[0]["ID"] ?>">
                                <div id="backImg" style="background-image: url('../Control/<?= $postagens[0]["IMAGEM"] ?>');" class="imgPost"></div>
                            </a>
                            <div class="content">
                                <h3>Post comentado: <a href="verMais.php?id=<?= $postagens[0]["ID"] ?>"><?= $postagens[0]["TITULO"] ?></a></h3>
                                <div class="description">Comentário: <?= $comment["TEXTO"] ?></div>
                                <div class="espaco_botao">
                                    <p></p>
                                    <p id="data"><?= $date2 ?></p>
                            </div>
                                <div class=" espaco_botao">
                                    <p></p>
                                    <a href="detalhesComentario.php?id=<?php echo $comment["ID"]?>">Detalhes</a>
                                    <p></p>
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