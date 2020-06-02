<?php
require_once '../conf/const.php';
require_once '../model/functions.php';
require_once '../model/user.php';
require_once '../model/item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$items = get_open_items($db);

// ページ数を取得(初期値1)
$page = get_get('page');
if ($page === ''){
  $page = 1;
}
// 商品数
$items_count = count($items);
// ページ数
$page_count = (int)ceil($items_count / 8);
// ページ毎に商品を取得
$items_page = get_items_page($db, $page);

// 件数表示
// 1ページ目 && 最後のページではない
if ((int)$page === 1 && $page_count !== (int)$page){
  $item_first = 1;
  $item_last = 8; 
// 1ページ目ではない && 最後のページではない
}else if ((int)$page !== 1 && $page_count !== (int)$page){
  $item_first = ($page - 1) * 8 + 1;
  $item_last = $item_first + 7; 
// 1ページ目が最後のページ
}else if ((int)$page === 1 && $page_count === (int)$page){
  $item_first = 1;
  $item_last = $items_count;
  // 1ページ目以外が最後のページ
}else if ((int)$page !== 1 && $page_count === (int)$page){
  $item_first = ($page - 1) * 8 + 1;
  $item_last = $items_count;
}
  
include_once VIEW_PATH . 'index_view.php';