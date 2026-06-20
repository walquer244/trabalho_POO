-- Create database and tables for Sprint project

DROP DATABASE IF EXISTS `sprint_db`;
CREATE DATABASE IF NOT EXISTS `sprint_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `sprint_db`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','funcionario') NOT NULL DEFAULT 'funcionario',
  `remember_token` VARCHAR(100) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Produtos table
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `cor` VARCHAR(255) NOT NULL,
  `quantidade_estoque` INT UNSIGNED NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Funcionarios table
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `data_admissao` DATE NOT NULL,
  `funcao` VARCHAR(255) NOT NULL,
  `salario` DECIMAL(10,2) NOT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Clientes table
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `idade` INT UNSIGNED NOT NULL,
  `quantidade_compras` INT UNSIGNED NOT NULL DEFAULT 0,
  `desconto` DECIMAL(5,2) NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: seeds example (inserts admin and employee users)
INSERT INTO `users` (`email`, `password`, `role`, `created_at`, `updated_at`)
VALUES 
('admin@sprint.com', '$2y$10$BPYh.6KtCBzEyTQIF0wq.u1uv8hkNx92gAjncyU3cgvxK/Nhw/RjC', 'admin', NOW(), NOW()),
('funcionario@sprint.com', '$2y$10$RxMuDL4zNY7NhHjWBXKBOedTHjJYsAfdEk.S0O2OhvqNAAvZeFzTS', 'funcionario', NOW(), NOW());
