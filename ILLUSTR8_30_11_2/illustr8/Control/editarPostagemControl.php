<?php
require_once "../Model/DTO/PostagemDTO.php";
require_once "../Model/DAO/PostagemDAO.php";

$titulo     = filter_input( INPUT_POST, 'TITULO' );
$tipo       = filter_input( INPUT_POST, 'TIPO' );
$descricao  = filter_input( INPUT_POST, 'DESCRICAO' );
$preco      = filter_input( INPUT_POST, 'PRECO' );
$postagemId = filter_input( INPUT_POST, 'POSTAGEM_ID' );

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

$postagemDTO->setIdPostagem( $postagemId );
$postagemDTO->setTitulo( $titulo );
$postagemDTO->setDescricao( $descricao );
$postagemDTO->setPreco( $preco );
$postagemDTO->setTipo( $tipo );

// echo "<pre>";
// echo print_r( $postagemDTO );die;

$postagemDAO = new PostagemDAO();
$postagemDAO->alterarPostagem( $postagemDTO );

header( "location: ../View/meusPosts.php?msg=Post alterado com sucesso." );
?>