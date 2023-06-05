<form method="post" enctype="multipart/form-data">
    <label>NOME:</label>
    <input type="text" name="nome">
    <label>DESCRICAO:</label>
    <input type="text" name="descricao">
    <input type="file" name="foto[]">
    <label for="preco">PRECO</label>
    <input type="number" name="preco">

    <input onclick="enviar_imagem()" type="submit" name="">
</form>

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