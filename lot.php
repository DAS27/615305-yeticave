<?php   
require_once 'functions.php';
require_once 'data.php';

$lot = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $search_id = array('id' => $id);
    if (array_key_exists('id', $search_id)) {
        $lot = $item;
    }
}


if ($lot === null) {
	http_response_code(404);
}

$page_content = render_template('lot', ['lot' => $lot]);

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print($layout_content);