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
      $pro_code = $post['code'];
      $pro_name = $post['name'];
      $pro_price = $post['price'];
      $pro_picture_name_old = $post['picture_name_old'];
      $pro_picture_name = $post['picture_name'];

      $pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');
      $pro_name=htmlspecialchars($pro_name, ENT_QUOTES,'UTF-8');
      $pro_price=htmlspecialchars($pro_price, ENT_QUOTES,'UTF-8');

      $dsn ='mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $dbh = new PDO($dsn,$user);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $sql =  'UPDATE mst_product SET name=?,price=?,picture=? WHERE code=?';
      $stmt = $dbh -> prepare($sql);
      $data[] = $pro_name;
      $data[] = $pro_price;
      $data[] = $pro_picture_name;
      $data[] = $pro_code;
      $stmt -> execute($data);

      $dbh = null;

      if($pro_picture_name_old != $pro_picture_name){
        if($pro_picture_name_old !=''){
          unlink('./picture/'.$pro_picture_name_old);
        }
      }
      print '変更しました。<br />';
    }
    catch (Exception $e) {
      print 'ただいま障害により大変ご迷惑をお掛けしております。';
      exit();
    }
  ?>

  <a href = "pro_list.php"> 戻る </a>

</body>
</html>
