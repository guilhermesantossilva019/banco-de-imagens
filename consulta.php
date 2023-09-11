<?php
session_start();
include('conexao.php');

if (!isset($_SESSION["username"])) {
    header("Location: index.html"); // Redireciona para a página de login se o usuário não estiver autenticado
    exit;
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <style>
     #nav-bar {
         width: 1000px;
     }

     .check-box {
         display: flex;
         flex-direction: column;
         margin-right: 50px;
         margin-left: 50px;
     }

     #navbar {
         display: flex;
         align-items: center;
         justify-content: center;
     }

     main {
         padding: 2rem;
     }

     #limpar {
         margin-left: 10px;
     }
    </style>
    
    <title>Consulta</title>
</head>
<body>
    <nav class="navbar bg-body-tertiary" >
    <div class="container-fluid" id="navbar">
        <form class="d-flex" role="search" method="GET" action="consulta.php">
        <input class="form-control me-2" type="search" placeholder="Procure seu produto pelo nome" aria-label="Search" id="nav-bar" name="pesquisa">
        <div class="check-box">
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value=100>
            <label class="form-check-label" for="flexRadioDefault1">
                Abaixo de R$100,00
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value=200>
            <label class="form-check-label" for="flexRadioDefault2">
                De R$100,00 á R$200,00
            </label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value=300>
            <label class="form-check-label" for="flexRadioDefault2">
                Acima de R$200,00
            </label>
            </div>
        </div>
        <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        <button class="btn btn-outline-danger" type="submit" id="limpar">Limpar</button>
        </form>
    </div>
    </nav>

     <main>
        <!-- consultando as imagens -->
            <?php

            $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : "";
            $preco = isset($_GET['flexRadioDefault']) ? $_GET['flexRadioDefault'] : "";


            // Construa a consulta SQL com base nos parâmetros de pesquisa
            $sql = "SELECT id, nome, preco, descricao, nome_arc, ext_arq FROM produto WHERE nome LIKE :pesquisa";

            if ($preco == "100") {
                $sql .= " AND preco < 100";
            } elseif ($preco == "200") {
                $sql .= " AND preco >= 100 AND preco <= 200";
            } elseif ($preco == "300") {
                $sql .= " AND preco > 200";
            }

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':pesquisa', "%$pesquisa%");
            $stmt->execute();

            $diretorio = "./img/";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = $row['id'];
                $nome = $row['nome'];
                $preco = $row['preco'];
                $descricao = $row['descricao'];
                $nome_arc = $row['nome_arc'];
                $ext_arq = $row['ext_arq'];

                $imagemPath = $diretorio . $nome_arc;

                

                echo '
                <div class="card" style="width: 18rem; display: inline-block;">
                        <img src="'.$imagemPath.'" class="card-img-top" alt="imagem">
                        <div class="card-body">
                            <h5 class="card-title">Título: '.$nome.'</h5>
                            <p class="card-text">Descrição: '.$descricao.'</p>
                            <p class="card-text">Preço: R$ '.$preco.'</p>
                        </div>
                    </div>';
            }
        ?>

    </main>
</body>
</html>