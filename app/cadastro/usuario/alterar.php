<?php
include "../../componentes/validar_sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Alterar Usuário</title>
</head>

<body>

    <?php
    include '../../componentes/menu.html';

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            include '../../includes/database.php';


            $sql = "SELECT * FROM usuario WHERE id = ?";
            $consulta = $conn->prepare($sql);
            $consulta->bind_param("i", $id);
            $consulta->execute();
            $resultado = $consulta->get_result();

            if ($resultado->num_rows > 0) {
                $usuario = $resultado->fetch_assoc();
            } else {
                $_SESSION['mensagem_erro'] = "Usuário não encontrado.";

                $consulta->close();
                $conn->close();

                header("location: /app/cadastro/usuario/listar.php");
            }
        } else {
            $_SESSION['mensagem_erro'] = "Usuário não encontrado.";

            $consulta->close();
            $conn->close();

            header("location: /app/cadastro/usuario/listar.php");
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '../../includes/database.php';

        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

        $sql = "UPDATE usuario set nome = ?, usuario = ?, senha = ? WHERE id = ?";
        $update = $conn->prepare($sql);
        $update->bind_param("sssi", $nome, $usuario, $senha, $id);
        session_start();

        if ($update->execute()) {
            $_SESSION['mensagem_sucesso'] = "Usuário atualizado com sucesso.";
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar os dados: " . $conn->error;
        }

        $update->close();

        header("location: /app/cadastro/usuario/listar.php");
    }
    ?>

    <div class="w3-container">
        <h2 class="w3-margin-top">Alterar Aluno</h2>
        <form action='alterar.php' method='post' class="w3-container w3-card-2 w3-margin-top">

            <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">

            <div class="w3-row-padding w3-margin-top">
                <div class="w3-col s6">
                    <label for="nome">Nome</label>
                    <input class="w3-input w3-border" type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required>
                </div>
                <div class="w3-col s2">
                    <label for="usuario">Usuário</label>
                    <input class="w3-input w3-border" type="text" id="usuario" name="usuario" value="<?php echo $usuario['usuario']; ?>" required>
                </div>
                <div class="w3-col s2">
                    <label for="senha">Senha</label>
                    <input class="w3-input w3-border" type="text" id="senha" name="senha" value="<?php echo $usuario['senha']; ?>" required>
                </div>
            </div>

            <div class="w3-row-padding w3-margin-bottom">
                <button type="submit" class="w3-button w3-blue w3-margin-top">Salvar</button>
            </div>
        </form>
    </div>

</body>

</html>