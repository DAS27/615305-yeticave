<?php
require_once 'functions.php';
require_once 'data.php';

$lot = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($lots as $key => $item) {
        if ($key == $id) {

            $lot = $item;
        break;
        }
    }
    cookies_write($cookie_name_id_lot, $id, $cookie_live, $cookie_path);
}

if ($lot === null) {
	http_response_code(404);
}

$page_content = render_template('lot', ['lot' => $lot]);

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Просмотр лота',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print($layout_content);
