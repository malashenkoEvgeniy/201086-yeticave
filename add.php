<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';


$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");

$query = "SELECT id, name_lot, image, category_id, pricestart, description FROM lots";
$goods = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$lots = $_POST;

	$required = ['lot-name', 'category', 'message', 'file', 'lot-rate', 'lot-step', 'lot-date'];
	$dict = ['lot-name' => 'Название', 'category' => 'категория лота', 'message' => 'Описание', 'file' => 'фото лота', 'lot-rate'=>'Начальная цена', 'lot-step'=>'Шаг ставки', 'lot-date'=>'Дата окончания торгов'];
	$errors = [];
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
		}
	}
  var_dump($_FILES);
    var_dump($_POST);

	if (isset($_FILES['file']['lot-name'])) {
		$tmp_name = $_FILES['file']['tmp_name'];
		$path = $_FILES['file']['lot-name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "image/img") {
			$errors['file'] = 'Загрузите картинку';
		}
		else {
			move_uploaded_file($tmp_name, 'uploads/' . $path);
			$gif['path'] = $path;
		}
	}
	else {
		$errors['file'] = 'Вы не загрузили файл';
	}

	if (count($errors)) {
		$page_content = include_template('add.php', ['lots' => $lots, 'errors' => $errors, 'dict' => $dict]);
	}
	else {
		$page_content = include_template('lot.php', ['lots' => $lots]);
	}
}
else {
	$page_content = include_template('add.php', []);
}

$content = include_template('layout.php', [
	'content'    => $page_content,
	'categories' => [],
	'title'      => 'Yeticave - Добавление лота'
]);


/*
$add_content = include_template('add.php', ['categories' => $categories,
                                            'goods' => $goods,
                                            'config' => $config]);

$content = include_template('layout.php', ['content'=>$add_content,
																					 'categories' => $categories,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);*/
print($content);


