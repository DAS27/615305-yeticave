<?php
require_once 'functions.php';
require_once 'data.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $lot = $_POST;

    $required = ['lot-name', 'message'];
    $dict = ['lot-name' => 'Наименование', 'message' => 'Описание'];
    $errors = [];

    foreach ($required as $key) {
        if(empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить!';
        }
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
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print ($layout_content);