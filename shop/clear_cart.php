<?php
  session_start();
  $_SESSION=array();
  if(isset($_COOKIE[session_name()])==true){
    setcookie(session_name(),'',time()-42000,'/');
  }
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  カートを空にしました。<br /><br />
  <a href="shop_list.php">商品一覧に戻る</a>
</body>
</html>
