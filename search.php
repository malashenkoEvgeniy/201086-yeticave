<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';

if (!$link) {
  $error = mysqli_connect_error();
  show_error($content, $error);
} else {
  $sql = 'SELECT alias, title, id FROM categories';
  $result = mysqli_query($link, $sql);
  if ($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    show_error($content, mysqli_error($link));
  }

	$$goods = [];
	mysqli_query($link, 'CREATE FULLTEXT INDEX gif_ft_search ON lots(alias, title)');
	$search = $_GET['q'] ?? '';
	if ($search) {
		$sql = "SELECT  lots.id, name_lot, image, category_id, pricestart FROM lots"
		  . "JOIN users ON lots.author_id = users.id "
		  . "WHERE MATCH(alias, title) AGAINST(?)";

		$stmt = db_get_prepare_stmt($link, $sql, [$search]);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$goods = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
	$page_content = include_template('search.php', ['categories' => $categories,
                                               'goods' => $goods,
                                               'config' => $config]);
}

$content = include_template('layout.php', ['content'=>$page_content,
																					 'categories' => $categories,
																					 'is_auth' => $is_auth,
																					 'user_avatar' => $user_avatar,
																					 'user_name'=> $user_name]);

print($content);

