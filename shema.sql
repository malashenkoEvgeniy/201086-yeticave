CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  USE yeticave;

  CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    alias CHAR (128),
    title CHAR (128)
  );
  CREATE UNIQUE INDEX u1 ON categories(alias);
  CREATE UNIQUE INDEX u2 ON categories(title);
  CREATE TABLE lots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lotstart DATETIME,
    name_lot CHAR (128),
    description TEXT,
    image CHAR (128),
    pricestart INT,
    dateover DATETIME,
    step INT,
    author_id INT,
    winer_id INT,
    category_id INT
  );
  CREATE TABLE bets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    price INT,
    ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    lot_id INT,
    user_id INT
  );
  CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    registration DATETIME,
    email CHAR (128),
    name_user CHAR (128),
    password CHAR (64),
    contact_details TEXT,
    avatar CHAR (128)
  );
  CREATE UNIQUE INDEX u3 ON users(email);
  CREATE INDEX usersEmail ON users(email);
  INSERT INTO users
    SET email = "ignat.v@gmail.com",
        name_user = "Игнат",
        password = "$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka";
  INSERT INTO users
    SET email = "kitty_93@li.ru",
        name_user = "Леночка",
        password = "$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa";
  INSERT INTO users
    SET email = "warrior07@mail.ru",
        name_user = "Руслан",
        password = "$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW";

  INSERT INTO bets
    SET user_id = 1,
    price = 11500;
  INSERT INTO bets
    SET user_id = 3,
    price = 11000;
  INSERT INTO bets
    SET user_id = 2,
    price = 10500;
  INSERT INTO bets
    SET user_id = 4,
    price = 110000;

  INSERT INTO categories
    SET alias = "boards",
        title = "Доски и лыжи";
  INSERT INTO categories
    SET alias = "mounting",
        title = "Крепления";
  INSERT INTO categories
    SET alias = "shoes",
        title = "Ботинки";
  INSERT INTO categories
    SET alias = "clothes",
        title = "Одежда";
  INSERT INTO categories
    SET alias = "tools",
        title = "Инструменты";
  INSERT INTO categories
    SET alias = "other",
        title = "Разное";
  INSERT INTO lots
    SET name_lot = "2014 Rossignol Disctrict Snowboard",
        category_id =  1,
        pricestart = 10999,
        image = "lot-1.jpg";
  INSERT INTO lots
    SET name_lot = "DC Ply Mens 2016/2017 Snowboard",
        category_id =  1,
        pricestart = 159999,
        description = 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
          снег
          мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
          снаряд
          отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
          кэмбер
          позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
          просто
          посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
          равнодушным.',
        image = "lot-2.jpg";
  INSERT INTO lots
    SET name_lot = "Крепления Union Contact Pro 2015 года размер L/XL",
        category_id =  2,
        pricestart = 8000,
        image = "lot-3.jpg";
  INSERT INTO lots
    SET name_lot = "Ботинки для сноуборда DC Mutiny Charcoal",
        category_id =  3,
        pricestart = 10999,
        image = "lot-4.jpg";
  INSERT INTO lots
    SET name_lot = "Куртка для сноуборда DC Mutiny Charcoal",
        category_id =  4,
        pricestart = 7500,
        image = "lot-5.jpg";
  INSERT INTO lots
    SET name_lot = "Маска Oakley Canopy",
        category_id =  5,
        pricestart = 5400,
        image = "lot-6.jpg";
