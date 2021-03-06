CREATE DATABASE yeticave
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 email VARCHAR(50) NOT NULL UNIQUE,
 password VARCHAR(60) NOT NULL,
 name VARCHAR(50) NOT NULL,
 avatar VARCHAR(255) NULL,
 contacts VARCHAR (50)
) ENGINE = InnoDB, CHARACTER SET = UTF8;

CREATE TABLE categories (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(50) NOT NULL
) ENGINE = InnoDB, CHARACTER SET = UTF8;

CREATE TABLE lots (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(200) NOT NULL,
 price INT UNSIGNED NOT NULL,
 description TEXT(600) NOT NULL,
 image_path VARCHAR(255) NOT NULL,
 category_id INT UNSIGNED NOT NULL,
 author_id INT UNSIGNED NOT NULL,
 winner_id INT UNSIGNED NOT NULL,
 created_date DATETIME NOT NULL,
 end_lot_date DATETIME NOT NULL,
 rate_step INT UNSIGNED NOT NULL,
 FOREIGN KEY (category_id) REFERENCES categories(id)
  ON UPDATE CASCADE,

 FOREIGN KEY (author_id) REFERENCES users(id)
  ON UPDATE CASCADE,

 FOREIGN KEY (winner_id) REFERENCES users(id)
  ON UPDATE CASCADE
) ENGINE = InnoDB, CHARACTER SET = UTF8;

CREATE TABLE bets (
id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
created_date DATETIME NOT NULL,
price INT UNSIGNED NOT NULL,
user_id INT UNSIGNED NOT NULL,
lot_id INT UNSIGNED NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(id)
ON UPDATE CASCADE,
FOREIGN KEY (lot_id) REFERENCES lots(id)
ON UPDATE CASCADE
) ENGINE = InnoDB, CHARACTER SET = UTF8;
