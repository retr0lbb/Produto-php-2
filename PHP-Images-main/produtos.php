<?php 
require './classes/produto.class.php';

$produto = new Produto();

$produtos = $produto->mostrarProdutos();

?>


<html>
    <head>
        <title>Ola mundo</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="products">

        
        <?php foreach($produtos as $produto):?>
            <div class="product">
            <h2><?php echo $produto['nome_produto'];?></h2>
            <p><?php echo $produto['descricao'] ?></p>
            <?php foreach($produto['imagens'] as $imagem):?>
                <img src="imagens/<?php echo $imagem?>" alt="none">
                <?php endforeach;?>
                <p><?php echo $produto['preco']?></p>
                </div>
            <?php endforeach;?>
            </div>
    </body>
</html>