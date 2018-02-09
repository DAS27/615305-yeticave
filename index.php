<?php
require_once 'functions.php';
require_once 'data.php';

$page_content = renderTemplate('templates/index.php', ['ads_list' => $ads_list]); 

$layout_content = renderTemplate('templates/layout.php', 
['content' => $page_content,
 'title' => 'YetiCave - Интернет-аукцион для сноубордического и горнолыжного снаряжения.',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);
print($layout_content);

?>