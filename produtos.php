<?php 
require './classes/produto.class.php';

$produto = new Produto();

$produtos = $produto->mostrarProdutos();

?>


<html>
    <head>
        <title>Ola mundo</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geologica:wght@200;300;400;900&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="head">
            <div class="logo">
                LOGO
            </div>
          <ul>
            <li>Voltar</li>
            <li>Produtos</li>
            <li>Sobre</li>
            <a href="./index.php">Voltar</a>
          </ul>
        </div>
        <div class="products">
        <?php foreach($produtos as $produto):?>
            <div class="product">
                <div class="strings">
                <h2><?php echo $produto['nome_produto'];?></h2>
                <p>R$ <?php echo $produto['preco']?></p>
                </div>
            <?php foreach($produto['imagens'] as $imagem):?>
                <img src="imagens/<?php echo $imagem?>" alt="none">
                <?php endforeach;?>
                
                </div>
            <?php endforeach;?>
            </div>
    </body>
</html>