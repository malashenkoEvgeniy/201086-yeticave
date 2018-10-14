<?php

session_start();

if (!empty($_SESSION['user'])) {
	$is_auth = 1;
  $user_bets = [];
	$user_name = $_SESSION['user']['name_user'];
	$user_avatar = $_SESSION['user']['avatar'];
  $user_id = $_SESSION['user']['id'];
} else {
	$is_auth = 0;
}

