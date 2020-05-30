<?php
  // クリックジャッキング対策
  header('X-FRAME-OPTIONS: DENY');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>購入明細</title>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>


  <div class="container">
    <h1>購入明細</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <table class="table table-bordered text-center">
        <thead class="thead-light">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php print h($history['order_id']); ?></td>
            <td><?php print h($history['created']); ?></td>
            <td><?php print h(number_format($total['subtotal'])); ?></td>
          </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
      <thead class="thead-light">
       <tr>
          <th>商品名</th>
          <th>価格</th>
          <th>購入数</th>
          <th>小計</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($detail as $value){ ?>
          <tr>
            <td><?php print h($value['name']); ?></td>
            <td><?php print h(number_format($value['price'])); ?>円</td>
            <td><?php print h($value['amount']); ?>個</td>
            <td><?php print h(number_format($value['price'] * $value['amount'])); ?>円</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>