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

            //Receber o número da página
            $pagina_atual = filter_input( INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT );
            $pagina       = ( !empty( $pagina_atual ) ) ? $pagina_atual : 1;
            //var_dump($pagina);

            //Setar a quantidade de registros por página
            $limite_resultado = 5;

            // Calcular o inicio da visualização
            $inicio = ( $limite_resultado * $pagina ) - $limite_resultado;

            $con  = Conexao::getInstance();
            $sql  = "SELECT * from comentarios WHERE usuarios_id =? ORDER BY DATACRIACAO DESC LIMIT $inicio, $limite_resultado";
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
