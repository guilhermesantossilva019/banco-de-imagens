create database sistema;
use sistema;

create table usuarios(username varchar(40), password varchar(30));
create table produto(id int key, nome varchar(50), preco float, descricao varchar(50), nome_arc varchar(100), ext_arq varchar(5));

insert into usuarios values ("admin", "admin");