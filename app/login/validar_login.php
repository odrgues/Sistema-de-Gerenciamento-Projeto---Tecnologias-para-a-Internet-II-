<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordHash = sha1($password);

    include "../includes/database.php";

    $sql = "SELECT id, usuario, senha FROM usuario WHERE usuario = ?";
    $consulta = $conn->prepare($sql);
    $consulta->bind_param("s", $username);
    $consulta->execute();
    $dados = $consulta->get_result();

    if ($dados->num_rows > 0) {
        $linha = $dados->fetch_assoc();


        if ($password === $linha['senha']) {
            $passwordHash = sha1($password);

            $updateSql = "UPDATE usuario SET senha = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $passwordHash, $linha['id']);
            $updateStmt->execute();
        } elseif (sha1($password) === $linha['senha']) {

            $passwordHash = $linha['senha'];
        } else {

            $_SESSION['login_error'] = "Credenciais inválidas.";
            header("Location: /app/login.php");
            $conn->close();
            exit;
        }


        $_SESSION['usuario'] = $linha['usuario'];
        $_SESSION['logado'] = true;

        header("Location: /app/index.php");
        $conn->close();
        exit;
    } else {

        $sql = "INSERT INTO usuario (usuario, senha) VALUES (?, ?)";
        $consulta = $conn->prepare($sql);
        $consulta->bind_param("ss", $username, $passwordHash);

        if ($consulta->execute()) {
            echo "Usuário cadastrado com sucesso!";

            header("Location: /app/login.php");
            exit;
        } else {
            echo "Erro ao cadastrar o usuário: " . $conn->error;
        }
    }

    $conn->close();
}
