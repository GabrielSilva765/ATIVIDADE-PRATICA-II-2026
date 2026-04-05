<?php
session_start();

if (!isset($_SESSION["posts"])) {
    $_SESSION["posts"] = [];
}

$erro = "";
$posts = $_SESSION["posts"];

$usuario = "Admin";
$username = "@admin";
$foto = "./img/perfil.png";

// Criar post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mensagem = trim($_POST["message"]);

    if (empty($mensagem)) {
        $erro = "O post não pode estar vazio.";
    } else {
        $_SESSION["posts"][] = $mensagem;

        header("Location: feed.php ");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Feed</title>
    </head>
    <body>

        <!--Barra de Navegação -->
        <ul>
            <li><a href="#home" title="Home"><img src="./img/home.png" height="50px">  </a></li><br>
            <li><a href="#pesquisa" title="Pesquisar"><img src="./img/search.png" height="50px">  </a></li><br>
            <li><a href="#post" title="Postar"><img src="./img/communication.png" height="50px">  </a></li><br>
            <li><a href="#conta" title="Conta"><img src="./img/user.png" height="50px">  </a></li><br>
        </ul>

        <h2>Feed</h2>

        <!-- Perfil -->
        <div class="container">
            <div>
                <img src="<?php echo $foto; ?>">
                <h3><?php echo $usuario; ?></h3>
                <small><?php echo $username; ?></small>
            </div>

            <br>
            
            <!-- Erro -->
            <?php if (!empty($erro)): ?>
                <p style="color:red;"><?php echo $erro; ?></p>
            <?php endif; ?>

            <!-- Posts -->
            <form method="POST">
                <textarea name="message" rows="4" cols="50"></textarea><br>
                <button type="submit">Postar</button>
            </form>

            <hr>

            <?php foreach ($posts as $post): ?>
                <div>

                    <div>
                        <img src="<?php echo $foto; ?>">
                        <strong><?php echo $usuario; ?></strong>
                        <small><?php echo $username; ?></small>
                    </div>

                    <p><?php echo htmlspecialchars($post); ?></p>

                    <button onclick="curtir(this)">❤️ Curtir</button>
                    <span>0</span>

                    <hr>

                </div>
            <?php endforeach; ?>
        </div>

        <script src="js/script.js"></script>    
    </body>
</html>