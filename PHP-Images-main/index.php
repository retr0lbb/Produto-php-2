<form method="post" enctype="multipart/form-data">
    <label>NOME:</label>
    <input type="text" name="nome">
    <label>DESCRICAO:</label>
    <input type="text" name="descricao">
    <input type="file" name="foto[]">

    <input onclick="enviar_imagem()" type="submit" name="">
</form>

<?php
    if (isset($_POST['nome']))
    {
       $nome = addslashes($_POST['nome']);
       $descricao = addslashes($_POST['descricao']);
       $fotos = array();
    }

    if(isset($_FILES['foto'])){

        for($i =0; $i< count($_FILES['foto']['name']); $i++){

            $nome_arquivo = md5($_FILES['foto']['name'][$i].rand(1,999).'jpg');
            move_uploaded_file($_FILES['foto']['tmp_name'][$i], 'imagens/'.$nome_arquivo);

            array_push($fotos, $nome_arquivo);
        }
    }
    if(!empty($nome) && !empty($descricao)){
        require './classes/produto.class.php';
        $p = new Produto();
        $p->enviarProduto($nome, $descricao, $fotos);
    

        }
?>

<script>
    function enviar_imagem() {
        alert("Imagem transferida com sucesso!")
    }
</script>
