CREATE DATABASE IF NOT EXISTS honda_dealership
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE honda_dealership;

CREATE TABLE IF NOT EXISTS usuarios (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    nome          VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL UNIQUE,
    senha         VARCHAR(255) NOT NULL,
    nivel_acesso  ENUM('admin', 'funcionario') NOT NULL DEFAULT 'funcionario',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS carros;
CREATE TABLE IF NOT EXISTS carros (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    marca         VARCHAR(80)     NOT NULL,
    modelo        VARCHAR(100)    NOT NULL,
    cor           VARCHAR(50)     NOT NULL,
    ano           INT             NOT NULL,
    valor         DECIMAL(12, 2)  NOT NULL,
    data_cadastro TIMESTAMP       DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS motos;
CREATE TABLE IF NOT EXISTS motos (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    marca         VARCHAR(80)     NOT NULL,
    modelo        VARCHAR(100)    NOT NULL,
    cor           VARCHAR(50)     NOT NULL,
    ano           INT             NOT NULL,
    valor         DECIMAL(12, 2)  NOT NULL,
    data_cadastro TIMESTAMP       DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS funcionarios (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nome            VARCHAR(100)   NOT NULL,
    funcao          VARCHAR(100)   NOT NULL,
    data_admissao   DATE           NOT NULL,
    data_nascimento DATE           NOT NULL,
    salario         DECIMAL(10, 2) NOT NULL,
    data_cadastro   TIMESTAMP      DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
