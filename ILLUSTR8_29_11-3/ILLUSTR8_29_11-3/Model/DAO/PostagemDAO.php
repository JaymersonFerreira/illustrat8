<?php
require_once __DIR__ . '/../Conexao.php';
require_once __DIR__ . '/../DTO/PostagemDTO.php';
class PostagemDAO
{

    public function cadastrarPostagem(PostagemDTO $postagemDTO)
    {
        try {
            $con = Conexao::getInstance();
            $sql = "INSERT INTO postagens (id, titulo, descricao, imagem, usuarios_id, preco, tipo) ";
            $sql .= " VALUES(?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $postagemDTO->getIdPostagem());
            $stmt->bindValue(2, $postagemDTO->getTitulo());
            $stmt->bindValue(3, $postagemDTO->getDescricao());
            $stmt->bindValue(4, $postagemDTO->getImagem());
            $stmt->bindValue(5, $postagemDTO->getUsuarioId());
            $stmt->bindValue(6, $postagemDTO->getPreco());
            $stmt->bindValue(7, $postagemDTO->getTipo());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function listarTodos()
    {
        try {

            //Receber o número da página
            $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
            //var_dump($pagina);

            //Setar a quantidade de registros por página
            $limite_resultado = 5;

            // Calcular o inicio da visualização
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;

            $con  = Conexao::getInstance();
            $sql  = "SELECT * from postagens ORDER BY DATAPUBLICACAO DESC LIMIT $inicio, $limite_resultado";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $postagens;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function listarMeusPosts(PostagemDTO $postagemDTO)
    {
        try {

            //Receber o número da página
            $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
            $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
            //var_dump($pagina);

            //Setar a quantidade de registros por página
            $limite_resultado = 5;

            // Calcular o inicio da visualização
            $inicio = ($limite_resultado * $pagina) - $limite_resultado;

            $con  = Conexao::getInstance();
            $sql  = "SELECT * from postagens WHERE usuarios_id=? ORDER BY DATAPUBLICACAO DESC LIMIT $inicio, $limite_resultado";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $postagemDTO->getUsuarioId());
            $stmt->execute();
            $postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $postagens;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function verMais(PostagemDTO $postagemDTO)
    {
        try {
            $con  = Conexao::getInstance();
            $sql  = "SELECT * from postagens WHERE id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $postagemDTO->getIdPostagem());
            $stmt->execute();
            $postagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $postagens;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function excluirPostagemById(PostagemDTO $postagemDTO)
    {
        try {
            $con  = Conexao::getInstance();
            $sql  = "DELETE FROM postagens WHERE ID=?";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(1, $postagemDTO->getIdPostagem());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function listarPesquisa()
    {

        try {
        $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);
        if ($SendPesqMsg) {
            $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
            
            //SQL para selecionar os registros
            $con  = Conexao::getInstance();
            $sql = "SELECT * FROM postagens WHERE assunto LIKE $assunto ORDER BY assunto ASC LIMIT 7";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $postagens = $stmt->fetch(PDO::FETCH_ASSOC);
            return $postagens;
        }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


       

