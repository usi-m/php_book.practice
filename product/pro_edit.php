<?php
  session_start();
  session_regenerate_id(true);
  if(isset($_SESSION['login'])==false){
    print 'ログインされておりません。';
    print '<a href = "../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
  }
  else{
    print $_SESSION['staff_name'];
    print 'さんログイン中 <br />';
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
      $pro_picture_name_old = $rec['picture'];

      $dbh = null;

      if($pro_picture_name_old==''){
        $disp_picture ='';
      }
      else{
        $disp_picture='<img src="./picture/'.$pro_picture_name_old.'">';
      }
    }
    catch (Exception $e){
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>
  商品の修正 <br />
  <br />
  商品コード<br />
  <?php print $pro_code; ?>
  <br />
  <br />
  <form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
    <input type="hidden" name="code" value="<?php print $pro_code; ?>">
    <input type="hidden" name="picture_name_old" value="<?php print $pro_picture_name_old ?>"><br />

    商品名 <br />
    <input type="text" name="name" style="width:200px" value="<?php print $pro_name; ?>"><br />
    価格<br />
    <input type="text" name="price" style="width:50px" value="<?php print $pro_price; ?>" /><br />
    <br />
    <?php print $disp_picture ?>
    <br />
    <input type="file" name="picture" style="width:400px"><br />
    <br />
    <input type="button" onclick="history.back()" value="戻る" />
    <input type="submit" value="OK" />
  </form>

</body>
</html>
