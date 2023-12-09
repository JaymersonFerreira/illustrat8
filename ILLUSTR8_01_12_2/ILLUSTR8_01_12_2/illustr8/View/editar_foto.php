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

    // $con = Conexao::getInstance();
    // $sql = $con->prepare( "SELECT * FROM usuarios WHERE id = :id" );
    // $sql->bindValue( ':id', $usuarioId );
    // $sql->execute();
    // $user = $sql->fetchAll( PDO::FETCH_ASSOC );

    // echo "<pre>";
    // print_r($user);

    // echo $user[0]['NOME'];

    $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
    echo $msg;

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="../css/edit_ft.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">


    <title>Foto do Perfil</title>
</head>

<body id="page-posts">
    <div id="container">
        
            <div class="content">
                <h1>Foto do Perfil</h1>

                <form action="../Control/editarFotoPerfilControl.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="usuarioId" value="<?=$usuarioId?>">

                    <div class="input-wrapper">

                        <div class="foto">
                            <img id="imgFoto">
                        </div>

                        <input id="foto" onchange="previewFoto()" accept="image/*" type="file" name="foto">
                    </div>

                    <div class="espaco_botao">
                    <a class="voltar" href="meuPerfil.php">Voltar</a>
                    <button class="button">Salvar</button>
                </div>

                </form>

            </div>

    
        


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


        <script src="../scripts.js"></script>

    </div>
</body>

</html>