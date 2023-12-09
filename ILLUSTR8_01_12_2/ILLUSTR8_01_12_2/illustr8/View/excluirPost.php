<?php
require_once '../Model/DTO/PostagemDTO.php';
require_once '../Model/DAO/PostagemDAO.php';
require_once '../Model/Conexao.php';
session_start();

$postId = $_SESSION['POSTAGEM']["id"];

$postagemDTO = new PostagemDTO();
$postagemDTO->setIdPostagem( $postId );

// echo $postId;die;

$postagemDAO = new PostagemDAO();
$postagemDAO->excluirPostagemById( $postagemDTO );

header( "location:meusPosts.php?msg=Post excluído com sucesso!" );

// $con  = Conexao::getInstance();
// $sql=$con->prepare("DELETE FROM usuarios WHERE id = :id");
// $sql->bindValue(':id',$usuarioId);
// $sql->execute();

// header("location:../?msg=Conta excluída com sucesso!");