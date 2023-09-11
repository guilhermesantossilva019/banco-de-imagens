<style>
    body {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 16pt;
        height: 100vh;
    }

    a {
        text-decoration: none;
    }

</style>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Conecta ao banco de dados usando PDO
        $conn = new PDO("mysql:host=localhost;dbname=sistema", "root", "");

        // Define o modo de erro do PDO para exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para verificar o usuário e a senha
        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password";

        // Prepara a consulta
        $stmt = $conn->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // Executa a consulta
        $stmt->execute();

        // Verifica se há um resultado
        if ($stmt->rowCount() == 1) {
            // O login foi bem-sucedido
            $_SESSION["username"] = $username;
            header("Location: home.php"); // Redireciona para a página inicial após o login
        } else {
            // O login falhou
            echo "Nome de usuário ou senha incorretos.";
            echo "<a href='index.html'>Voltar</a>";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    } finally {
        // Fecha a conexão com o banco de dados
        $conn = null;
    }
}
?>