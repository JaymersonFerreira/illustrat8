<?php
/*
 * Essa classe representa o modelo da tabela.
 * DTO - Data Transfer Object
 */
class UsuarioDTO {
    private $idUsuario;
    private $nome;
    private $perfil;
    private $cpfCnpj;
    private $email;
    private $senha;
    private $nickName;
    private $foto;
    private $descricaoUsuario;
    private $instagram;
    private $facebook;
    private $pinterest;
    private $twitter;

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPefil() {
        return $this->perfil;
    }

    public function getCpfCnpj() {
        return $this->cpfCnpj;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getNickName() {
        return $this->nickName;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function getDescricaoUsuario() {
        return $this->descricaoUsuario;
    }

    public function getInstagram() {
        return $this->instagram;
    }

    public function getFacebook() {
        return $this->facebook;
    }

    public function getPinterest() {
        return $this->pinterest;
    }

    public function getTwitter() {
        return $this->twitter;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function setCpfCnpj($cpfCnpj) {
        $this->cpfCnpj = $cpfCnpj;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }
    public function setNickName($nickName) {
        $this->nickName = $nickName;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setDescricaoUsuario($descricaoUsuario) {
        $this->descricaoUsuario = $descricaoUsuario;
    }
    
    public function setInstagram($instagram) {
        $this->instagram = $instagram;
    }

    public function setFacebook($facebook) {
        $this->facebook = $facebook;
    }

    public function setPinterest($pinterest) {
        $this->pinterest = $pinterest;
    }

    public function setTwitter($twitter) {
        $this->twitter = $twitter;
    }

}
