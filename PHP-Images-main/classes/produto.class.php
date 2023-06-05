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


        

        public function enviarProduto($nome, $descricao, $foto = array(), $preco) {
            // Inserir na tabela produtos
            $cmd = "INSERT INTO produtos SET nome_produto = :n, descricao = :d, preco = :p";
            $cmd = $this->pdo->prepare($cmd);
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":d", $descricao);
            $cmd->bindValue(":p", $preco);
            $cmd->execute();
            $id_produto = $this->pdo->lastInsertId();
        
            // Inserir as imagens na tabela imagens
            if (count($foto) > 0) {
                foreach ($foto as $temp_nome_foto) {
                    // Obter o nome original da imagem
                    $nome_foto = basename($temp_nome_foto);
        
                    // Mover o arquivo temporário para o diretório desejado
                    $destino = 'images/' . $nome_foto;
                    move_uploaded_file($temp_nome_foto, $destino);
        
                    // Inserir o nome original da imagem na tabela imagens
                    $cmd = "INSERT INTO imagens (nome_imagem, fk_id_produto) VALUES (:n, :fk)";
                    $cmd = $this->pdo->prepare($cmd);
                    $cmd->bindValue(":n", $nome_foto);
                    $cmd->bindValue(":fk", $id_produto);
                    $cmd->execute();
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