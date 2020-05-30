<?php 
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//ログイン中のユーザの購入履歴を取得
function history_data($db, $user_id) {
    $sql = "SELECT history.order_id, history.created, SUM(details.price * details.amount) AS total
            FROM history
            JOIN details
            ON history.order_id = details.order_id
            WHERE user_id = ?
            GROUP BY order_id
            ORDER BY created desc
        ";
return fetch_all_query($db, $sql, array($user_id));
}

//adminの場合全ての購入履歴を取得
function get_all_history_data($db) {
    $sql = "SELECT history.order_id, history.created, SUM(details.price * details.amount) AS total
            FROM history
            JOIN details
            ON history.order_id = details.order_id
            GROUP BY order_id
            ORDER BY created desc
        ";
    return fetch_all_query($db, $sql);   
}

//２つのテーブルから必要情報を取得
function get_history_data($db, $order_id) {
    $sql = "SELECT details.created,
                   details.amount,
                   details.price,
                   items.name
            FROM details
            JOIN items
            ON details.item_id = items.item_id
            WHERE order_id = ?
    ";
    return fetch_all_query($db, $sql, array($order_id)); 
}

//購入明細のorder_idごとの合計金額
function sum_total($db, $order_id) {
  $sql = "SELECT SUM(price * amount) AS subtotal
            FROM details
            WHERE order_id = ?
        ";
return fetch_query($db, $sql, array($order_id));   
}   