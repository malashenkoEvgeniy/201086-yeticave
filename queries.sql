USE yeticave;
#обьеденяет таблицу категорий и товаров
#SELECT g.id, name_lot, price, image, title_description FROM goods g
#JOIN category c
#ON c.id = g.category_id;
#отображает Существующий список категорий
SELECT title, title_description FROM category WHERE id>0;
#Придумывает пару пользователей
INSERT INTO users
    SET email = "car07@mail.ru",
        name_user = "Влад",
        password = "";
INSERT INTO users
    SET email = "batman07@mail.ru",
        name_user = "Jhon",
        password = "";
#отображает Список объявлений
SELECT * FROM goods WHERE id>0;
#Добавьте пару ставок для любого объявления
  INSERT INTO bets
    SET name_user = "Kate",
    price = 21500;
  INSERT INTO bets
    SET name_user = "Helen",
    price = 11000;
#получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории;
SELECT * FROM `lots` WHERE 1
#показать лот по его id. Получите также название категории, к которой принадлежит лот
SELECT category FROM `lots` WHERE id = 2;
#обновить название лота по его идентификатору;
UPDATE lots SET name_lot="Крюк" WHERE id=1;
#получить список самых свежих ставок для лота по его идентификатору;
SELECT * FROM `bets` WHERE  lot_id=3;
