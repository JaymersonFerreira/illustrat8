<?php
    require_once 'Model/DTO/UsuarioDTO.php';
    require_once 'Model/DAO/UsuarioDAO.php';
    require_once "Model/DTO/PostagemDTO.php";
    require_once "Model/DAO/PostagemDAO.php";
    require_once 'functions/limita-texto.php';
    require_once 'Model/Conexao.php';

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
    echo $msg;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="css/style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">

    <title>Illustr8</title>
</head>

<body id="page-posts">
    <div id="container">
        <header>
            <a href="">
                <img src="img/logo.png" alt="Imagem de Logomarca">
            </a>

            <nav>
                <li><a class="button" href="View/login.php">Login</a></li>
            </nav>
        </header>
        <section id="title">
            <a href=""><img class="log_p" src="img/logo_pequeno.png" alt="Logo Pequeno"></a>
            <h1>POSTS</h1>
            <p>em exibição</p>
        </section>
        <main>
            <section id="posts">

            <?php
                        $postagemDAO = new PostagemDAO();
                        $postagens = $postagemDAO->listarTodos();

                        ?>
                        <?php
                        foreach ($postagens as $post) {
                              $idArtista = $post["USUARIOS_ID"];
                              $usuarioDTO = new UsuarioDTO();
                              $usuarioDTO->setIdUsuario($idArtista);
                              $usuarioDAO = new UsuarioDAO();
                              $usuarios = $usuarioDAO->dadosUsuario($usuarioDTO);
                              $date1 = date('d/m/Y H:i', strtotime($post["DATAPUBLICACAO"]));

                        ?>
                              <div class="post">
                                    <a href="View/verMais.php?id=<?= $post["ID"] ?>">
                                          <div id="backImg" style="background-image: url('Control/<?= $post["IMAGEM"] ?>');" class="imgPost"></div>
                                    </a>
                                    <div class="content">
                                          <h3>Título: <?= $post["TITULO"] ?></h3>
                                          <p id="tipo">Tipo: <?= $post["TIPO"] ?></p>
                                          <div class="description"><strong>Descrição:</strong>
                                                <div id="up"> <?php echo limitarTexto($post["DESCRICAO"], $limite = 269) ?></div>
                                          </div>
                                          <!--  -->
                                          <div id="preco_data">
                                                <div class="espaco_botao">
                                                      <p id="preco">Preço: R$<?= $post["PRECO"] ?></p>
                                                      <p id="data"><?= $date1; ?></p>

                                                </div>
                                                <div class="espaco_botao">
                                                      <a href="View/visitarPerfil.php?id=<?= $usuarios[0]["ID"] ?>"><?= $usuarios[0]["NICKNAME"] ?></a>
                                                      
                                                      <a href="View/verMais.php?id=<?= $post["ID"] ?>">Ver Mais</a>
                                                </div>
                                          </div>
                                    </div>
                              </div>

                        <?php
                        }
                        ?>

            </section>
        </main>




    </div>

</body>

</html>