<?php
require_once ('config.php'); // Подключает константы

function format_price($price) { // Округляет и форматирует цену
    $ceil_price = ceil($price);

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
};


function get_lot_time() { // Время жизни лота
    $ts = time();
    $ts_to_midnight = strtotime('tomorrow');
    $seconds_to_midnight = $ts_to_midnight - $ts;

    $hours = floor($seconds_to_midnight / 3600);
    $minutes = floor(($seconds_to_midnight % 3600) / 60);

    return "$hours : $minutes";
};

function print_var($array, $var_name, $key = '') {
    if (isset($array) && isset($array[$var_name])) {
        return !empty($key) ? $array[$var_name][$key] : $array[$var_name];
    }

    return '';
}

function cookies_write($name_cookies, $value, $expire, $path) {
    $history_lot = [];
    if (isset($_COOKIE[$name_cookies])) {
        $history_lot = json_decode($_COOKIE[$name_cookies]);
        if (!in_array($value, $history_lot)) {
            array_push($history_lot, $value);
        };
    }
    setcookie($name_cookies, json_encode($history_lot), $expire, $path);
};
