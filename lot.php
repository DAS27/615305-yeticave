<?php   
require_once 'functions.php';
require_once 'data.php';

$lot = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    foreach ($lots as $item) {
        if ($id = $item) {
            $lot = $item;
        break;
        }
    }
}

if (!$lots) {
	http_response_code(404);
}

$page_content = render_template('lot', ['lots' => $lots]);

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);
print($layout_content);