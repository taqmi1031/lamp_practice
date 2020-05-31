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
    <h1>購入履歴</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <?php if(!empty($history)){ ?>
      <table class="table table-bordered table-striped">
        <thead class="thead-dark">
          <tr>
            <th>注文番号</th>
            <th>購入日時</th>
            <th>合計金額</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($history as $data){ ?>
            <tr>
              <td><?php print h($data['order_id']); ?></td>
              <td><?php print h($data['created']); ?></td>
              <td><?php print h(number_format($data['total'])); ?>円</td>
              <td>
                <form method="post" action="order_details.php">
                  <input type="submit" value="購入明細表示">
                  <input type="hidden" name="order_id" value="<?php print h($data['order_id']); ?>">
                  <input type="hidden" name="csrf_token" value="<?php print $token; ?>">  
                </form>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php }else{ ?>
      <p>購入履歴がありません</p>
    <?php } ?>
  </div>
</body>
</html>