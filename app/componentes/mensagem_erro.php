<?php
echo "<div class='w3-panel w3-pale-red w3-display-container' style='display:block'>";
echo "<span onclick=\"this.parentElement.style.display='none'\" class='w3-button w3-display-topright'>x</span>";
echo "<p>" . $_SESSION['mensagem_erro'] . "</p></div>";

unset($_SESSION['mensagem_erro']);
