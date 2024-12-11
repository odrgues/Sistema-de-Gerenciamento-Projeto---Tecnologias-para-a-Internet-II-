<?php

include "../../componentes/validar_sessao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Editora</title>
</head>

<body>
    <?php
    include "../../componentes/menu.html";

    include "../../includes/database.php";


    $sql = "SELECT * FROM editora";


    $result = $conn->query($sql);
    ?>

    <div class="w3-container">
        <?php
        if (isset($_SESSION['mensagem_erro'])) {
            include "../../componentes/mensagem_erro.php";
        }

        if (isset($_SESSION['mensagem_sucesso'])) {
            include "../../componentes/mensagem_sucesso.php";
        }
        ?>

        <h2 class="w3-margin-top">Lista de Editora</h2>

        <a href="/app/cadastro/editora/adicionar.php"><button class="w3-button w3-green w3-round">Nova Editora</button></a>

        <table class="w3-table-all w3-margin-top ">
            <thead>
                <tr class="w3-light-grey">
                    <th>Editora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['editora'] . "</td>";
                    echo "<td>";
                    echo "<a href='/app/cadastro/editora/alterar.php?id=" . $row['id'] . "' class='w3-button w3-tiny w3-round w3-blue'>Alterar</a>";
                    echo "<a href='/app/cadastro/editora/excluir.php?id=" . $row['id'] . "' class='w3-button w3-tiny w3-round w3-red'>Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Nenhum registro encontrado</td></tr>";
            }


            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>