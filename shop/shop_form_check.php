<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
    require_once('../common/common.php');

    $post=sanitize($_POST);

    $name=$post['name'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];
    $okflg=true;

    if($name==''){
      print 'お名前が入ってません。<br /><br />';
      $okflg=false;
    }
    else{
      print 'お名前<br />';
      print $name;
      print '<br /><br />';
    }
    if(preg_match('/^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/',$email)==0){
      print 'メールアドレスを正確に入力してください。<br /><br />';
      $okflg=false;
    }
    else{
      print 'メールアドレス<br />';
      print $email;
      print '<br /><br />';
    }
    if(preg_match('/^[0-9]+$/',$postal1)==0){
      print '郵便番号は半角で入力してください。<br /><br />';
      $okflg=false;
    }
    if(preg_match('/^[0-9]+$/',$postal2)==0){
      print '郵便番号は半角で入力してください。<br /><br />';
      $okflg=false;
    }
    else{
      print '郵便番号<br />';
      print $postal1;
      print '-';
      print $postal2;
      print '<br /><br />';
    }
    if($address==''){
      print '住所が入力されておりません。<br /><br />';
      $okflg=false;
    }
    else{
      print '住所<br />';
      print $address;
      print '<br /><br />';
    }
    if(preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',$tel)==0){
      print '電話番号を正確に入力してください。<br /><br />';
      $okflg=false;
    }
    else {
      print '電話番号<br />' ;
      print $tel;
      print '<br /><br />';
    }
    if($okflg==true){
      print '<form method="post" action="shop_form_done.php">';
      print '<input type="hidden" name="name" value="'.$name.'">';
      print '<input type="hidden" name="email" value="'.$email.'">';
      print '<input type="hidden" name="postal1" value="'.$postal1.'">';
      print '<input type="hidden" name="postal2" value="'.$postal2.'">';
      print '<input type="hidden" name="address" value="'.$address.'">';
      print '<input type="hidden" name="tel" value="'.$tel.'">';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '<input type="submit" value="OK">';
      print '</form>';
    }
    else{
      print '<form>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '</form>';
    }
  ?>
</body>
</html>
