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
      $pro_name = $_POST['name'];
      $pro_price = $_POST['price'];
      $pro_picture_name_old = $_POST['picture_name_old'];
      $pro_picture_name = $_POST['picture_name'];

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
