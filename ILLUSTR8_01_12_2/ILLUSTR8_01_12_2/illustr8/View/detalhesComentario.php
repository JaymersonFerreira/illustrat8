<?php
require_once '../Model/DTO/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";
require_once "../Model/DTO/ComentarioDTO.php";
require_once "../Model/DAO/ComentarioDAO.php";

session_start();
if (!isset($_SESSION['USUARIO'])) {
    session_destroy();
    header('location: login.php');
    die();
}

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
echo $msg;

$comentarioId    = $_GET['id'];
$usuarioId = $_SESSION['USUARIO']["id"];
$perfil    = $_SESSION['USUARIO']["perfil"];
$hash      = null;

// if ($perfil != 'ARTISTA') {
//       $hash = 'posts.php?msg=Somente ilustradores podem postar.';
// } else {
//       $hash = '#';
// }

$idComment = new ComentarioDTO();
$idComment->setIdComentario($comentarioId);

$comentarioDAO = new ComentarioDAO();
$comentarios   = $comentarioDAO->verMaisComentario($idComment);

$postId = $comentarios[0]["POSTAGENS_ID"];

$postagemDTO = new PostagemDTO();
$postagemDTO->setIdPostagem($postId);

$postagemDAO = new PostagemDAO();
$postagem    = $postagemDAO->verMais($postagemDTO);

//   if($perfil != 'ARTISTA') {
//     header('location: permissao.php?msg=Usuário sem permissão.');
// }

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
        <?php
        foreach ($postagem as $post) {
            $idArtista  = $post["USUARIOS_ID"];
            $usuarioDTO = new UsuarioDTO();
            $usuarioDTO->setIdUsuario($idArtista);
            $usuarioDAO = new UsuarioDAO();
            $usuarios   = $usuarioDAO->dadosUsuario($usuarioDTO);
            $date1      = date('d/m/Y H:i', strtotime($post["DATAPUBLICACAO"]));
        ?>
            <section id="title">
                <a href="posts.php"><img class="logo_p" src="../img/logo_pequeno.png" alt="Logo Pequeno"></a>
                <h1><?= $post["TITULO"] ?></h1>
                <p>Tipo: <?= $post["TIPO"] ?></p>
                <nav id="navComent">
                    <li><a class="button" href="javascript:history.back()">Voltar</a></li>
                </nav>
            </section>
            <main>
                <section id="posts">
                    <div class="post" style="display: block;">

                        <div oncontextmenu="return false">
                            <img id="img_grand" src="../Control/<?= $post["IMAGEM"] ?>" alt="Imagem grande">
                        </div>
                        <div class="content">

                            <div style="width:900px ;" class="description"><?= $post["DESCRICAO"] ?></div>

                            <div class="espaco_botao">
                                <p id="preco">Preço: R$<?= $post["PRECO"] ?></p>
                                <p id="data"><?= $date1 ?></p>
                            </div>

                            <div class="espaco_botao">
                                <a href="visitarPerfil.php?id=<?= $usuarios[0]["ID"] ?>"><?= $usuarios[0]["NICKNAME"] ?></a>
                            </div>
                        </div>
                    </div>

                </section>
            </main>
        <?php
        }
        ?>


        <?php
        foreach ($comentarios as $comment) {
            $_SESSION['COMENTARIO'] = ['id' => $comment["ID"]];
            $idComentador = $comment["USUARIOS_ID"];
            $usuarioDTO   = new UsuarioDTO();
            $usuarioDTO->setIdUsuario($idComentador);
            $usuarioDAO = new UsuarioDAO();
            $usuarios   = $usuarioDAO->dadosUsuario($usuarioDTO);
            $date2      = date('d/m/Y H:i', strtotime($comment["DATACRIACAO"]));

        ?>
            <section id="posts">
                <div class="post" id="coment">

                    <div class="content" style="width:900px ;">

                        <div style="width:900px ;" class=" description" id="coment"><?= $comment["TEXTO"] ?></div>

                        <div class="espaco_botao">
                            <p></p>
                            <p id="data"><?= $date2 ?></p>
                        </div>

                        <a href="visitarPerfil.php?id=<?php echo $comment["USUARIOS_ID"] ?>"><?= $usuarios[0]["NICKNAME"] ?></a>

                        <hr>
                        <div class="espaco_botao">
                            <a onclick="onOff()" href="#">Editar comentário</a>
                            <a class="excluir" onclick="confirmExclusaoComentario()">Excluir comentario</a>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
        ?>

        <div id="modal" class="hide">
            <div class="content">
                <h1>Editar Comentário</h1>

                <form action="../Control/editarComentarioControl.php" method="POST">
                    <input type="hidden" name="COMENTARIO_ID" value="<?= $comentarios[0]["ID"] ?>">
                    <div class="input-wrapper">
                        <label for="description">Novo Comentário</label>
                        <textarea name="TEXTO" cols="30" rows="10" placeholder="Escreva aqui o novo comentário"><?= $comentarios[0]["TEXTO"] ?></textarea>
                    </div>
                    <a href="#" onclick="onOff()">Voltar</a>
                    <button>Salvar</button>
                </form>

            </div>
        </div>


    </div>



    <footer>

        <a href="javascript:history.back()">Voltar</a>

    </footer>




</body>
<script src="../scripts.js"></script>

</html>

<!-- jayemrson -->