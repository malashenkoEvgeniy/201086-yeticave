<?php
require_once 'data.php';
require_once 'config/config.php';
require_once 'functions/functions.php';
$page_content = include_template('index.php', ['category' => $category, 'goods'=>$goods]);
$content = include_template('layout.php',
  ['content'=>$page_content, 'category' => $category, 'is_auth' => $is_auth,
    'user_avatar'=>$user_avatar, 'user_name'=> $user_name]);
print($content);
