SELECT g.id, name_lot, price, image, title_description FROM goods g
JOIN category c 
ON c.id = g.category_id;
SELECT title, title_description FROM category WHERE id>0;
INSERT INTO users
    SET email = "car07@mail.ru",
        name = "Влад",
        password = "";
INSERT INTO users
    SET email = "batman07@mail.ru",
        name = "Jhon",
        password = "";
SELECT * FROM goods WHERE id>0;
  INSERT INTO bets
    SET name_user = "Kate",
    price = 21500;
  INSERT INTO bets
    SET name_user = "Helen",
    price = 11000;
