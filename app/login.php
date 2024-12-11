<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body class="w3-light-grey">

    <div class="w3-container w3-display-middle" style="max-width:400px;">
        <div class="w3-card-4 w3-padding-16">
            <h2 class="w3-center">Login</h2>
            <form action="/app/login/validar_login.php" method="POST" class="w3-container w3-margin-top">
                <div class="w3-section">
                    <label for="username">Usuário</label>
                    <input class="w3-input w3-border w3-round" type="text" id="username" name="username" required>
                </div>
                <div class="w3-section">
                    <label for="password">Senha</label>
                    <input class="w3-input w3-border w3-round" type="password" id="password" name="password" required>
                </div>
                <button class="w3-button w3-block w3-blue w3-round" type="submit">Entrar</button>

                <?php
                session_start();
                if (isset($_SESSION['login_error'])) {
                    echo '<p class="w3-text-red w3-center">' . $_SESSION['login_error'] . '</p>';
                    unset($_SESSION['login_error']);
                }
                ?>
            </form>
        </div>
    </div>

</body>

</html>