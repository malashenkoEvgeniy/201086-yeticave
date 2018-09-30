<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT name_lot, image, category_id, price FROM goods";
$result = mysqli_query($link, $query) or die( mysqli_error($link) );
$goods = mysqli_fetch_all($result, MYSQLI_ASSOC);

$query = "SELECT title_description FROM category";
$result = mysqli_query($link, $query) or die( mysqli_error($link) );

$category= mysqli_fetch_all($result, MYSQLI_ASSOC);

$page_content = include_template('index.php', ['category' => $category,
                                               'goods' => $goods,
                                               'config' => $config]);
$content = include_template('layout.php', ['content'=>$page_content,
																					 'category' => $category,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);
print($content);

