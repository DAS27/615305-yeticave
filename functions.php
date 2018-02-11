<?php

date_default_timezone_set('Europe/Moscow');

define('TEMPLATE_DIR_PATH', 'templates/');
define('TEMPLATE_EXT', '.php');

function format_price($price) { // Округляет и форматирует цену
    $ceil_price=ceil($price);
    
    if ($ceil_price > 1000) {
        $ceil_price = number_format($ceil_price, 0, '', ' ');
    }
    
    return $ceil_price. ' &#8381';
};

function render_template(string $template_name, array $data) { // Подключает шаблон
	if (file_exists(TEMPLATE_DIR_PATH . $template_name . TEMPLATE_EXT)) {
        extract($data);
		ob_start();
		require_once(TEMPLATE_DIR_PATH . $template_name . TEMPLATE_EXT);
		return ob_get_clean();
    }

	return '';
}