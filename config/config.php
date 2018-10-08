<?php
$config = [
  'sitename' => 'Yeticave',
  'image_path' => 'img/',
  'enable' => true,
  'link' => mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link))
];
