CREATE TABLE genero(
	id_genero int AUTO_INCREMENT PRIMARY KEY,
    genero VARCHAR(255)
);

create table interesses(
id_interesse int AUTO_INCREMENT PRIMARY KEY,
interesse VARCHAR(255));

create table usuarios(
id_usuario int AUTO_INCREMENT PRIMARY key,
nome varchar(30),
telefone varchar(30),
email varchar(40),
senha varchar(32),
id_genero INT,
id_interesse INT,
FOREIGN KEY (id_genero) REFERENCES genero(id_genero),
FOREIGN KEY (id_interesse) REFERENCES interesses(id_interesse)
);




