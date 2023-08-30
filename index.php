<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>

  .box-title .title {
      position: relative;
      text-align: center;
      color:#222; 
      font-size:35px; 
      font-weight:bold;
      text-transform: uppercase;
      letter-spacing:5px; 
      color:#fcfcfc;
}

.box-title .title .subtitle {

line-height:2em; 
padding-bottom:15px;
text-transform: none;
font-size:18px;
font-weight: normal;
font-family: 'sans-serif';
color:#fff; 
letter-spacing:none;
}

.box-formulario {

  width: 100%;
  height: 100vh;
  align-items: center;
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  background-color: #232323;
  padding:60px 0;

}

.formulario {

  width: 700px;
  background: #232323;
  padding: 60px 5%;
  text-align: center;

}


.formulario span {
position: relative;
display: flex;
margin: 45px 10px;

}

#file {
  padding: 19px 12px 10px;
}

/*Botão*/
.btn-submit {

color: #fff;
background: #909090;
cursor: pointer;
border: none;
border-radius: 3px;
transition: 0.2s;
width: 100%;
padding: 0.5em 1em;
font-size: 1.3em;
font-weight: bold;
float: left;

}

.btn-submit:hover {
background-color:#bfddf3;
color: #222;
}

main {
  padding: 2rem;
}

.card {
  background-color: #fcfcfc;
  height: 60vh;
  background-size: cover;
  padding: 0.5rem;
  border-radius: 5px;
}

.card-img-top {
  width: 100%;
  height: 60%;
  object-fit: cover;
  border-radius: 5px;
}

</style>
</head>
<body>

<form method="POST" action="enviar.php" enctype="multipart/form-data"> 

       <div class="box-formulario">        
        
        <div class="formulario">
            
            <div class="box-title">
              <h2 class="title">Exercicio Maschietto
                <p class="subtitle">Banco de imagens</p>
              </h2>
            </div>
            <form action="#" method="post">

            <div class="form-floating mb-3">
              <input type="number" class="form-control" name="id"  placeholder="ID">
              <label for="floatingInput">ID do Produto</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="nome" placeholder="Password">
              <label for="floatingPassword">Nome da Imagem</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="preco" placeholder="Password">
              <label for="floatingPassword">Preço</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="descricao" placeholder="Password">
              <label for="floatingPassword">Descrição</label>
            </div>
            <div class="form-floating mb-3" id="file-box">
              <input type="file" class="form-control" id="file"  name="imagem" accept="image/*">
            </div>
            
              <input type="submit" class="form-control btn-submit">

            </form>
        </div>
    </div>

</form>

<main>

<?php
include('conexao.php');
    $diretorio = "./img/";

    // Fazer uma consulta SQL para obter todos os produtos
    $sql = "SELECT id, nome, preco, descricao, nome_arc, ext_arq FROM produto";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

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
    
    $stmt->closeCursor();
?>

</main>
    
</body>
</html>
