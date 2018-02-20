<?php
require_once 'functions.php';
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

$required = ['lot-name', 'category', 'message', 'lot_img', 'lot-rate', 'lot-step', 'lot-date'];
$dict = [
    'lot-name' => 'Наименование',
    'category' => 'Категория',
    'message' => 'Описание',
    'lot_img' => 'Изображение',
    'lot-rate' => 'Начальная цена',
    'lot-step' => 'Шаг ставки',
    'lot-date' => 'Дата окончания торгов'
];
$errors = [];

foreach ($required as $key) {
    if(empty($_POST[$key])) {
        $errors[$key] = 'Это поле надо заполнить!';
    }
}

if ($value === 'lot-name') {
     $value = trim($value);
       if (empty($value)) {
         $errors [] = "Уберите пробелы";
   }
}

if ((!is_int($lot['lot-rate']) && ($lot['lot-rate'] <= 0))) {
    $errors['lot-rate'] = 'Укажите корректное значение начальной цены в рублях!';
}

if ((!is_int($lot['lot-step']) && ($lot['lot-step'] <=0 ))) {
    $errors['lot-step'] = 'Укажите корректное значение шага ставки в рублях!';
}

if ((strtotime($lot['lot-date']) - strtotime('now')) < 86400) {
    $errors['lot-date'] = 'Укажите корректное число даты! Дата должна быть больше текущей даты хотя бы на один день!';
}

if (!empty($_FILES['userfile']['name'])) {
    $tmp_name = $_FILES['userfile']['tmp_name'];
    $path = $_FILES['userfile']['name'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_type = finfo_file($finfo, $tmp_name);

    if ($file_type !== "image/jpeg" && $file_type !== "image/png") {
    $errors['lot_img'] = 'Загрузите изображение лота в формате jpg или png';
    }

    else {
    move_uploaded_file($tmp_name, 'img/' . $path);
    $lot['path'] = $path;
    }
}

else {
    $errors['lot_img'] = 'Вы не загрузили изображение';
}

if (count($errors)) {
    $page_content = render_template('add', ['lot' => $lot, 'errors' => $errors, 'dict' => $dict]);
}
else {
    $page_content = render_template('lot', ['lot' => $lot]);
    }
}
else {
    $page_content = render_template('add', []);
}

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Добавление лота',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print ($layout_content);