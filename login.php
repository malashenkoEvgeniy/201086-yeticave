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

  $counte =0;
  foreach($users as $user){
      if ($user['email'] == $login_users['email']) {
        $counte ++;
        if (!password_verify($login_users['password'], $user['password'])) {
          $errors['password'] = 'Не верный пароль';
        } else {
          $login_id = $user['id'];

        }
      }
    }
  if ($counte == 0) {
        $errors['email'] = 'Необходимо зарегистрирывать почту';
      }

	if (count($errors)) {
		$page_content = include_template('login.php', [
                                                 'errors' => $errors,
                                                 'dict' => $dict,
                                                 'categories' => $categories]);
	} else {

            header("Location: index.php?id=" . $login_id);

		$page_content = include_template('login.php', ['data_users' => $data_users,
                                                    'categories' => $categories]);
	}




}
else {
	$page_content = include_template('login.php', ['categories' => $categories]);
}

$content = include_template('layout.php', [	'content'    => $page_content,
                                            'categories' => $categories,
                                            'title'      => 'Yeticave - Регистрация'
]);

print($content);


