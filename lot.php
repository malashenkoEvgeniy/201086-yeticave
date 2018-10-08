<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';



mysqli_query($link, "SET NAMES 'utf8'");

$query = "SELECT id, name_lot, image, category_id, pricestart, description FROM lots";
$goods = get_array_in_base($link, $query);

$query = "SELECT title, id FROM categories";
$categories= get_array_in_base($link, $query);

if (isset($_GET['id'])) {
    	$id_lot = $_GET['id'];
  	}

    $query = "SELECT id, name_lot, image, category_id, pricestart, description FROM lots WHERE id=$id_lot";

    if ($res = mysqli_query($link, $query)) {
        $goods = mysqli_fetch_assoc($res);
        $lot_content = include_template('lot.php', ['categories' => $categories,
                                                    'goods' => $goods,
                                                    'config' => $config]);
    }
    else {
        $lot_content = include_template('error.php', ['error' => mysqli_error($link)]);
    }



$content = include_template('layout.php', ['content'=>$lot_content,
																					 'categories' => $categories,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);
print($content);
