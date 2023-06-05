<?php 
require './classes/produto.class.php';

$produto = new Produto();

$produtos = $produto->mostrarProdutos();

?>


<html>
    <head>
        <title>Ola mundo</title>
    </head>
    <body>
        <?php foreach($produtos as $produto):?>
            <h2><?php echo $produto['nome_produto'];?></h2>
            <h3><?php echo $produto['descricao'] ?></h3>
            <?php foreach($produto['imagens'] as $imagem):?>
                <img src="imagens/<?php echo $imagem?>" alt="none">
                <?php endforeach;?>
            <?php endforeach;?>
    </body>
</html>