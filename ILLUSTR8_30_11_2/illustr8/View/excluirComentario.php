<?php
require_once '../Model/DTO/ComentarioDTO.php';
require_once '../Model/DAO/ComentarioDAO.php';
require_once '../Model/Conexao.php';
session_start();

$comentarioId = $_SESSION['COMENTARIO']["id"];

$comentarioDTO = new ComentarioDTO();
$comentarioDTO->setIdComentario( $comentarioId );

// echo $comentarioId;die;

// echo $postId;die;

$comentarioDAO = new ComentarioDAO();
$comentarioDAO->excluirComentarioById( $comentarioDTO );

header( "location:meusComentarios.php?msg=Comentario excluído com sucesso!" );

// $con  = Conexao::getInstance();
// $sql=$con->prepare("DELETE FROM usuarios WHERE id = :id");
// $sql->bindValue(':id',$usuarioId);
// $sql->execute();

// header("location:../?msg=Conta excluída com sucesso!");