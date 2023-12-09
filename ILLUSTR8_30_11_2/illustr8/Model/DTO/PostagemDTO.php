<?php
/*
 * Essa classe representa o modelo da tabela.
 * DTO - Data Transfer Object
 */
class PostagemDTO {
    private $idPostagem;
    private $titulo;
    private $descricao;
    private $imagem;
    private $preco;
    private $usuarioId;
    private $tipo;

    public function getIdPostagem() {
        return $this->idPostagem;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }
    
    public function getTipo() {
        return $this->tipo;
    }

    public function setIdPostagem( $idPostagem ) {
        $this->idPostagem = $idPostagem;
    }

    public function setTitulo( $titulo ) {
        $this->titulo = $titulo;
    }

    public function setDescricao( $descricao ) {
        $this->descricao = $descricao;
    }

    public function setImagem( $imagem ) {
        $this->imagem = $imagem;
    }

    public function setPreco( $preco ) {
        $this->preco = $preco;
    }

    public function setUsuarioId( $usuarioId ) {
        $this->usuarioId = $usuarioId;
    }
    
    public function setTipo( $tipo ) {
        $this->tipo = $tipo;
    }
}
