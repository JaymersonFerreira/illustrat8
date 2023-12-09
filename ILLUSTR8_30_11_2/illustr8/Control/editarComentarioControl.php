<?php
require_once "../Model/DTO/ComentarioDTO.php";
require_once "../Model/DAO/ComentarioDAO.php";

$texto     = filter_input( INPUT_POST, 'TEXTO' );
$comentarioId = filter_input( INPUT_POST, 'COMENTARIO_ID' );

// echo $nome, "<br>";
// echo $foto, "<br>";
// echo $nickname, "<br>";
// echo $descricaopostagem, "<br>";
// echo $instagram, "<br>";
// echo $facebook, "<br>";
// echo $linkedin, "<br>";
// echo $twitter, "<br>";
// echo $senha, "<br>";

$comentarioDTO = new ComentarioDTO();

$comentarioDTO->setTexto( $texto );
$comentarioDTO->setIdComentario( $comentarioId );

// echo "<pre>";
// echo print_r( $postagemDTO );die;

$comentarioDAO = new ComentarioDAO();
$comentarioDAO->alterarComentario( $comentarioDTO );

header( "location: ../View/meusComentarios.php?msg=Comentário alterado com sucesso." );
?>