CREATE DATABASE IF NOT EXISTS produtoetim;
USE produtoetim;

CREATE TABLE IF NOT EXISTS produtos (
    id_produto int AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(100),
    descricao TEXT
)

CREATE TABLE IF NOT EXISTS imagens (
    id_iamge int AUTO_INCREMENT PRIMARY KEY,
    nome_imagem VARCHAR(100),
    fk_id_produto int,
    FOREIGN KEY (fk_id_produto) REFERENCES produtos(id_produto) ON DELETE CASCADE,
)