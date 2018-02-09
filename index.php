<?php
require_once('functions.php');

$is_auth = (bool) rand(0, 1);
 
$user_name = 'Константин';
$user_avatar = 'img/user.jpg';
 
$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];

$ads_list = [
    [   'name' => '2014 Rossignol District Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 10999,
        'img_url' => 'img/lot-1.jpg'
    ],
    [   'name' => 'DC Ply Mens 2016/2017 Snowboard',
        'category' => 'Доски и лыжи',
        'price' => 159999,
        'img_url' => 'img/lot-2.jpg'
    ],
    [   'name' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'category' => 'Крепления',
        'price' => 8000,
        'img_url' => 'img/lot-3.jpg'
    ],
    [   'name' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'category' => 'Ботинки',
        'price' => 10999,
        'img_url' => 'img/lot-4.jpg'
    ],
    [   'name' => 'Куртка для сноуборда DC Mutiny Charocal',
        'category' => 'Одежда',
        'price' => 7500,
        'img_url' => 'img/lot-5.jpg'
    ],
    [   'name' => 'Маска Oakley Canopy',
        'category' => 'Разное',
        'price' => 5400,
        'img_url' => 'img/lot-6.jpg'
    ]
    ];
    
function format_price($price) {
    $ceil_price=ceil($price);
        if ($ceil_price > 1000) {
        $ceil_price = number_format($ceil_price, 0, '', ' ');
    }
        return $ceil_price. ' &#8381';
};

$content = include_template('template/index.php', ['data' => $data]);

$layout_content = Include_Template('templates/layout.php', 
['content' => $content,
 'title' => 'YetiCave - Главная',
 'category' => $categories
]);
print($layout_content);

?>