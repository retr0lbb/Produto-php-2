# PHP_Imagens

Na tabela produtos, vamos ter os atributos:

```sql
  id produto int auto_increment primary key,
  nome_produto varchar(100),
  descricao text --Pode conter vários caractéres
```

Na tabela imagens temos os atributos:

```sql
  id imagem int auto_increment primary key,
  nome_imgaem varchar(100)
```

fk id produto que é a chave estrangeira que vem da tabela produtos, entao
teremos uma relacao de 1 para n entre produtos e imagens

Isso significa que para cada produto eu posso ter varias imagens.
Agora vamos criar uma classe para trabalhar com essas imagens
