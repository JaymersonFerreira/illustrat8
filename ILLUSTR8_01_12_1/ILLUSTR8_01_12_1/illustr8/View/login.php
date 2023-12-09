<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">

</head>

<body>

    <div id="modal">
        <div class="content">
            
                <h1>Login</h1>
            

            <form action="../Control/loginControl.php" method="POST">

                <div class="input-whapper">
                    <?php
                        $msg = isset( $_GET['msg'] ) ? $_GET['msg'] : '';
                        echo $msg, "<br>";
                    ?>
                    <label for="email">Email</label>
                    <input type="email" name="EMAIL" required autofocus placeholder="illustr8@virtual.com">
                </div>

                <div class="input-wrapper">
                    <label for="senha">Senha</label>
                    <input type="password" name="SENHA" required placeholder="********">
                </div>

                <div class="espaco_botao">
                    <a class="voltar" href="../">Voltar</a>
                    <button class="button">Entrar</button>
                </div>
                <div class="espaco_botao">
                    <a class="a" href="">Recuperar senha</a>
                    <a class="a" href="cadastro.php">Não possui conta</a>
                </div>

            </form>

        </div>
    </div>

</body>

</html>