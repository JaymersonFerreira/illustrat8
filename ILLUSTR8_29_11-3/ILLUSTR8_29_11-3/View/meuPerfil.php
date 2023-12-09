<?php
    require_once '../Model/DAO/UsuarioDAO.php';
    require_once '../Model/DTO/UsuarioDTO.php';
    require_once "../Model/DTO/PostagemDTO.php";
    require_once '../Model/Conexao.php';

    session_start();
    if ( !isset( $_SESSION['USUARIO'] ) ) {
        session_destroy();
        header( 'location: login.php' );
        die();
    }

    $usuarioId = $_SESSION['USUARIO']["id"];
    echo $usuarioId;

    $con = Conexao::getInstance();
    $sql = $con->prepare( "SELECT * FROM usuarios WHERE id = :id" );
    $sql->bindValue( ':id', $usuarioId );
    $sql->execute();
    $user = $sql->fetchAll( PDO::FETCH_ASSOC );

    // echo "<pre>";
    // print_r($user);

    // echo $user[0]['NOME'];

    $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
    echo $msg;

    $foto_perfil = "../Control/" . $user[0]['FOTO'];

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
                <li><a class="button" href="javascript:history.back()">Voltar</a></li>
                <li><a class="button" href="#" onclick="onOff()">Editar Perfil</a></li>
                <li><a class="button" onclick="confirmExclusao()">Excluir Conta</a></li>
                <li><a class="button" href="logout.php">Sair</a></li>
            </nav>
        </header>
        <section id="title">
            
            <a href="editar_foto.php
            "><img id="foto_perfil" src="<?=$foto_perfil?>" alt="Foto do Perfil"></a>

            <h1><?=$user[0]['NOME']?></h1>
            <p><?=$user[0]['NICKNAME']?></p>

            <div class="descriptionPerfil">
                <p><?=$user[0]['DESCRICAO_USUARIO']?></p>

                <div>
                    <a target="_blank" href="<?=$user[0]['INSTAGRAM']?>"><img class="rede_social" src="../img/icone_instagram.png" alt="Ícone Instagram"></a>
                    <a target="_blank" href="<?=$user[0]['FACEBOOK']?>"><img class="rede_social" src="../img/icone_facebook.png" alt="Ícone Facebook"></a>
                    <a target="_blank" href="<?=$user[0]['TWITTER']?>"><img class="rede_social" src="../img/icone_twitter.png" alt="Ícone Twitter"></a>
                    <a target="_blank" href="<?=$user[0]['PINTEREST']?>"><img class="rede_social" src="../img/icone_pinterest.png" alt="Ícone pinterest"></a>
                    <p id="contatos"><strong>CONTATOS</strong></p>
                </div>


        </section>
        <div>
            <section id="posts">
                <nav>
                    <li><a class="button" href="meusPosts.php">Meus Posts</a></li>
                    <li><a class="button" href="meusComentarios.php">Meus Comentários</a></li>
                </nav>

            </section>
        </div>

        <div id="modal" class="hide">
            <div class="content">
                <h1>Editar perfil</h1>

                <form action="../Control/editarUsuarioControl.php" method="POST">

                    <div class="input-whapper">
                        <input type="hidden" name="usuarioId" value="<?=$usuarioId?>">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="<?=$user[0]['NOME']?>" placeholder="Nome">
                    </div>

                    <div class="input-wrapper">
                        <label for="Nickname">Nickname</label>
                        <input type="text" name="nickname" value="<?=$user[0]['NICKNAME']?>" placeholder="Nickname">
                    </div>

                    <!-- <div class="input-wrapper">
                        <label for="">Foto do Perfil</label>
                        <input id="foto" onchange="previewFoto()" accept="image/*" type="file" name="foto">
                        <img id="imgFoto">
                    </div> -->

                    <div class="input-wrapper, editor">
                        <label for="description">Descrição</label>
                        <textarea name="descricaoUsuario" id="editor" cols="30" rows="10" placeholder="Digite uma descrição para você"><?=$user[0]['DESCRICAO_USUARIO']?></textarea>
                    </div>

                    <div class="input-wrapper">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" required placeholder="********">
                    </div>

                    <div class="input-wrapper">
                        <label for="senha">Confirme senha</label>
                        <input type="password" name="confirma_senha" required placeholder="********">
                    </div>

                    <div class="input-wrapper">
                        <label for="instagram">Instagram</label>
                        <input type="link" name="instagram" value="<?=$user[0]['INSTAGRAM']?>" placeholder="Link do Instagram">
                    </div>

                    <div class="input-wrapper">
                        <label for="facebook">Facebook</label>
                        <input type="link" name="facebook" value="<?=$user[0]['FACEBOOK']?>" placeholder="Link do Facebook">
                    </div>
                    
                    <div class="input-wrapper">
                        <label for="twitter">Twitter</label>
                        <input type="link" name="twitter" value="<?=$user[0]['TWITTER']?>" placeholder="Link do Twitter">
                    </div>
                    
                    <div class="input-wrapper">
                        <label for="pinteres">Pinterest</label>
                        <input type="link" name="pinterest" value="<?=$user[0]['PINTEREST']?>" placeholder="Link do Pinterest">
                    </div>

                    <div class="espaco_botao">
                        <a href="#" onclick="onOff()">Voltar</a>
                        <button>Salvar</button>
                    </div>

                </form>

            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <script src="../dist/trumbowyg.min.js"></script>

            <script type="text/javascript" src="../dist/langs/pt_br.min.js"></script>

            <script src="../dist/plugins/emoji/trumbowyg.emoji.min.js"></script>

           


        <script src="../scripts.js"></script>

    </div>
</body>

</html>