<?php
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";

    $titulo     = filter_input(INPUT_POST, 'TITULO');
    $tipo       = filter_input( INPUT_POST, 'TIPO' );
    $descricao  = filter_input( INPUT_POST, 'DESCRICAO' );
    $preco      = filter_input( INPUT_POST, 'PRECO' );
    $postagemId = filter_input( INPUT_POST, 'POSTAGEMID' );
    $usuarioId  = filter_input( INPUT_POST, 'USUARIOID' );

    // echo $nome, "<br>";
    // echo $foto, "<br>";
    // echo $nickname, "<br>";
    // echo $descricaopostagem, "<br>";
    // echo $instagram, "<br>";
    // echo $facebook, "<br>";
    // echo $linkedin, "<br>";
    // echo $twitter, "<br>";
    // echo $senha, "<br>";

    $postagemDTO = new PostagemDTO();

    $postagemDTO->setIdPostagem($postagemId);
    $postagemDTO->setUsuarioId($usuarioId);
    $postagemDTO->setTitulo( $titulo );
    $postagemDTO->setDescricaopostagem( $descricaopostagem );
    $postagemDTO->setInstagram( $instagram );
    $postagemDTO->setFacebook( $facebook);
    $postagemDTO->setPinterest( $pinterest);
    $postagemDTO->setTwitter( $twitter);
    $postagemDTO->setSenha( $senha );

    $postagemDAO = new postagemDAO();
    $postagemDAO->alterarpostagem( $postagemDTO );

    header("location: ../View/meuPerfil.php?msg=Perfil alterado com sucesso.");
} else {
    header( "location: ../View/meuPerfil.php?msg=As senhas devem ser iguais." );
}
?>