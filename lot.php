<?php   
require_once 'config.php';
require_once 'functions.php';
require_once 'data.php';

$lots_list = null;

if (isset($_GET['id'])) {
    foreach ($lots_list as $id => $item) {
        if ($id == $_GET['id']) {
            $lots_list=$item;
        break;
        }
    }
}

if (!$lots) {
	http_response_code(404);
}

$page_content = render_template('lot', ['lots_list' => $lots_list]);

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);
print($layout_content);