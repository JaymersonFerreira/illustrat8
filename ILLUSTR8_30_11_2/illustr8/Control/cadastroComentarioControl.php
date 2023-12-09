<?php
require_once "../Model/DTO/ComentarioDTO.php";
require_once "../Model/DAO/ComentarioDAO.php";

$texto    = filter_input( INPUT_POST, 'TEXTO' );
$usuarioId = filter_input( INPUT_POST, 'USUARIOID' );
$postagemId = filter_input( INPUT_POST, 'POSTAGEMID' );

$comentarioDTO = new ComentarioDTO();

$comentarioDTO->setTexto( $texto );
$comentarioDTO->setUsuarioId( $usuarioId );
$comentarioDTO->setPostagemId( $postagemId );

$comentarioDAO = new ComentarioDAO();
$comentarioDAO->cadastrarComentario( $comentarioDTO );

header( 'Location:../View/verMais.php?id='.$postagemId );