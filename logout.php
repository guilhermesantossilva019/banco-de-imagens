<?php
session_start();
session_destroy();
header("Location: index.html"); // Redireciona de volta para a página de login após o logout
?>
