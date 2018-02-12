<?php   
require_once 'functions.php';
require_once 'data.php';

$lots = null;

if (isset($_GET['lots_id'])) {
    $lots_id = $_GET['lots_id'];
        foreach ($lots_list as $item) {
        if ($item['id'] == $lots_id) {
            $lots=$item;
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