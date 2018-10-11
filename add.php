<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';


if (!$is_auth){
	header('HTTP/1.0 403 Forbidden', true, 403);
	die();
}
$query = "SELECT id, name_lot, image, category_id, pricestart, description FROM lots";
$goods = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$lots = $_POST;


	$dict = ['lot-name' => 'Название', 'category' => 'категория лота', 'message' => 'Описание',  'lot-rate'=>'Начальная цена', 'lot-step'=>'Шаг ставки', 'lot-date'=>'Дата окончания торгов'];
  $required = array_keys($dict);
	$errors = [];
	foreach ($required as $key) {
		if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
		}
	}
	if (!empty($_FILES['file-lot']['name'])) {
		$tmp_name = $_FILES['file-lot']['tmp_name'];
		$path = $_FILES['file-lot']['name'];

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$file_type = finfo_file($finfo, $tmp_name);
		if ($file_type !== "image/jpeg") {
			$errors['file'] = 'Загрузите картинку';
		}
		else {
			move_uploaded_file($tmp_name, 'img/' . $path);
			$lots['path'] = $path;

		}
	}
	else {
		$errors['file'] = 'Вы не загрузили файл';
	}


	if (count($errors)) {
		$page_content = include_template('add.php', ['lots' => $lots,
                                                 'errors' => $errors,
                                                 'dict' => $dict,
                                                 'categories' => $categories]);
	} else {
    $sql = 'INSERT INTO lots (lotstart, name_lot, description, image, pricestart, dateover, step, category_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?)';


    $stmt = db_get_prepare_stmt($link, $sql, [
                                            $lots['lot-name'],
                                            $lots['message'],
                                            $lots['path'],
                                            $lots['lot-rate'],
                                            $lots['lot-date'],
                                            $lots['lot-step'],
                                            get_category_id_byname($categories, $lots['category'])
                                              ]);
        $res = mysqli_stmt_execute($stmt);
        if ($res) {
            $lot_id = mysqli_insert_id($link);

            header("Location: lot.php?id=" . $lot_id);
        }
		$page_content = include_template('lot.php', ['lots' => $lots]);
	}




}
else {
	$page_content = include_template('add.php', ['categories' => $categories]);
}

$content = include_template('layout.php', [	'content'    => $page_content,
                                            'categories' => $categories,
                                            'title'      => 'Yeticave - Добавление лота',
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name
]);

print($content);


