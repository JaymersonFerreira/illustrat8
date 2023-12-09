<?php
/*
 * Essa classe representa o modelo da tabela.
 * DTO - Data Transfer Object
 */
class ComentarioDTO {
    private $idComentario;
    private $texto;
    private $usuarioId;
    private $postagemId;

    public function getIdComentario() {
        return $this->idComentario;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getUsuarioId() {
        return $this->usuarioId;
    }
    
    public function getPostagemId() {
        return $this->postagemId;
    }

    public function setIdComentario( $idComentario ) {
        $this->idComentario = $idComentario;
    }

    public function setTexto( $texto ) {
        $this->texto = $texto;
    }

    public function setUsuarioId( $usuarioId ) {
        $this->usuarioId = $usuarioId;
    }

    public function setPostagemId( $postagemId ) {
        $this->postagemId = $postagemId;
    }
}
