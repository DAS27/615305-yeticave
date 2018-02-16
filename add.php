<?php
require_once 'functions.php';
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot-name'];
    $dict = ['lot-name' => 'Наименование'];
    $errors = [];

    foreach ($_POST as $key) {
        if (empty($_POST[$key])) {
            $errors[$dict[$key]] = 'Это поле надо заполнить!';
            }
        }
    
    if (isset($_FILES['image']['name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
    
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/jpg") {
            $errors['file'] = 'Загрузите картинку в формате JPG';
        }
        else {
            move_uploaded_file($tmp_name, 'img/' . $path);
            $lot['path'] = $path;
        }
    }
    else {
        $errors['file'] = 'Вы не загрузили файл!';
    }
    if (count($errors)) {
        $page_content = rander_template('add', ['lot' => $lot, 'errors' => $errors, 'dict' => $dict]);
    }
    else {
        $page_content = rander_template('lot', ['lot' => $lot]);
    }
}

$page_content = render_template('add', []);

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print($layout_content);