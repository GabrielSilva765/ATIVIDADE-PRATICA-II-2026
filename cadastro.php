<?php
$erro = "";

$nome = $username = $email = $data_nascimento = $genero = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitização
    $nome = htmlspecialchars($_POST["nome"]);
    $username = htmlspecialchars($_POST["nome_usuario"]);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = $_POST["password"];
    $confirmar = $_POST["confirmar"];
    $data_nascimento = $_POST["data_nascimento"];
    $genero = $_POST["genero"];

    // Validação dos campos vazios
    if (empty($nome) || empty($username) || empty($email) || empty($senha) || empty($confirmar) || empty($data_nascimento) || empty($genero)) {
        $erro = "Todos os campos são obrigatórios.";
    }

    // Validação de email
    elseif (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
        $erro = "Email inválido.";
    }

    // Validação da senha
    elseif (strlen($senha) < 6 || !preg_match('/[A-Z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
        $erro = "A senha inválida.";
    }

    // Confirmar senha
    elseif ($senha !== $confirmar) {
        $erro = "As senhas não coincidem.";
    }

    // Validar data
    elseif (!strtotime($data_nascimento)) {
        $erro = "Data de nascimento inválida.";
    }

    // Validar gênero
    elseif (!in_array($genero, ["Feminino", "Masculino", "Outro"])) {
        $erro = "Gênero inválido.";
    }

    else {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/estilos.css">
        <title>Cadastro</title> 
    </head>
    <body>

        <div class="login-container">
            <h1>Cadastro</h1>

            <?php if (!empty($erro)): ?>
                <p style="color:red;"><?php echo $erro; ?></p>
            <?php endif; ?>

            <form action="cadastro.php" method="post" >
                <input type="text" id="nome" name="nome" placeholder="Nome Completo" value="<?php echo $nome; ?>" required><br><br>

                <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Nome de Usuário" value="<?php echo $username; ?>" required><br><br>

                <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required><br><br>

                <input type="password" id="password" name="password" placeholder="Senha"  required><br><br>
                <p>Mínimo 6 caracteres, 1 letra maiúscula e 1 número.</p>

                <input type="password" id="confirmar" name="confirmar" placeholder="Confirmar Senha" required><br><br>

                <input type="date" id="data_nascimento" name="data_nascimento" placeholder="Data de Nascimento" value="<?php echo $data_nascimento; ?>" required><br><br>
                
                <label> Gênero: </label>
                <select name="genero">
                    <option value="Masculino" <?php if($genero=="Masculino") echo "selected"; ?>>Masculino</option>
                    <option value="Feminino" <?php if($genero=="Feminino") echo "selected"; ?>>Feminino</option>
                    <option value="Outro" <?php if($genero=="Outro") echo "selected"; ?>>Outro</option>
                </select><br><br>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </body>
</html>