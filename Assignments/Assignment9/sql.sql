CREATE DATABASE mydatabase;
USE mydatabase;

CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    timestamp INT NOT NULL,
    note TEXT NOT NULL
);
