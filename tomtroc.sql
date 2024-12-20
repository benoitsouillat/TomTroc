-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 nov. 2023 à 12:39
-- Version du serveur : 5.7.36
-- Version de PHP : 8.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

DROP TABLE IF EXISTS `books`;
DROP TABLE IF EXISTS `messages`;
DROP TABLE IF EXISTS `conversations`;
DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT(20) NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `pseudo` VARCHAR(50) NOT NULL, 
    `thumbnail` VARCHAR(255),
    PRIMARY KEY(`id`)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `books` (
    `id` INT(20) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `author` VARCHAR(50) NOT NULL,
    `description` TEXT NOT NULL,
    `available` BOOLEAN DEFAULT 1,
    `picture` VARCHAR(255),
    `owner` INT(20),
    PRIMARY KEY(`id`),
    FOREIGN KEY(`owner`) REFERENCES users(id)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `conversations` (
    `id` INT(20) NOT NULL AUTO_INCREMENT,
    `user_from` INT(20) NOT NULL,
    `user_to` INT(20) NOT NULL, 
    PRIMARY KEY(`id`),
    FOREIGN KEY(`user_from`) REFERENCES users(id),
    FOREIGN KEY(`user_to`) REFERENCES users(id)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `messages` (
    `id` INT(20) NOT NULL AUTO_INCREMENT,
    `message` TEXT NOT NULL,
    `send_date` DATE NOT NULL,
    `user_from` INT(20) NOT NULL,
    `user_to` INT(20) NOT NULL, 
    `conversation` INT(20),
    PRIMARY KEY(`id`),
    FOREIGN KEY(`conversation`) REFERENCES conversations(id),
    FOREIGN KEY(`user_from`) REFERENCES users(id),
    FOREIGN KEY(`user_to`) REFERENCES users(id)
)
ENGINE = InnoDB DEFAULT CHARSET=utf8;

