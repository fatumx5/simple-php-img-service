<?php

/*
 * script to create mysql-db tables for project's purposes
 */

    $host = '127.0.0.1';
    $db   = 'img_service';
    $user = 'root';
    $pass = '';
    $charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

try {
    $dbh = new PDO($dsn, $user, $pass, $opt);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

$dbh->query('create table Roles (
                                RoleID int NOT NULL AUTO_INCREMENT, 
                                Name varchar(255) NOT NULL UNIQUE,
                                PRIMARY KEY (RoleID)
                                );');

$dbh->query('CREATE TABLE Users (
                                UserID int NOT NULL AUTO_INCREMENT, 
                                Name varchar(255) NOT NULL UNIQUE,
                                Password varchar(255),
                                Remember_token varchar(255),
                                RoleID int, 
                                Created_at varchar(255),
                                Updated_at varchar(255),
                                PRIMARY KEY (UserID),
                                FOREIGN KEY (RoleID) REFERENCES Roles(RoleID)
                                );');

$dbh->query('CREATE TABLE Images(
                                ImageID int NOT NULL AUTO_INCREMENT, 
                                URL varchar(255) NOT NULL UNIQUE,
                                UserID int, 
                                Created_at varchar(255),
                                PRIMARY KEY (ImageID),
                                FOREIGN KEY (UserID) REFERENCES Users(UserID)
                                );');

