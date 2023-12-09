<?php
session_start();
require_once '../Model/DAO/UsuarioDAO.php';
require_once '../Model/DTO/UsuarioDTO.php';

$email = trim( filter_input( INPUT_POST, 'EMAIL', FILTER_VALIDATE_EMAIL ) );
$senha = trim( filter_input( INPUT_POST, 'SENHA' ) );
$senha = md5( $senha );

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setEmail( $email );
$usuarioDTO->setSenha( $senha );

$usuarioDAO    = new UsuarioDAO();
$usuarioLogado = $usuarioDAO->logar( $usuarioDTO );

if ( $usuarioLogado != NULL ) {
    $_SESSION['USUARIO'] = [
        'id'       => $usuarioLogado->getIdUsuario(),
        'nome'     => $usuarioLogado->getNome(),
        'perfil'   => $usuarioLogado->getPefil(),
        'nickname' => $usuarioLogado->getNickName(),
        'senha'    => $usuarioLogado->getSenha(),
    ];
    header( 'location: ../View/posts.php' );
} else {
    session_destroy();
    header( 'location:../View/login.php?msg=Email ou senha inválidos.' );
}
