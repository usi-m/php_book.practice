<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
    $pro_code=$_POST['code'];
    $pro_name=$_POST['name'];
    $pro_price=$_POST['price'];
    $pro_picture_name_old=$_POST['picture_name_old'];
    $pro_picture =$_FILES['picture'];

    $pro_code=htmlspecialchars($pro_code, ENT_QUOTES,'UTF-8');
    $pro_name=htmlspecialchars($pro_name, ENT_QUOTES,'UTF-8');
    $pro_price=htmlspecialchars($pro_price, ENT_QUOTES,'UTF-8');

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
    if($pro_name=='' || preg_match('/^[0-9]+$/',$pro_price)==0 || $pro_picture['size']>1000000) {
      print '<form>';
      print '<input type="button" onclick="history.back()" value="戻る" />';
      print '</form>';
    }
    else {
      print '上記のように変更します。<br />';
      print '<form method="post" action="pro_edit_done.php">';
      print '<input type="hidden" name="code" value="'.$pro_code.'" />';
      print '<input type="hidden" name="name" value="'.$pro_name.'" />';
      print '<input type="hidden" name="price" value="'.$pro_price.'" />';
      print '<input type="hidden" name="picture_name_old" value="'.$pro_picture_name_old.'">';
      print '<input type="hidden" name="picture_name" value="'.$pro_picture['name'].'">';
      print '<br />';
      print '<input type="button" onclick="history.back()" value="戻る" />';
      print '<input type="submit" value="OK" />';
      print '</form>';
    }
  ?>
</body>
</html>
