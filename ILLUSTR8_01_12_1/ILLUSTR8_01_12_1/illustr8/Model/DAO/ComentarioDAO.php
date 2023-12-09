<?php
require_once __DIR__ . '/../Conexao.php';
require_once __DIR__ . '/../DTO/ComentarioDTO.php';
class ComentarioDAO {

    public function cadastrarComentario( ComentarioDTO $comentarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "INSERT INTO comentarios (id, texto, usuarios_id, postagens_id) ";
            $sql .= " VALUES(?, ?, ?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getIdComentario() );
            $stmt->bindValue( 2, $comentarioDTO->getTexto() );
            $stmt->bindValue( 3, $comentarioDTO->getUsuarioId() );
            $stmt->bindValue( 4, $comentarioDTO->getPostagemId() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }

    public function listarTodos(ComentarioDTO $comentarioDTO) {
        try {

            $con  = Conexao::getInstance();
            $sql  = "SELECT * from comentarios WHERE postagens_id =?
            ORDER BY DATACRIACAO DESC";
            
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getPostagemId() );
            $stmt->execute();
            $comentarios = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $comentarios;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }
    
    public function listarMeusComentarios(ComentarioDTO $comentarioDTO) {
        try {
            $con  = Conexao::getInstance();
            $sql  = "SELECT * from comentarios WHERE usuarios_id =? ORDER BY DATACRIACAO DESC";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getUsuarioId() );
            $stmt->execute();
            $comentarios = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $comentarios;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public function excluirComentarioById( ComentarioDTO $comentarioDTO ) {
        try {
            $con  = Conexao::getInstance();
            $sql  = "DELETE FROM comentarios WHERE ID=?";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getIdComentario());

            return $stmt->execute();
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public function verMaisComentario( ComentarioDTO $comentarioDTO ) {
        try {
            $con  = Conexao::getInstance();
            $sql  = "SELECT * from comentarios WHERE id = ?";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getIdComentario() );
            $stmt->execute();
            $postagens = $stmt->fetchAll( PDO::FETCH_ASSOC );
            return $postagens;
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

    }

    public function alterarComentario( ComentarioDTO $comentarioDTO ) {
        try {
            $con = Conexao::getInstance();
            $sql = "UPDATE COMENTARIOS SET TEXTO=? WHERE ID=? ";
            // $sql .= " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare( $sql );
            $stmt->bindValue( 1, $comentarioDTO->getTexto() );
            $stmt->bindValue( 2, $comentarioDTO->getIdComentario() );

            return $stmt->execute();

        } catch ( PDOException $e ) {
            echo $e->getMessage();
            die();
        }
    }
}
