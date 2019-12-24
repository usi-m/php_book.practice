<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['member_login'])==false){
    print 'ようこそゲスト様';
    print '<a href = "member_login.html">会員ログイン</a><br />';
    print '<br />';
  }
  else{
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様 <br />';
    print '<a href = "member.logout.php">ログアウト</a><br />';
    print '<br />';
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
    try{
      if(isset($_SESSION['cart'])==true){
        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
        $max = count($cart);
      }
      else{
        $max = 0;
      }

      if($max == 0){
        print 'カートに商品がありません。';
        print '<br />';
        print '<a href = "shop_list.php">商品一覧に戻る</a>';
        exit();
      }
      $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
      $user ='root';
      $dbh = new PDO($dsn, $user);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      foreach ($cart as $key => $value) {
        $sql = 'SELECT code,name,price,picture FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0]=$value;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $pro_name[]=$rec['name'];
        $pro_price[]=$rec['price'];
        if($rec['picture']==''){
          $pro_picture[] = '';
        }
        else{
          $pro_picture[]='<img src="../product/picture/'.$rec['picture'].'">';
        }
      }
      $dbh = null;
    }
    catch (Exception $e){
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>
  カートの中身 <br />
  <br />
  <form method="post" action="kazu_change.php">
    <table border="1">
      <tr>
        <td>商品</td>
        <td>商品画像</td>
        <td>価格</td>
        <td>数量</td>
        <td>小計</td>
        <td>削除</td>
      </tr>
      <?php
      for($i=0; $i<$max; $i++){
      ?>
      <tr>
        <td> <?php     print $pro_name[$i]; ?></td>
        <td> <?php     print $pro_picture[$i]; ?></td>
        <td>価格：<?php print $pro_price[$i]; ?>円</td>
        <td>数量：<input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
        <td>合計金額：<?php print $pro_price[$i] * $kazu[$i]; ?>円</td>
        <td>削除：<input type="checkbox" name="delete<?php print $i; ?>"></td>
      </tr>
      <?php } ?>
    </table>
    <input type="hidden" name="max" value="<?php print $max; ?>">
    <input type="submit" value="数量変更">&nbsp;
    <a href="clear_cart.php">カートを空にする</a><br />
    <a href ="shop_list.php">商品一覧に戻る</a>
  </form>
  <br />
  <a href="shop_form.html">ご購入手続きへ進む</a><br />
</body>
</html>
