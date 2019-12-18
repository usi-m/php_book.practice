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
        $disp_picture='<img src="./picture/'.$pro_picture_name.'">';
      }
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
