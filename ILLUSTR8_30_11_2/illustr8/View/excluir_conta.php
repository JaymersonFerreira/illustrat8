<?php
require_once '../Model/DTO/UsuarioDTO.php';
require_once '../Model/DAO/UsuarioDAO.php';
require_once '../Model/Conexao.php';
session_start();

$usuarioId = $_SESSION['USUARIO']["id"];

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setIdUsuario($usuarioId);

$usuarioDAO = new UsuarioDAO();
$usuarioDAO->excluirUsuarioById( $usuarioDTO );

header("location:../?msg=Conta excluída com sucesso!");


// $con  = Conexao::getInstance();
// $sql=$con->prepare("DELETE FROM usuarios WHERE id = :id");
// $sql->bindValue(':id',$usuarioId);
// $sql->execute();

// header("location:../?msg=Conta excluída com sucesso!");