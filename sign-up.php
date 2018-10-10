<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

$query = "SELECT email FROM users";
$users = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$data_users = $_POST;


	$dict = ['email' => 'электронная почта', 'name_user' => 'имя пользователя','password' => 'пароль', 'contact_details' => 'контактные данные'];
  $required = array_keys($dict);
	$errors = [];
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
		}
	}

	if (!empty($_FILES['avatar']['name'])) {
		$tmp_name = $_FILES['avatar']['tmp_name'];
		$path = $_FILES['avatar']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "image/jpeg") {
			$errors['avatar'] = 'Загрузите картинку';
		}
		else {
			move_uploaded_file($tmp_name, 'img/' . $path);
			$data_users['path'] = $path;
		}
    /**/


	}
    foreach ($users as $user) {
		if ($data_users['email']==$user['email']) {
            $errors['email'] = 'Данная почта занята!';
		}
	}


	if (count($errors)) {
		$page_content = include_template('sign-up.php', [
                                                 'errors' => $errors,
                                                 'dict' => $dict,
                                                 'categories' => $categories]);
	} else {
    $sql = 'INSERT INTO users (registration, email, name_user, password, contact_details) VALUES (NOW(), ?, ?, ?, ?)';


    $stmt = db_get_prepare_stmt($link, $sql, [
                                            $data_users['email'],
                                            $data_users['name_user'],
                                            $data_users['password'],
                                            $data_users['contact_details']/*,
                                            $data_users['path']*/
                                            ]);

    $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $sign_id = mysqli_insert_id($link);

            header("Location: login.php?id=" . $lot_id);
        }
		$page_content = include_template('sign-up.php', ['data_users' => $data_users,
                                                    'categories' => $categories]);
	}




}
else {
	$page_content = include_template('sign-up.php', ['categories' => $categories]);
}

$content = include_template('layout.php', [	'content'    => $page_content,
                                            'categories' => $categories,
                                            'title'      => 'Yeticave - Регистрация'
]);

print($content);


