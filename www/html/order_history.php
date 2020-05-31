<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';
require_once MODEL_PATH . 'history.php';


session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$token = get_csrf_token();

// ユーザ毎の購入履歴
$history = history_data($db, $user['user_id']);

// 管理者の場合、全てのデータ取得
if ($user['type'] === USER_TYPE_ADMIN){
  $history = get_all_history_data($db);
}

include_once '../view/order_history_view.php'; 