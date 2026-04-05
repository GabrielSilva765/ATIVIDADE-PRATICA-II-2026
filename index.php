<?php

$email_valido = "admin@gmail.com";
$senha_valida = "123456";

$erro = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Validação
    if ($email == $email_valido && $senha == $senha_valida) {
        header("Location: feed.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Tela de Login</title>
    </head>
    <body>
        <div class="login-container">
            <h1>Login</h1>

            <?php if (!empty($erro)): ?>
                <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>

            <form action="index.php" method="post">
                
                <input type="email" id="email" name="email" placeholder="Email" required><br><br>
                <input type="password" id="senha" name="senha" placeholder="Senha" required><br><br>
                
                <button type="submit">Entrar</button>
            </form>
        </div>
        
    </body>
</html>
        