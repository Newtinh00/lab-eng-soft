CREATE TABLE genero(
	id_genero int AUTO_INCREMENT PRIMARY KEY,
    genero VARCHAR(255)
);

create table interesses(
	id_interesse int AUTO_INCREMENT PRIMARY KEY,
	interesse VARCHAR(255));

create table interesseusuario(
	id_interesse INT,
	id_usuario INT
);

create table fotos(
	id_foto INT AUTO_INCREMENT PRIMARY KEY,
    foto VARCHAR(255),
    id_usuario INT
);

create table usuarios(
	id_usuario int AUTO_INCREMENT PRIMARY key,
	nome varchar(30),
	telefone varchar(30),
	email varchar(40),
	senha varchar(32),
	id_genero INT,
	id_foto INT,
	FOREIGN KEY (id_genero) REFERENCES genero(id_genero),
	FOREIGN KEY (id_foto) REFERENCES fotos(id_foto)
);

SELECT DATE_FORMAT(FROM_DAYS(DATEDIFF(now(), dt_nascimento)), '%Y')+0 AS Age from usuarios WHERE id_usuario = 7 LIMIT 1;

ALTER TABLE usuarios
ADD bio VARCHAR(255);

ALTER TABLE usuarios
ADD cargo VARCHAR(255);

ALTER TABLE usuarios
ADD local_trabalho VARCHAR(255);

ALTER TABLE usuarios
ADD dt_nascimento DATETIME;


insert into interesses(interesse) VALUES ('teste'),('nome');

insert into genero(genero) VALUES ('Masculino'),('Feminino');

insert into interesseusuario(id_interesse, id_usuario) VALUES ('1','1'),('2','1');

insert into usuarios(nome, telefone, email, senha, id_genero)
VALUES ('Newton', '12333','new@h.com', 'teste', '1');



SELECT interesseusuario.id_usuario,interesse FROM usuarios 
        INNER JOIN interesseusuario 
        ON usuarios.id_usuario = interesseusuario.id_usuario
        INNER JOIN interesses
        ON interesses.id_interesse = interesseusuario.id_interesse 
        group by interesse
        HAVING interesseusuario.id_usuario = 7;
        
SELECT * FROM interesseusuario

        
        
        