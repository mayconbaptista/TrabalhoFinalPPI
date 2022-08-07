CREATE TABLE baseEnderecosAjax
(
    codigo int NOT NULL AUTO_INCREMENT,
    cep char(9) NOT NULL UNIQUE,
    bairro varchar(50) NOT NULL,
    cidade varchar(50) NOT NULL,
    estado char(2) NOT NULL,
    PRIMARY KEY(id)

)ENGINE=InnoDB;

CREATE TABLE anunciante
(
    codigo int NOT NULL AUTO_INCREMENT,
    nome varchar(50) NOT NULL,
    cpf char(11) NOT NULL UNIQUE,
    email varchar(30) NOT NULL UNIQUE,
    senhaHash varchar(250) NOT NULL,
    telefone char(11) NOT NULL,
    PRIMARY KEY(codigo)

)ENGINE=InnoDB;

CREATE TABLE categoria
(
    codigo int NOT NULL AUTO_INCREMENT,
    nome varchar(50) NOT NULL,
    descricao varchar(500) NOT NULL,

    PRIMARY KEY(codigo)
)ENGINE=InnoDB;

CREATE TABLE anuncio
(
    codigo int NOT NULL AUTO_INCREMENT,
    titulo varchar(20) NOT NULL,
    descricao varchar(500),
    preco float NOT NULL,
    data_hora datetime,
    cep char(9) NOT NULL,
    bairro varchar(20) NOT NULL,
    cidade varchar(50) NOT NULL,
    estado char(2) NOT NULL,
    codCategoria int NOT NULL,
    codAnunciante int NOT NULL,

    PRIMARY KEY(codigo),
    FOREIGN KEY(codCategoria) REFERENCES categoria(codigo) ON DELETE CASCADE,
    FOREIGN KEY(codAnunciante) REFERENCES anunciante(codigo) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE interesse
(
    codigo int NOT NULL AUTO_INCREMENT,
    mensagem varchar(500),
    data_hora datetime,
    contato char(11) NOT NULL,
    codAnuncio int NOT NULL,

    PRIMARY KEY(codigo),
    FOREIGN KEY(codAnuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE
)ENGINE=InnoDB;

CREATE TABLE foto
(
    codigo int NOT NULL AUTO_INCREMENT,
    codAnuncio int NOT NULL,
    nomeArqFoto varchar(400) NOT NULL,

    FOREIGN KEY(codAnuncio) REFERENCES anuncio(codigo) ON DELETE CASCADE,
    PRIMARY KEY(codigo)
)ENGINE=InnoDB;