<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário</title>
    <link rel="stylesheet" href="../css/cadastro.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">

</head>

<body>


    <div id="modal">
        <div class="content">
            
                <h1>Cadastro de Usuário</h1>
            

            <form action="../Control/cadastroUsuarioControl.php" method="POST">

                <div class=" input-whapper" style="text-align: center; font-size: 1.3em;";>
                    <label for="tipo">Tipo de Usuário</label>
                    <select style="border: 3px solid #ffffff40;
                    border-radius: 8px; " name="PERFIL" id="">
                        <option value="USUARIO">Apreciador</option>
                        <option value="ARTISTA">Ilustrador</option>
                    </select>
                </div>

                <div class="input-whapper">
                    <label for="nome">Nome</label>
                    <input type="text" name="NOME" required placeholder="Nome">
                </div>

                <div class="input-whapper">
                    <label for="nickname">Nickname</label>
                    <input type="text" name="NICKNAME" required placeholder="Apelido">
                </div>

                <div class="input-whapper">
                    <label for="cpf_cnpj">CPF OU CNPJ</label>
                    <input type="text" name="CPF_CNPJ" maxlength="15" required placeholder="CPF OU CNPJ"
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" />
                </div>


                <div class="input-whapper">
                    <label for="email">E-mail</label>
                    <input type="email" name="EMAIL" required placeholder="illustr8@virtual.com">
                </div>

                <div class="input-wrapper">
                    <label for="senha">Senha</label>
                    <input type="password" name="SENHA" required placeholder="********">
                </div>

                <div class="input-wrapper">
                    <label for="senha">Confirme a senha</label>
                    <input type="password" name="CONFIRMA_SENHA" required placeholder="********">
                    <?php
                        $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';

                        echo $msg;
                    ?>
                </div>

                <div class="espaco_botao">
                    <a class="voltar" class="button" href="javascript:history.back()">Voltar</a>
                    <button class="button">Cadastrar</button>
                </div>



            </form>


        </div>
    </div>

</body>

</html>