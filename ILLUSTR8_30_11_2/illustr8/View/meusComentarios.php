<?php
require_once '../Model/DTO/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";
require_once "../Model/DTO/ComentarioDTO.php";
require_once "../Model/DAO/ComentarioDAO.php";
require_once '../functions/limita-texto.php';
require_once '../Model/Conexao.php';

session_start();
if (!isset($_SESSION['USUARIO'])) {
    session_destroy();
    header('location: login.php');
    die();
}

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
echo $msg;

$usuarioId = $_SESSION['USUARIO']["id"];
$perfil    = $_SESSION['USUARIO']["perfil"];
$hash      = null;

$comentarioDTO = new ComentarioDTO();
$comentarioDTO->setUsuarioId($usuarioId);

$comentarioDAO = new ComentarioDAO();
$comentarios = $comentarioDAO->listarMeusComentarios($comentarioDTO);

// if ($perfil != 'ARTISTA') {
//       header('location:meuPerfil.php?msg=Somente ilustradores podem postar.');
// }

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
        <header>
            <a href="posts.php">
                <img src="../img/logo.png" alt="Imagem de Logomarca">
            </a>

            <nav>
                <li><a class="button" href="javascript:history.back()">Voltar</a></li>
                <li><a class="button" href="posts.php">Página Inícial</a></li>
                <li><a class="button" href="#">Sair</a></li>
                <!-- <li><a class="button" href="">Login</a></li> -->
            </nav>
        </header>
        <section id="title">
            <a href="#">
                <img class="logo_p" src="../img/logo_pequeno.png" alt="Foto do Perfil">
            </a>
            <h1>Meus Comentários</h1>
            <p>Editar ou Excluir</p>
            <div style="margin-top: 40px;"><a  class="button" href="pesquisarMeusComentarios.php">Buscar</a></div>

        </section>
        <main>
            <section id="posts">
                <?php
                foreach ($comentarios as $comment) {
                    $idPostagem = $comment["POSTAGENS_ID"];
                    $postagemDTO = new PostagemDTO();
                    $postagemDTO->setIdPostagem($idPostagem);

                    $postagemDAO = new PostagemDAO();
                    $postagens = $postagemDAO->verMais($postagemDTO);
                    $date2 = date('d/m/Y H:i', strtotime($comment["DATACRIACAO"]));

                ?>
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
                <?php
                }
                ?>

            </section>
        </main>

        <div id="modal" class="hide">
            <div class="content">
                <h1>Editar Comentário</h1>

                <form action="">

                    <div class="input-wrapper">
                        <label for="description">Novo Comentário</label>
                        <textarea name="description" cols="30" rows="10" placeholder="Escreva aqui o novo comentário"></textarea>
                    </div>



                    <a href="#" onclick="onOff()">Voltar</a>
                    <button>Salvar</button>

                </form>

            </div>
        </div>

        <script src="../scripts.js"></script>


    </div>
    <footer>

            <a href="javascript:history.back()">Voltar</a>

    </footer>
</body>

</html>