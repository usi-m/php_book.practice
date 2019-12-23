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
      require_once('../common/common.php');

      $post = sanitize($_POST);
      $pro_name = $post['name'];
      $pro_price = $post['price'];
      $pro_picture_name = $post['picture_name'];

      $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $dbh = new PDO($dsn,$user);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql =  'INSERT INTO mst_product(name,price,picture) VALUES (?,?,?)';
      $stmt = $dbh -> prepare($sql);
      $data[] = $pro_name;
      $data[] = $pro_price;
      $data[] = $pro_picture_name;
      $stmt -> execute($data);

      $dbh = null;

      print $pro_name;
      print 'を追加しました。<br />';
    }
    catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>

   <a href = "pro_list.php"> 戻る </a>
</body>
</html>
