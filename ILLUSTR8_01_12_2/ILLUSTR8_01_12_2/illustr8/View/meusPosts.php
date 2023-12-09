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

if ($perfil != 'ARTISTA') {
    header('location:meuPerfil.php?msg=Somente ilustradores podem postar.');
}

//   if($perfil != 'ARTISTA') {
//     header('location: permissao.php?msg=Usuário sem permissão.');
// }

echo  "$usuarioId _ ";
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

    <link rel="stylesheet" href="../dist/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="../dist/plugins/emoji/ui/trumbowyg.emoji.min.css">



    <title>Illustr8</title>
</head>

<body id="page-posts">
    <div id="container">
        <header>
            <a href="posts.php">
                <img src="../img/logo.png" alt="Imagem de Logomarca">
            </a>

            <nav>
                <li><a class="button" href="posts.php">Voltar</a></li>
                <li><a class="button" href="posts.php">Página Inícial</a></li>
                <li><a class="button" href="logout.php">Sair</a></li>
                <!-- <li><a class="button" href="">Login</a></li> -->
            </nav>
        </header>
        <section id="title">
            <img class="logo_p" src="../img/logo_pequeno.png" alt="Foto do Perfil">
            <h1>Meus Posts</h1>
            <p>Editar ou Excluir</p>
            <div style="margin-top: 40px;"><a  class="button" href="pesquisarMeusPosts.php">Buscar</a></div>
        </section>
        <main>
            <section id="posts">
                <?php
                $postagemDTO = new PostagemDTO();
                $postagemDTO->setUsuarioId($usuarioId);

                $postagemDAO = new PostagemDAO();
                $postagens = $postagemDAO->listarMeusPosts($postagemDTO);

                ?>
                <?php
                foreach ($postagens as $post) {
                    $date1 = date('d/m/Y H:i', strtotime($post["DATAPUBLICACAO"]));

                ?>
                    <div class="post">
                        <a href="editarPost.php?id=<?php echo $post["ID"] ?>">
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
                                <p></p>
                                <a href="detalhes.php?id=<?php echo $post["ID"] ?>">Detalhes</a>
                                <p></p>
                            </div>
                        </div>
                    </div>


                <?php
                }
                ?>

            </section>
        </main>

    </div>
        <footer>

            <?php

            //Receber o número da página
            $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
            //var_dump($pagina);

            //Setar a quantidade de registros por página
            $limite_resultado = 5;

            // Calcular o inicio da visualização
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;


            $con  = Conexao::getInstance();

            //Contar a quantidade de registros no BD
            $sql = "SELECT COUNT(ID) AS num_result FROM postagens";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $row_qnt_registros = $stmt->fetch(PDO::FETCH_ASSOC);



            //Quantidade de página
            $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

            // Maximo de link
            $maximo_link = 1;

            echo "<a href='posts.php?page=1'>Primeira</a> ";

            for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
                if ($pagina_anterior >= 1) {
                    echo "<a href='posts.php?page=$pagina_anterior'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/anterior.png' alt='anterior'></a>";
                } else {
                    echo "<a href='#'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/anterior.png' alt='proximo'></a> ";
                }
            }

            echo " <p ><a style='font-size: 2em;' href='#'>$pagina</a></p>";

            for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
                if ($proxima_pagina <= $qnt_pagina) {
                    echo "<a href='posts.php?page=$proxima_pagina'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/proximo.png' alt='proximo'></a> ";
                } else {
                    echo "<a href='#'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/proximo.png' alt='proximo'></a> ";
                }
            }

            echo "<a href='posts.php?page=$qnt_pagina'>Última</a> ";
            // // } else {
            // //       echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
            // // }
            ?>

        </footer>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="../scripts.js"></script>

</html>