<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");

$query = "SELECT alias, title, id FROM categories";
$categories= get_array_in_base($link, $query);
if (isset($_GET['alias'])) {
  $alias = get_category_id_byalias($categories, $_GET['alias']);
  $query = "SELECT id, name_lot, image, category_id, pricestart, description, step FROM lots WHERE category_id=$alias";
} else {
  $query = "SELECT id, name_lot, image, category_id, pricestart, description, step FROM lots";
}
$goods = get_array_in_base($link, $query);

$page_content = include_template('index.php', ['categories' => $categories,
                                               'goods' => $goods,
                                               'config' => $config]);
$content = include_template('layout.php', ['content'=>$page_content,
																					 'categories' => $categories,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);

print($content);
