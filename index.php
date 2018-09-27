<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

$link = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8'");
$query = "SELECT * FROM goods WHERE id > 0";
$result = mysqli_query($link, $query) or die( mysqli_error($link) );
for ($data_goods = []; $row = mysqli_fetch_assoc($result); $data_goods[] = $row);
$query = "SELECT * FROM category WHERE id > 0";
$result = mysqli_query($link, $query) or die( mysqli_error($link) );
for ($data_category = []; $row = mysqli_fetch_assoc($result); $data_category[] = $row);

$category_key=[];
$category_val=[];
for($k=0; $k<count($data_category);$k++){
	$num = array_push($category_key, $data_category[$k]['title']);
	$num = array_push($category_val, $data_category[$k]['title_description']);
}
$goods = []; $goods_el = [];
for($l=0; $l<count($data_goods);$l++){
	switch ($data_goods[$l]['category_id']) {
		case 1 : $data_goods[$l]['category_id'] = $category_val[0];
			break;
		case 2 : $data_goods[$l]['category_id'] = $category_val[1];
			break;
		case 3 : $data_goods[$l]['category_id'] = $category_val[2];
			break;
		case 4 : $data_goods[$l]['category_id'] = $category_val[3];
			break;
		case 5 : $data_goods[$l]['category_id'] = $category_val[4];
			break;
		case 6 : $data_goods[$l]['category_id'] = $category_val[5];
			break;				
	} 
	$goods_el = [
    'name' => $data_goods[$l]['name_lot'],
    'category' => $data_goods[$l]['category_id'],
    'price' => $data_goods[$l]['price'],
    'image' => $data_goods[$l]['image']
  ];
	$num = array_push($goods, $goods_el);
}
$category = array_combine($category_key, $category_val);

$page_content = include_template('index.php', ['category' => $category,
                                               'goods' => $goods,
                                               'config' => $config]);
$content = include_template('layout.php', ['content'=>$page_content,
																					 'category' => $category,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);
print($content);
