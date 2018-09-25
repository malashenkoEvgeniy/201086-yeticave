CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  USE yeticave;

  CREATE TABLE category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title CHAR (128),
    title_description CHAR (128)
  );
  CREATE UNIQUE INDEX u1 ON category(title);
  CREATE UNIQUE INDEX u2 ON category(title_description);
  CREATE TABLE goods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_lot CHAR (128),
    category_id CHAR (128),
    price INT,
    image CHAR (128)
  );
  CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_user CHAR (128),
    price INT,
    ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email CHAR (128),
    name CHAR (128),
    password CHAR (128)
  );
  CREATE UNIQUE INDEX u3 ON users(email);
  CREATE INDEX usersEmail ON users(email);
  INSERT INTO users
    SET email = "ignat.v@gmail.com",
        name = "Игнат",
        password = "$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka";
  INSERT INTO users
    SET email = "kitty_93@li.ru",
        name = "Леночка",
        password = "$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa";
  INSERT INTO users
    SET email = "warrior07@mail.ru",
        name = "Руслан",
        password = "$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW";

  INSERT INTO bets
    SET name_user = "Иван",
    price = 11500;
  INSERT INTO bets
    SET name_user = "Константин",
    price = 11000;
  INSERT INTO bets
    SET name_user = "Евгений",
    price = 10500;
  INSERT INTO bets
    SET name_user = "Семён",
    price = 110000;

  INSERT INTO category
    SET title = "boards",
        title_description = "Доски и лыжи";
  INSERT INTO category
    SET title = "mounting",
      title_description = "Крепления";
  INSERT INTO category
    SET title = "shoes",
      title_description = "Ботинки";
  INSERT INTO category
    SET title = "clothes",
      title_description = "Одежда";
  INSERT INTO category
    SET title = "tools",
      title_description = "Инструменты";
  INSERT INTO category
    SET title = "other",
      title_description = "Разное";
  INSERT INTO goods
    SET name_lot = "2014 Rossignol Disctrict Snowboard",
        category_id =  1,
        price = 10999,
        image = "lot-1.jpg";
  INSERT INTO goods
    SET name_lot = "DC Ply Mens 2016/2017 Snowboard",
        category_id =  1,
        price = 159999,
        image = "lot-2.jpg";
  INSERT INTO goods
    SET name_lot = "Крепления Union Contact Pro 2015 года размер L/XL",
        category_id =  2,
        price = 8000,
        image = "lot-3.jpg";
  INSERT INTO goods
    SET name_lot = "Ботинки для сноуборда DC Mutiny Charcoal",
        category_id =  3,
        price = 10999,
        image = "lot-4.jpg";
  INSERT INTO goods
    SET name_lot = "Куртка для сноуборда DC Mutiny Charcoal",
        category_id =  4,
        price = 7500,
        image = "lot-5.jpg";
  INSERT INTO goods
    SET name_lot = "Маска Oakley Canopy",
        category_id =  5,
        price = 5400,
        image = "lot-6.jpg";


