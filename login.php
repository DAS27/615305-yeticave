<?php
require_once 'functions.php';
require_once 'userdata.php';
require_once 'data.php';

function check_email($email, $users) {
    if(empty($email)) {
        return 'Введите e-mail';
    }

    for($i =0 ; $i < count($users); $i++) {
        if($users[$i]['email'] === $email) {
            return '';
        }
    }

    return 'Пользователь с данным e-mail не найден';
}

function check_password($pass, $users) {
    if(empty($pass)) {
        return 'Введите пароль';
    }

    for($i =0 ; $i < count($users); $i++) {
        if(password_verify($pass, $users[$i]['password'])) {
            return '';
        }
    }

    return 'Неверно указан пароль';
}

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email_result = check_email($_POST['email'], $users);
    $password_result = check_password($_POST['password'], $users);

    if(!empty($email_result)) {
        $errors['email'] = $email_result;
    }

    if(!empty($password_result)) {
        $errors['password'] = $password_result;
    }

    if (count($errors)) {
        $page_content = render_template('login', ['errors' => $errors]);
    } else {
        session_start();
        for($i =0 ; $i < count($users); $i++) {
            if($users[$i]['email'] === $_POST['email']) {
                $_SESSION['user'] = $users[$i];
            }
        }
        header('Location: http://' . $_SERVER['HTTP_HOST']);
    }

} else {
    $page_content = render_template('login', ['errors' => $errors]);
}

$layout_content = render_template('layout',
['content' => $page_content,
 'title' => 'YetiCave - Вход',
 'categories' => $categories,
 'is_auth' => $is_auth,
 'user_name' => $user_name,
 'user_avatar' => $user_avatar
]);

print ($layout_content);
