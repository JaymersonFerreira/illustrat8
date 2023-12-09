<?php
require_once '../Model/DTO/PostagemDTO.php';
require_once '../Model/DAO/PostagemDAO.php';
require_once '../Model/Conexao.php';

$postId    = $_GET['id'];

$postagemDTO = new PostagemDTO();
$postagemDTO->setIdPostagem($postId);

$postagemDAO = new PostagemDAO();
$postagemDAO->excluirPostagemById( $postagemDTO );

header("location:meusPosts.php?msg=Post excluído com sucesso!");

// $con  = Conexao::getInstance();
// $sql=$con->prepare("DELETE FROM usuarios WHERE id = :id");
// $sql->bindValue(':id',$usuarioId);
// $sql->execute();

// header("location:../?msg=Conta excluída com sucesso!");