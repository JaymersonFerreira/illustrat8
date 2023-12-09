<?php
require_once "../Model/DTO/UsuarioDTO.php";
require_once "../Model/DAO/UsuarioDAO.php";

// $path=null;
// if (isset($_FILES['foto'])) {
//     $arquivo = $_FILES['foto'];
    
//     if ($arquivo['error']){
//         die("Falha ao enviar foto.");
//     }

//     if ($arquivo['size']>5242880){
//         die("Arquivo muito grande!! Max: 5MB");
//     }
    
//     $pasta = "foto_perfil/";
//     $nomeDoArquivo = $arquivo['name'];
//     $novoNomeDoArquivo = uniqid();
//     $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

//     if ($extensao != "jpg" && $extensao != "png"){
//         die("Tipo de arquivo não aceito");
//     }

//     $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
//     $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
//     if ($deu_certo){
//         $foto = $path;
//     }else {
//         echo "<p>Falha ao enviar arquivo</p>";
//     }

// }

if ( $_POST["senha"] === $_POST["confirma_senha"] ) {
    $usuarioId          = filter_input(INPUT_POST, 'usuarioId');
    $nome               = filter_input( INPUT_POST, 'nome' );
    $nickname           = filter_input( INPUT_POST, 'nickname' );
    $descricaoUsuario   = filter_input( INPUT_POST, 'descricaoUsuario' );
    $instagram          = filter_input( INPUT_POST, 'instagram');
    $facebook           = filter_input( INPUT_POST, 'facebook');
    $pinterest           = filter_input( INPUT_POST, 'pinterest');
    $twitter            = filter_input( INPUT_POST, 'twitter');
    $senha              = filter_input( INPUT_POST, 'senha' );
    $senha              = md5( $senha );

    // echo $nome, "<br>";
    // echo $foto, "<br>";
    // echo $nickname, "<br>";
    // echo $descricaoUsuario, "<br>";
    // echo $instagram, "<br>";
    // echo $facebook, "<br>";
    // echo $linkedin, "<br>";
    // echo $twitter, "<br>";
    // echo $senha, "<br>";

    $usuarioDTO = new UsuarioDTO();

    $usuarioDTO->setIdUsuario($usuarioId);
    $usuarioDTO->setNome( $nome );
    $usuarioDTO->setNickName( $nickname );
    // $usuarioDTO->setFoto( $foto);
    $usuarioDTO->setDescricaoUsuario( $descricaoUsuario );
    $usuarioDTO->setInstagram( $instagram );
    $usuarioDTO->setFacebook( $facebook);
    $usuarioDTO->setPinterest( $pinterest);
    $usuarioDTO->setTwitter( $twitter);
    $usuarioDTO->setSenha( $senha );

    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->alterarUsuario( $usuarioDTO );

    header("location: ../View/meuPerfil.php?msg=Perfil alterado com sucesso.");
} else {
    header( "location: ../View/meuPerfil.php?msg=As senhas devem ser iguais." );
}
?>