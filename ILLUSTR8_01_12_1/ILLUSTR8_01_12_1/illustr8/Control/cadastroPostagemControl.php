<?php
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";

$path = null;
if ( isset( $_FILES['IMAGEM'] ) ) {
    $arquivo = $_FILES['IMAGEM'];

    if ( $arquivo['error'] ) {
        die( "Falha ao enviar imagem." );
    }

    if ( $arquivo['size'] > 5242880 ) {
        die( "Arquivo muito grande!! Max: 5MB" );
    }

    $pasta             = "posts/";
    $nomeDoArquivo     = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao          = strtolower( pathinfo( $nomeDoArquivo, PATHINFO_EXTENSION ) );

    // if ( $extensao != "jpg" && $extensao != "png" ) {
    //     die( "Tipo de arquivo não aceito" );
    // }

    $path      = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file( $arquivo["tmp_name"], $path );
    if ( $deu_certo ) {
        $imagem = $path;
    } else {
        echo "<p>Falha ao enviar arquivo</p>";
    }

}

$titulo    = filter_input( INPUT_POST, 'TITULO' );
$descricao = filter_input( INPUT_POST, 'DESCRICAO' );
$usuarioId = filter_input( INPUT_POST, 'USUARIOID' );
$preco     = filter_input( INPUT_POST, 'PRECO' );
$tipo      = filter_input( INPUT_POST, 'TIPO' );

$postagemDTO = new PostagemDTO();

$postagemDTO->setPreco( $preco );
$postagemDTO->setTitulo( $titulo );
$postagemDTO->setDescricao( $descricao );
$postagemDTO->setImagem( $imagem );
$postagemDTO->setUsuarioId( $usuarioId );
$postagemDTO->setTipo( $tipo );

$postagemDAO = new PostagemDAO();
$postagemDAO->cadastrarPostagem( $postagemDTO );

header( 'Location:../View/posts.php?msg=Post realizado com sucesso!' );