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
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $pro_name=$post['name'];
    $pro_price=$post['price'];
    $pro_picture=$_FILES['picture'];

    if($pro_name==''){
      print '商品名が入力されてません。<br />' ;
      print '<br />';
    }
    else {
      print '商品名： </n>';
      print $pro_name;
      print '<br />';
      print '<br />';
    }
    if(preg_match('/^[0-9]+$/',$pro_price)==0){
      print '正しい価格を入力してください。';
    }
    else{
      print '価格：';
      print $pro_price;
      print '円 <br />';
    }
    if($pro_picture['size']>0){
      if($pro_picture['size']>1000000){
        print '画像が大きすぎます。';
      }
      else{
        move_uploaded_file($pro_picture['tmp_name'],'./picture/'.$pro_picture['name']);
        print '<img src="./picture/'.$pro_picture['name'].'">';
        print '<br />';
      }
    }
    if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0 || $pro_picture['size']>1000000){
      print '<form>';
      print '<input type="button" onclick="history.back()" value="戻る" />';
      print '</form>';
    }
    else {
      print '上記の商品を追加します。<br />';
      print '<form method="post" action="pro_add_done.php">';
      print '<input type="hidden" name="name" value="'.$pro_name.'" />';
      print '<input type="hidden" name="price" value="'.$pro_price.'" />';
      print '<input type="hidden" name="picture_name" value="'.$pro_picture['name'].'" />';
      print '<br />';
      print '<input type="button" onclick="history.back()" value="戻る" />';
      print '<input type="submit" value="OK" />';
      print '</form>';
    }
  ?>
</body>
</html>
