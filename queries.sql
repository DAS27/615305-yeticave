--Добавление категорий
insert into categories (name) values
 ('Доски и лыжи'),
 ('Ботинки'),
 ('Одежда'),
 ('Крепления'),
 ('Инструменты'),
 ('Разное');

--Добавление пользователей
 insert into users (email, password, name) values
 ('ignat.v@gmail.com', '$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka', 'Игнат'),
 ('kitty_93@li.ru', '$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa', 'Леночка'),
 ('warrior07@mail.ru', '$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW', 'Руслан');

--Добавление лотов

 insert into lots (name, price, description, image_path, category_id, author_id, winner_id, created_date, end_lot_date, rate_step) values
('2014 Rossignol District Snowboard', 10999, 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами.', 'img/lot-1.jpg', 1, 3, NULL, '2018-03-07 12:00:00', '2018-04-07 00:00:00', 100),
('DC Ply Mens 2016/2017 Snowboard', 159999, 'Руби такие трюки, которые прежде боялся сделать.', 'img/lot-2.jpg', 1, 2, NULL, '2018-03-07 10:00:00', '2018-03-27 00:00:00', 200),
('Крепления Union Contact Pro 2015 года размер L/XL', 8000, 'Новые сноубордические крепления средней жесткости (6/10), которые в 2001 году завоевали первую славу и с того момента становятся только лучше, ежегодно модернизируясь по всем параметрам.', 'img/lot-3.jpg', 4, 2, NULL, '2018-03-07 12:00:00', '2018-04-27 00:00:00', 50),
('Ботинки для сноуборда DC Mutiny Charocal', 10999, 'Удобство и надежность фиксации ноги превращают катание в удовольствие.', 'img/lot-4.jpg', 2, 3, NULL, '2018-03-07 12:00:00', '2018-04-01 00:00:00', 100),
('Куртка для сноуборда DC Mutiny Charocal', 7500, 'Современный стиль сочетается с прочной и технической двухсторонней стрейч-твиной. Технология MotionFit позволяет свободно передвигаться, а 100г теплая изоляция AdvancedSkin обеспечивает отличную теплоту.', 'img/lot-5.jpg', 3, 2, NULL, '2018-03-07 12:00:00', '2018-04-05 00:00:00', 90),
('Маска Oakley Canopy', 5400, 'Перед Вами самая новейшая маска Oakley Canopy, включающая в себя как лицевую маску-гейтор, так и запасную линзу. ', 'img/lot-6.jpg', 6, 1, NULL, '2018-03-07 12:00:00', '2018-04-20 00:00:00', 50);


--Добавление ставок
insert into bets (created_date, price, user_id, lot_id) values
('2018-03-07 18:00:00', 11500, 1, 16),
('2018-03-07 19:00:00', 11000, 2, 17),
('2018-03-07 20:00:00', 10500, 3, 18);

--Получение категорий
select
 categories.id as categoryId,
 categories.name as categoryName
from categories

--Получение открытых лотов
select
 lots.id as lot_id,
 lots.name as lot_name,
 lots.price as lot_price,
 lots.description as lot_description,
 lots.image_path as lot_image_path,
 lots.category_id as lot_category_id,
 lots.author_id as lot_author_id,
 lots.end_lot_date as end_lot_date,
 users.name,
 categories.name
from lots
inner join categories
 on lots.category_id = categories.id
inner join users
 on lots.author_id = users.id
where
 lots.end_lot_date > NOW()
 ;

-- Получение лота по ID
select
 lots.id as lot_id,
 lots.name as lot_name,
 lots.price as lot_price,
 lots.description as lot_description,
 lots.image_path as lot_image_path,
 lots.category_id as lot_category_id,
 lots.author_id as lot_author_id,
 lots.end_lot_date as end_lot_date,
 users.name,
 categories.name
from lots
inner join categories
 on lots.category_id = categories.id
inner join users
 on lots.author_id = users.id
where
 lots.id = 18
;

-- Обновление названия лота

update lots
set name = 'Маска 2000'
where lots.id = 18
;

-- Получение свежих ставок лота

select
	bets.id as betId,
	bets.created_date as betCreatedDate,
	bets.user_id as betUserId,
	bets.lot_id as lotId
from bets
WHERE bets.lot_id = 18
ORDER BY bets.created_date DESC
;
