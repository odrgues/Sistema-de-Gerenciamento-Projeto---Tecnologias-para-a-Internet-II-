<?php

include "../../componentes/validar_sessao.php";
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (isset($_GET['id'])) {
    include "../../includes/database.php";

    $id = (int) $_GET['id'];


    $sql = "DELETE FROM categoria WHERE id = ?";
    $atualizar = $conn->prepare($sql);
    $atualizar->bind_param("i", $id);

    if ($atualizar->execute()) {
      $_SESSION['mensagem_sucesso'] = "Categoria excluída com sucesso.";
    } else {
      $_SESSION['mensagem_erro'] = "Erro ao excluir registro: " . $conn->error;
    }

    $atualizar->close();
    $conn->close();
  } else {

    $_SESSION['mensagem_erro'] = "Categoria não encontrado.";
  }
}

header("location: /app/cadastro/categoria/listar.php");

?>
