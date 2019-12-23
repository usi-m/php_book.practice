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
    try {
      $pro_code = $_POST['code'];
      $pro_picture_name = $_POST['picture_name'];

      $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $dbh = new PDO($dsn,$user);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql =  'DELETE FROM mst_product WHERE code=?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $pro_code;
      $stmt -> execute($data);

      $dbh = null;

      if ($pro_picture_name !=''){
        unlink('./picture/'.$pro_picture_name);
      }
    }
    catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>

  削除しました。<br />
  <br />
  <a href = "pro_list.php"> 戻る </a>

</body>
</html>
