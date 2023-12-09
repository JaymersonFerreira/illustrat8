<?php
require_once __DIR__ . '/../Conexao.php';
require_once __DIR__ . '/../DTO/UsuarioDTO.php';
class UsuarioDAO {

    public function logar( UsuarioDTO $usuarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "SELECT id, email, nome, nickname, perfil, cpf_cnpj
            FROM USUARIOS  where email =? AND senha=?";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getEmail() );
            $stmt->bindValue( 2, $usuarioDTO->getSenha() );
            $stmt->execute();
            $usuarioFetch = $stmt->fetch( PDO::FETCH_ASSOC );

            if ( $usuarioFetch != NULL ) {
                $usuario = new UsuarioDTO();
                $usuario->setIdUsuario( $usuarioFetch["id"] );
                $usuario->setNome( $usuarioFetch["nome"] );
                $usuario->setPerfil( $usuarioFetch["perfil"] );
                $usuario->setEmail( $usuarioFetch["email"] );
                $usuario->setNickName( $usuarioFetch["nickname"] );
                $usuario->setCpfCnpj( $usuarioFetch["cpf_cnpj"] );

                return $usuario;
            }
            return null;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
            //die() = usado para parar a execução - retirar na versão de produção
            die();
        }
    }

    public function cadastrarUsuario( UsuarioDTO $usuarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "INSERT INTO USUARIOS (PERFIL, NOME, NICKNAME, CPF_CNPJ, EMAIL, SENHA) ";
            $sql .= " VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getPefil() );
            $stmt->bindValue( 2, $usuarioDTO->getNome() );
            $stmt->bindValue( 3, $usuarioDTO->getNickName() );
            $stmt->bindValue( 4, $usuarioDTO->getCpfCnpj() );
            $stmt->bindValue( 5, $usuarioDTO->getEmail() );
            $stmt->bindValue( 6, $usuarioDTO->getSenha() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function listarTodos() {
        try {
            $con  = Conexao::getInstance();
            $sql  = "SELECT * from USUARIOS ORDER BY nome";
            $stmt = $con->prepare( $sql );
            $stmt->execute();
            $usuarios = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $usuarios;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public function excluirUsuarioById( UsuarioDTO $usuarioDTO ) {
        try {
            $con  = Conexao::getInstance();
            $sql  = "DELETE FROM usuarios WHERE id=?";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getIdUsuario() );

            return $stmt->execute();
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public function alterarUsuario( UsuarioDTO $usuarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "UPDATE USUARIOS SET NOME=?, NICKNAME=?, SENHA=?, DESCRICAO_USUARIO=?, TWITTER=?, INSTAGRAM=?, PINTEREST=?, FACEBOOK=? WHERE ID=? ";
            // $sql .= " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getNome() );
            $stmt->bindValue( 2, $usuarioDTO->getNickName() );
            $stmt->bindValue( 3, $usuarioDTO->getSenha() );
            // $stmt->bindValue( 4, $usuarioDTO->getFoto() );
            $stmt->bindValue( 4, $usuarioDTO->getDescricaoUsuario() );
            $stmt->bindValue( 5, $usuarioDTO->getTwitter() );
            $stmt->bindValue( 6, $usuarioDTO->getInstagram() );
            $stmt->bindValue( 7, $usuarioDTO->getPinterest() );
            $stmt->bindValue( 8, $usuarioDTO->getFacebook() );
            $stmt->bindValue( 9, $usuarioDTO->getIdUsuario() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function alterarFotoPerfil( UsuarioDTO $usuarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "UPDATE USUARIOS SET FOTO=? WHERE ID=? ";
            // $sql .= " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getFoto() );
            $stmt->bindValue( 2, $usuarioDTO->getIdUsuario() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function dadosUsuario(UsuarioDTO $usuarioDTO) {
        try {
            $con  = Conexao::getInstance();
            $sql  = "SELECT * FROM USUARIOS WHERE ID=?";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $usuarioDTO->getIdUsuario() );
            $stmt->execute();
            $usuarios = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $usuarios;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }
}
