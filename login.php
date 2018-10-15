<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

$query = "SELECT id, email, password FROM users";
$users = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$login_users = $_POST;
	$dict = ['email' => 'электронная почта', 'password' => 'пароль'];
  $required = array_keys($dict);
	$errors = [];
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
		}

	}
	$email = mysqli_real_escape_string($link, $login_users['email']);
	$sql = "SELECT id, email, name_user, password, avatar FROM users WHERE email = '$email'";
	$res = mysqli_query($link, $sql);
	$user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
	if (!count($errors) and $user) {
		if (password_verify($login_users['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		} else {
			$errors['password'] = 'Неверный пароль';
		}
	} else {
		$errors['email'] = 'Такой пользователь не найден';
	}
	if (count($errors)) {
		$page_content = include_template('login.php', [
                                                 'errors' => $errors,
                                                 'dict' => $dict,
                                                 'categories' => $categories]);
	} else {
    header("Location: index.php" );
		$page_content = include_template('login.php', ['data_users' => $data_users,
                                                    'categories' => $categories]);
	}
} else {
	$page_content = include_template('login.php', ['categories' => $categories]);
}
$content = include_template('layout.php', [	'content'    => $page_content,
                                            'categories' => $categories,
                                            'title'      => 'Yeticave - Регистрация',
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);
print($content);
