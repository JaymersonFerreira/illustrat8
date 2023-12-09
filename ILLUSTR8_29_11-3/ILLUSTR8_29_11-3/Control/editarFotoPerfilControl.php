<?php
require_once "../Model/DTO/UsuarioDTO.php";
require_once "../Model/DAO/UsuarioDAO.php";

$path=null;
if (isset($_FILES['foto'])) {
    $arquivo = $_FILES['foto'];
    
    if ($arquivo['error']){
        die("Falha ao enviar foto.");
    }

    if ($arquivo['size']>5242880){
        die("Arquivo muito grande!! Max: 5MB");
    }
    
    $pasta = "foto_perfil/";
    $nomeDoArquivo = $arquivo['name'];
    $novoNomeDoArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));

    // if ($extensao != "jpg" && $extensao != "png"){
    //     die("Tipo de arquivo não aceito");
    // }

    $path = $pasta . $novoNomeDoArquivo . "." . $extensao;
    $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
    if ($deu_certo){
        $foto = $path;
    }else {
        echo "<p>Falha ao enviar arquivo</p>";
    }

}

// echo $foto, "<br>";

$usuarioId          = filter_input(INPUT_POST, 'usuarioId');

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setFoto( $foto);
$usuarioDTO->setIdUsuario($usuarioId);

$usuarioDAO = new UsuarioDAO();
$usuarioDAO->alterarFotoPerfil( $usuarioDTO );

header("location: ../View/meuPerfil.php?msg=Foto alterada com sucesso.");

?>