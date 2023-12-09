<?php
    require_once '../Model/DAO/UsuarioDAO.php';
    require_once '../Model/DTO/UsuarioDTO.php';
    require_once "../Model/DTO/PostagemDTO.php";
    require_once '../Model/Conexao.php';

    session_start();
    if ( !isset( $_SESSION['USUARIO'] ) ) {
        session_destroy();
        header( 'location: ../?msg=Você precisa estar logado para acessar esta função!' );
        die();
    }
    $idPerfilVisitado = isset( $_GET['id'] ) ? $_GET['id'] : '';
    echo $idPerfilVisitado;

    $usuarioId = $_SESSION['USUARIO']["id"];
    echo $usuarioId;

    $con = Conexao::getInstance();
    $sql = $con->prepare( "SELECT * FROM usuarios WHERE ID = :ID" );
    $sql->bindValue( ':ID', $idPerfilVisitado );
    $sql->execute();
    $user = $sql->fetchAll( PDO::FETCH_ASSOC );

    // echo "<pre>";
    // print_r($user);

    // echo $user[0]['NOME'];

    

    $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
    echo $msg;

    $foto_perfil = "../Control/" . $user[0]["FOTO"];

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
            </nav>
        </header>
        <section id="title">
            
                <!-- COMETADO -->
                <!-- <img id="foto_perfil" src="<?=$foto_perfil?>" alt="Foto do Perfil"> -->

                <img id="foto_perfil" src="<?=$foto_perfil?>" alt="Foto do Perfil">

            <!-- COMENTADO -->
            <!-- <h1><?=$user[0]['NOME']?></h1>
            <p><?=$user[0]['NICKNAME']?></p> -->

            <h1><?=$user[0]["NOME"]?></h1>
            <p><?=$user[0]["NICKNAME"]?></p>

            <div class="descriptionPerfil">

                <!-- COMENTADO -->
                <!-- <p><?=$user[0]['DESCRICAO_USUARIO']?></p> -->

                <p><?=$user[0]["DESCRICAO_USUARIO"]?></p>

                <div>
                    <a target="_blank" href="<?=$user[0]['INSTAGRAM']?>"><img class="rede_social" src="../img/icone_instagram.png" alt="Ícone Instagram"></a>
                    <a target="_blank" href="<?=$user[0]['FACEBOOK']?>"><img class="rede_social" src="../img/icone_facebook.png" alt="Ícone Facebook"></a>
                    <a target="_blank" href="<?=$user[0]['TWITTER']?>"><img class="rede_social" src="../img/icone_twitter.png" alt="Ícone Twitter"></a>
                    <a target="_blank" href="<?=$user[0]['PINTEREST']?>"><img class="rede_social" src="../img/icone_pinterest.png" alt="Ícone pinterest"></a>
                    <p><strong>CONTATOS</strong></p>
                </div>


        </section>
        <div>
            <section id="posts">
                <nav>
                    <li><a class="button" href="visitarPosts.php?id=<?php echo $idPerfilVisitado?>">Posts</a></li>
                </nav>

            </section>
        </div>

        <script src="../scripts.js"></script>

    </div>
</body>

</html>