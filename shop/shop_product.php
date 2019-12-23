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
      $pro_code =$_GET['procode'];

      $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
      $user ='root';
      $dbh = new PDO($dsn, $user);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql ='SELECT name,price,picture FROM mst_product WHERE code=?';
      $stmt =$dbh ->prepare($sql);
      $data[] = $pro_code;
      $stmt -> execute($data);

      $rec =$stmt -> fetch(PDO::FETCH_ASSOC);
      $pro_name = $rec['name'];
      $pro_price = $rec['price'];
      $pro_picture_name = $rec['picture'];

      $dbh = null;

      if($pro_picture_name==''){
        $disp_picture ='';
      }
      else{
        $disp_picture='<img src="../product/picture/'.$pro_picture_name.'">';
      }
      print '<a href = "shop_cartin.php?procode='.$pro_code.'">カートに入れる</a><br /><br />';
    }
    catch (Exception $e){
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>
  商品情報詳細 <br />
  <br />
  商品コード<br />
  <?php print $pro_code; ?><br />
  <br />
  商品名 <br />
  <?php print $pro_name; ?><br />
  <br />
  価格<br />
  <?php print $pro_price; ?>円<br />
  <?php print $disp_picture; ?>
  <br />
  <br />
  <input type="button" onclick="history.back()" value="戻る" />

</body>
</html>
