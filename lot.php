<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

mysqli_query($link, "SET NAMES 'utf8'");

$query = "SELECT id, price, ts, lot_id, user_id FROM bets";
$bets = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if (isset($_GET['id'])) {
  $id_lot = (int)$_GET['id'];
  $query = "SELECT id, name_lot, image, category_id, pricestart, description, step FROM lots WHERE id=$id_lot";
} else {
  $query = "SELECT id, name_lot, image, category_id, pricestart, description, step FROM lots";
}
$goods = get_array_in_base($link, $query);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$bets_us = $_POST;
	$dict = ['cost' => 'Ваша ставка'];
  $required = array_keys($dict);
	$errors = [];
	if (empty($_POST['cost'])) {
            $errors['cost'] = 'Это поле надо заполнить';
	}
  if  ($bets_us['cost'] < ($goods[0]['pricestart'] + $goods[0]['step']))  {
     $errors['cost'] = 'Это поле не может быть меньше минимальной ставки';
  } else {
    if (count($errors)) {
      $page_content = include_template('lot.php', ['errors' => $errors,
                                                   'bets'=> $bets,
                                                   'dict' => $dict,
                                                   'categories' => $categories]);
    } else {
      $sql = 'INSERT INTO bets (ts, price, lot_id, user_id) VALUES (NOW(), ?, ?, ?)';
      $stmt = db_get_prepare_stmt($link, $sql, [$bets_us['cost'],
                                                $goods[0]['id'],
                                                $user_id
                                              ]);
      $res = mysqli_stmt_execute($stmt);
      if ($res) {
        $sign_id = mysqli_insert_id($link);
      }
    }
  }
}
if (!empty($goods)) {
  $lot_content = include_template('lot.php', ['categories' => $categories,
                                              'bets'=> $bets,
                                              'goods' => $goods[0],
                                              'errors' => $errors,
                                              'config' => $config,
                                              'is_auth' => $is_auth] );
} else {
  $lot_content = include_template('error.php', ['error' => mysqli_error($link)]);
}
$content = include_template('layout.php', ['content'=>$lot_content,
																					 'categories' => $categories,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);

print($content);

