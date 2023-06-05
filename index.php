<html>
    <head>
        <title>Inserir Produto php</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@900&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <h1 class="titulo">Inserir Produto</h1>
        <form method="post" enctype="multipart/form-data">

        <div class="campos">
            <label>NOME:</label>
            <input type="text" name="nome">
        </div>
        <div class="campos">
            <label>DESCRICAO:</label>
            <input type="text" name="descricao">
        </div>
        <div class="campos">
            <label for="preco">PRECO</label>
            <input type="number" name="preco">
        </div>
        <input class="foto"type="file" name="foto[]" multiple>
    
        <input class="enviar"onclick="enviar_imagem()" type="submit" name="">
        </form>
        <a href="./produtos.php">Ir para la</a>
        </div>
    

<?php
if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $descricao = addslashes($_POST['descricao']);
    $preco = addslashes($_POST['preco']);
    $fotos = array();
}

if (isset($_FILES['foto'])) {
    for ($i = 0; $i < count($_FILES['foto']['name']); $i++) {
        $temp_nome_foto = $_FILES['foto']['tmp_name'][$i];
        $nome_foto = md5(uniqid('', true)) . '.jpg';
        $destino = 'imagens/' . $nome_foto;
        move_uploaded_file($temp_nome_foto, $destino);

        array_push($fotos, $nome_foto);
    }
}

if (!empty($nome) && !empty($descricao)) {
    require './classes/produto.class.php';
    $p = new Produto();
    $p->enviarProduto($nome, $descricao, $fotos, $preco);
}
?>

<script>
    function enviar_imagem() {
        alert("Imagem transferida com sucesso!");
    }
</script>        
    </body>
</html>

