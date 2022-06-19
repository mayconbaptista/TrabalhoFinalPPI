CREATE TABLE `aluno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=latin1;

CREATE TABLE `aluno_disciplina` (
  `disciplina_id` bigint(20) NOT NULL,
  `matricula_id` bigint(20) NOT NULL,
  `curso_id` bigint(20) NOT NULL,
  `aluno_id` bigint(20) NOT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `aprovado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`disciplina_id`,`matricula_id`,`curso_id`,`aluno_id`),
  KEY `aluno_disciplina_FK_2` (`curso_id`),
  CONSTRAINT `aluno_disciplina_FK_1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`),
  CONSTRAINT `aluno_disciplina_FK_2` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `curso_disciplina` (
  `curso_id` bigint(20) NOT NULL,
  `disciplina_id` bigint(20) NOT NULL,
  `data_desativacao` datetime DEFAULT NULL,
  PRIMARY KEY (`curso_id`,`disciplina_id`),
  KEY `curso_disciplina_FK_1` (`disciplina_id`),
  CONSTRAINT `curso_disciplina_FK` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `curso_disciplina_FK_1` FOREIGN KEY (`disciplina_id`) REFERENCES `disciplina` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- treinamento_universidade.matricula definition

CREATE TABLE `matricula` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` bigint(20) NOT NULL,
  `aluno_id` bigint(20) NOT NULL,
  `ano` int(4) NOT NULL,
  `semestre` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matricula_FK_1` (`curso_id`),
  CONSTRAINT `matricula_FK_1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- treinamento_universidade.disciplina definition

CREATE TABLE `disciplina` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `carga_horaria` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- treinamento_universidade.curso definition

CREATE TABLE `curso` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_encerramento` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

CREATE DATABASE `treinamento_universidade` /*!40100 DEFAULT CHARACTER SET utf8mb4 */