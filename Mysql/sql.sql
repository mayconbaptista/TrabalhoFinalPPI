CREATE DATABASE Classificados;

CREATE TABLE base
(
    id int NOT NULL AUTO_INCREMENT,
    cep char(9) NOT NULL UNIQUE,
    bairro varchar(50) NOT NULL,
    cidade varchar(50) NOT NULL,
    estado char(2) NOT NULL,
    PRIMARY KEY(id)

)ENGINE=InnoDB;

CREATE TABLE anunciante
(
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(50) NOT NULL,
    cpf char(11) NOT NULL UNIQUE,
    email varchar(30) NOT NULL UNIQUE,
    senhaHash varchar(50) NOT NULL,
    telefone char(11) NOT NULL,
    PRIMARY KEY(id)

)ENGINE=InnoDB;

CREATE TABLE anuncio
(
    id int NOT NULL AUTO_INCREMENT,
    titulo varchar(20) NOT NULL,
    descricao varchar(500),
    preco float NOT NULL,
    data_hora datetime,
    cep char(9) NOT NULL,
    bairro varchar(20) NOT NULL,
    cidade varchar(50) NOT NULL,
    estado char(2) NOT NULL,
    categoria_id int NOT NULL,
    anunciante_id int NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(categoria_id) REFERENCES categoria(id) ON DELETE CASCADE,
    FOREIGN KEY(anunciante_id) REFERENCES anunciante(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE categoria
(
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(50) NOT NULL,
    descricao varchar(500) NOT NULL,

    PRIMARY KEY(id)
)ENGINE=InnoDB;

CREATE TABLE interesse
(
    id int NOT NULL AUTO_INCREMENT,
    mensagem varchar(500),
    data_hora datetime,
    contato char(11) NOT NULL,
    anuncio_id int NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(anuncio_id) REFERENCES anuncio(id) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE foto
(
    id int NOT NULL,
    anuncio_id int NOT NULL,
    nome_arq_foto varchar(100) NOT NULL,

    FOREIGN KEY(anuncio_id) REFERENCES anuncio(id) ON DELETE CASCADE,
    PRIMARY KEY(id, anuncio_id)
)ENGINE=InnoDB;