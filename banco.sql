create database crud_client character set utf8 collate utf8_general_ci;

create table cliente(
id_cliente int not null auto_increment,
nome varchar(100) not null,
cpf varchar(11) not null,
telefone varchar(11) not null,
endereco varchar(100) not null,
primary key(id_cliente)
);

insert into cliente(nome, cpf, telefone, endereco) values('João', '12345678901', '123456789', 'Rua 1');