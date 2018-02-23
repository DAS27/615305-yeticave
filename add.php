<?php
require_once 'functions.php';
require_once 'data.php';

define('DAY_IN_SECONDS', 86400);
define('VALID_IMAGES_FORMAT', ['image/jpeg', 'image/png']);
define('IMG_PATH', 'img/');

function get_required_fields() {
    return [
        'lot-name',
        'category',
        'message',
        'lot-rate',
        'lot-step',
        'lot-date'
    ];
}

function is_correct_lot_rate($lot_rate) {
    return (is_int($lot_rate) && $lot_rate > 0);
}

function is_correct_lot_step($lot_step) {
    return (is_int($lot_step) && $lot_step > 0);
}

function is_correct_lot_date($lot_date) {
   return (strtotime($lot_date) - strtotime('now') > 0);
}

function is_correct_lot_category($category_index) {
    if ($category_index === -1) return false;
    // Потом мы добавим проверку
    return true;
}

function check_field(string $field_name, $value) {
    $description = '';
    $required_fields  = get_required_fields();

    if (in_array($field_name, $required_fields) && empty($value)) {
        $description = 'Это поле необходимо заполнить';
        return ['result' => false, 'description' => $description, 'value' => $value];
    }

    if ($field_name === 'lot-rate' && !is_correct_lot_rate((int)$value)) {
        $description = 'Укажите корректное значение начальной цены в рублях!';
        return ['result' => false, 'description' => $description, 'value' => $value];
    }

    if ($field_name === 'lot-step' && !is_correct_lot_step((int)$value)) {
        $description = 'Укажите корректное значение шага ставки в рублях!';
        return ['result' => false, 'description' => $description, 'value' => $value];
    }

    if ($field_name === 'lot-date' && !is_correct_lot_date($value)) {
        $description = 'Укажите корректное число даты! Дата должна быть больше текущей даты хотя бы на один день!';
        return ['result' => false, 'description' => $description, 'value' => $value];
    }

    if ($field_name === 'category' && !is_correct_lot_category((int)$value)) {
        $description = 'Выберите категорию.';
        return ['result' => false, 'description' => $description, 'value' => $value];
    }

    return ['result' => true, 'description' => $description];
}

function check_image_field() {
    $description = '';

    if (empty($_FILES['lot-photo']['name'])) {
        return ['result' => false, 'description' => 'Вы не загрузили изображение', 'image_path' => ''];
    }

    $tmp_name = $_FILES['lot-photo']['tmp_name'];
    $path = $_FILES['lot-photo']['name'];

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $file_type = finfo_file($finfo, $tmp_name);

    if (! in_array($file_type, VALID_IMAGES_FORMAT)) {
        return ['result' => false, 'description' => 'Загрузите изображение лота в формате jpg или png', 'image_path' => ''];
    }

    move_uploaded_file($tmp_name, IMG_PATH . $path);

    return ['result' => true, 'description' => '', 'image_path' => IMG_PATH . $path];
}


$errors = [];
$dict = [
    'lot-name' => 'Наименование',
    'category' => 'Категория',
    'message' => 'Описание',
    'lot-photo' => 'Изображение',
    'lot-rate' => 'Начальная цена',
    'lot-step' => 'Шаг ставки',
    'lot-date' => 'Дата окончания торгов'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $required_fields = get_required_fields();

    foreach ($required_fields as $field) {
        $result = check_field($field, $_POST[$field]);

        if (!$result['result']) {
            $errors[$field] = $result;
        }
    }

    // Проверка изображения. Выносим для удобства отдельно
    $result = check_image_field();

    if ($result['result']) {
        $_POST['lot-photo'] = $result['image_path'];
    } else {
        $errors['lot-photo'] = $result;
    }


    if (count($errors)) {
        $page_content = render_template('add', ['errors' => $errors, 'dict' => $dict, 'categories' => $categories]);
    } else {
        $page_content = render_template('lot', ['lot' => $_POST, 'categories' => $categories]);
    }

} else {
    $page_content = render_template('add', ['errors' => $errors, 'categories' => $categories]);
}

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Добавление лота',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print ($layout_content);
