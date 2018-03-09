<?php
require_once 'functions.php';
require_once 'data.php';
require_once 'db.php';

$categories = db_get_categories($db_handler);

$page_content = render_template('index', ['lots' => $lots]);



$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);
print($layout_content);
