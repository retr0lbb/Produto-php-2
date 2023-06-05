<?php
    class Produto {
        private $pdo;

        function __construct()
        {
            $dbname = "mysql:dbname=produtoetim;host=localhost";
            $user = "root";
            $pass = "";
            try {
                $this->pdo = new PDO($dbname, $user, $pass);
            } catch (Exception $e) {
                echo "Erro" . $e;
            }
        }


        

        public function enviarProduto($nome, $descricao,$foto = array()){
            ///////inserir em produtos

            $cmd = "INSERT INTO produtos SET nome_produto = :n, descricao = :d";
            $cmd = $this->pdo->prepare($cmd);
            $cmd ->bindValue(":n", $nome);
            $cmd ->bindValue(":d", $descricao);

            $cmd ->execute();
            $id_produto = $this->pdo->LastInsertId ();

            // inserir uma imagem na tabela de produtos

            if(count($foto)> 0){
                for($i=0;$i<count($foto); $i++){
                    $nome_foto = $foto[$i];
                    $cmd = "INSERT INTO imagens (nome_imagem, fk_id_produto) values (:n, :fk)";
                    $cmd = $this->pdo->prepare($cmd);
                    $cmd ->bindValue(":n", $nome);
                    $cmd ->bindValue(":fk", $id_produto);
                    echo $foto[$i];
                    exit;
                    $cmd ->execute();
                }
            }
            
        }
        public function mostrarProdutos(){
            $cmd = "SELECT * FROM produtos";
            $query = $this->pdo->query($cmd);
            $produtos = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($produtos as &$produto){
                $cmd = "SELECT nome_imagem FROM imagens WHERE fk_id_produto = :id";
                $query = $this->pdo->prepare($cmd);
                $query->bindValue(":id", $produto['id_produto']);
                $query->execute();
                $imagens = $query->fetchAll(PDO::FETCH_COLUMN);
                $produto['imagens'] = $imagens;
            }
           return $produtos;
        }

    }
?>