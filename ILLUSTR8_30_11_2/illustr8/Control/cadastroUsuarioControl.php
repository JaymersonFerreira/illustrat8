<?php
require_once "../Model/DTO/UsuarioDTO.php";
require_once "../Model/DAO/UsuarioDAO.php";

if ( $_POST["SENHA"] === $_POST["CONFIRMA_SENHA"] ) {
    $perfil   = filter_input( INPUT_POST, 'PERFIL' );
    $nome     = filter_input( INPUT_POST, 'NOME' );
    $nickname = filter_input( INPUT_POST, 'NICKNAME' );
    $cpf_cnpj = filter_input( INPUT_POST, 'CPF_CNPJ' );
    $email    = filter_input( INPUT_POST, 'EMAIL', FILTER_VALIDATE_EMAIL );
    $senha    = filter_input( INPUT_POST, 'SENHA' );
    $senha    = md5( $senha );

    $usuarioDTO = new UsuarioDTO();

    $usuarioDTO->setPerfil( $perfil );
    $usuarioDTO->setNome( $nome );
    $usuarioDTO->setNickName( $nickname );
    $usuarioDTO->setCpfCnpj( $cpf_cnpj );
    $usuarioDTO->setEmail( $email );
    $usuarioDTO->setSenha( $senha );

    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->cadastrarUsuario( $usuarioDTO );

    header( 'Location:../View/login.php?msg=Cadastro efetuado com sucesso!' );
} else {
    header( 'location: ../View/cadastro.php?msg=As senhas devem ser iguais.' );
}
