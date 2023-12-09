<?php
require_once '../Model/DTO/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";
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
      $hash = 'posts.php?msg=Somente ilustradores podem postar.';
} else {
      $hash = '#';
}

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
      <link rel="shortcut icon" href="../img/logo.ico">

      <link rel="stylesheet" href="../dist/ui/trumbowyg.min.css">
      <link rel="stylesheet" href="../dist/plugins/emoji/ui/trumbowyg.emoji.min.css">

      <title>ILLUSTR8</title>
</head>

<body id="page-posts">
      <div id="container">
            <header>
                  <a href="posts.php">
                        <img src="../img/logo.png" alt="Imagem de Logomarca">
                  </a>

                  <nav>
                        

                        <li><a class="button" href="meuPerfil.php">Meu Perfil</a></li>
                        <li><a class="button" href="<?= $hash; ?>" onclick="onOff()">Novo Post</a></li>
                        <li><a class="button" href="logout.php">Sair</a></li>
                        <!-- <li><a class="button" href="">Login</a></li> -->
                  </nav>
            </header>
            <section id="title">

                  <a href="#">
                        <img class="logo_p" src="../img/logo_pequeno.png" alt="Logo Pequeno">
                  </a>

                  <h1>POSTS</h1>
                  <p>em exibição</p>

                  <div class="espaco_botao">
                        <div style="margin-top: 40px;"><a  class="button" href="pesquisarPosts.php">Buscar Posts</a></div>
                        <div style="margin-top: 40px;"><a  class="button" href="pesquisarUsuarios.php">Buscar Usuários</a></div>
                  </div>

            </section>
            <main>
                  <section id="posts">
                        <?php
                        require_once "../Model/DAO/PostagemDAO.php";
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
                                    <a href="verMais.php?id=<?= $post["ID"] ?>">
                                          <div id="backImg" style="background-image: url('../Control/<?= $post["IMAGEM"] ?>');" class="imgPost"></div>
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
                                                      <a href="visitarPerfil.php?id=<?= $usuarios[0]["ID"] ?>"><?= $usuarios[0]["NICKNAME"] ?></a>
                                                      
                                                      <a href="verMais.php?id=<?= $post["ID"] ?>">Ver Mais</a>
                                                </div>
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
                        <h1>Novo Post</h1>

                        <form action="../Control/cadastroPostagemControl.php" method="POST" enctype="multipart/form-data">

                              <div class="input-whapper">
                                    <input type="hidden" name="USUARIOID" value="<?= $usuarioId; ?>">
                                    <label for="title">Título do post</label>
                                    <input type="text" name="TITULO" required placeholder="Título">
                              </div>

                              <div class="input-wrapper">
                                    <label for="cadegory">Tipo</label>
                                    <select style="border: 3px solid #ffffff40;
                                    border-radius: 8px;" name="TIPO" id="">
                                          <option value="FISICA">Física</option>
                                          <option value="DIGITAL">Digital</option>
                                    </select>
                              </div>

                              <div class="input-wrapper">
                                    <label for="preco">Preço</label>
                                    <input type="number" name="PRECO" placeholder="R$ 0,00">
                              </div>

                              <div class="input-wrapper">

                                    <label for="">Imagem</label>
                                    <input id="imagem" onchange="previewImagem()" required accept="image/*" type="file" name="IMAGEM">
                                    <img id="imgForm">


                              </div>

                              <div class="input-wrapper">
                                    <label for="description">Descrição</label>
                                    <div><textarea required name="DESCRICAO" id="editor" cols="30" rows="10" placeholder="Digite uma descrição para este post"></textarea></div>
                              </div>



                              <a href="#" onclick="onOff()">Voltar</a>
                              <button>Postar</button>

                        </form>


                  </div>
            </div>

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
                        echo "<a href='posts.php?page=1'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/anterior.png' alt='proximo'></a> ";
                  }
            }

            echo " <p ><a style='font-size: 2.5em;' href='#'>$pagina</a></p>";

            for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
                  if ($proxima_pagina <= $qnt_pagina) {
                        echo "<a href='posts.php?page=$proxima_pagina'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/proximo.png' alt='proximo'></a> ";
                  } else {
                        echo "<a href='posts.php?page=$qnt_pagina'><img style='width: 50px; height: 50px; opacity: 0.7; margin: 0 20px;' src='../img/proximo.png' alt='proximo'></a> ";
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