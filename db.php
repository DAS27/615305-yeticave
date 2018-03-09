<?php

require_once ('config.php');
require_once ('mysql_helper.php');

function db_connect() {
    $handler = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    mysqli_set_charset($handler, 'utf-8');

    if (! $handler) {
        die('Ошибка подключения к базе данных. Проверьте настройки.');
    }

    return $handler;
}

function db_get_open_lots($db_handler) {
    $sql = '
    select
        lots.id as lotId,
        lots.name as lotName,
        lots.price as lotPrice,
        lots.description as lotDescription,
        lots.image_path as lotImagePath,
        lots.category_id as lotCategoryId,
        lots.author_id as lotAuthorId,
        lots.end_lot_date as lotEndDate,
        users.name lotAuthorName,
        categories.name lotCategoryName
    from lots
    inner join categories
        on lots.category_id = categories.id
    inner join users
        on lots.author_id = users.id
    where
        lots.end_lot_date > NOW()
    ';

    $stmt = db_get_prepare_stmt($db_handler, $sql);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        return [];
    }

    $res = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

function db_get_lot_by_id($db_handler, $lotId) {
    $sql = '
    select
        lots.id as lotId,
        lots.name as lotName,
        lots.price as lotPrice,
        lots.description as lotDescription,
        lots.image_path as lotImagePath,
        lots.category_id as lotCategoryId,
        lots.author_id as lotAuthorId,
        lots.end_lot_date as lotEndDate,
        users.name lotAuthorName,
        categories.name lotCategoryName
    from lots
    inner join categories
        on lots.category_id = categories.id
    inner join users
        on lots.author_id = users.id
    where
        lots.id = ?
    ';

    $stmt = db_get_prepare_stmt($db_handler, $sql, [$lotId]);
    $result = mysqli_stmt_execute($stmt);

    if (!$result) {
        return [];
    }

    $res = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_all($res, MYSQLI_ASSOC);

}

function db_get_user_by_email($db_handler, $userEmail) {
    // Запрос к таблице пользователей

    // select user_email from users where user_email = ?
}

function db_add_new_lot($db_handler, $lot) {
    $sql = '
        insert into lots (name, price, description, image_path, category_id,
                         author_id, end_lot_date, rate_step, winner_id, created_date)
        values (?, ?, ?, ?, ?, ?, ?, ?, NULL, NOW())';

    $stmt = db_get_prepare_stmt($db_handler, $sql, $lot);
    return mysqli_stmt_execute($stmt);
}

function db_add_new_user($db_handler, $user) {
    $sql = '
        insert into users (email, password, name, contacts, avatar)
        values (?, ?, ?, ?, NULL)';

    $stmt = db_get_prepare_stmt($db_handler, $sql, $user);
    return mysqli_stmt_execute($stmt);
}


function db_get_categories($db_handler) {
  $sql = '
    select
        categories.id as categoryId,
        categories.name as categoryName
    from categories';

  $stmt = db_get_prepare_stmt($db_handler, $sql);
  $result = mysqli_stmt_execute($stmt);

  if (!$result) {
      return [];
  }

  $res = mysqli_stmt_get_result($stmt);

  return mysqli_fetch_all($res, MYSQLI_ASSOC);
}

$db_handler = db_connect();

$newLot = [
    'Тестовый лот',
    10500,
    'Проверка добавления информации о лоте',
    'img/avatar.jpg',
    1,
    1,
    '2018-05-10 00:00:00',
    500
];



// var_dump(db_add_new_lot($db_handler, $newLot));
// $result = db_get_categories($db_handler);


