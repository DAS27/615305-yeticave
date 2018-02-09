<?php

function format_price($price) { // Округляет и форматирует цену
    $ceil_price=ceil($price);
        if ($ceil_price > 1000) {
        $ceil_price = number_format($ceil_price, 0, '', ' ');
    }
        return $ceil_price. ' &#8381';
};

function renderTemplate($templates, $data) { // Подключает шаблон
	if(file_exists($templates)) {
		ob_start();
		extract($data);
		require_once($templates);
		return ob_get_clean();
	}
		return "";
	}
?>