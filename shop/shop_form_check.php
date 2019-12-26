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

    $customer_name=$post['customer_name'];
    $email=$post['email'];
    $postal1=$post['postal1'];
    $postal2=$post['postal2'];
    $address=$post['address'];
    $tel=$post['tel'];
    $order=$post['order'];
    $pass=$post['pass'];
    $pass2=$post['pass2'];
    $gender=$post['gender'];
    $birth=$post['birth'];
    $okflg=true;

    if($customer_name==''){
      print 'お名前が入ってません。<br /><br />';
      $okflg=false;
    }
    else{
      print 'お名前<br />';
      print $customer_name;
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
    if($order=='registration'){
      if($pass==''){
        print 'パスワードが入力されてません。<br /><br />';
        $okflg=false;
      }
      if($pass!=$pass2){
        print 'パスワードが一致しません。<br /><br />';
        $okflg=false;
      }
      print '性別<br />';
      if ($gender=='men'){
        print '男性';
      }
      else {
        print '女性';
      }
      print '<br /><br />';

      print '生まれ年<br />';
      print $birth;
      print '年代';
      print '<br /><br />';
    }
    if($okflg==true){
      print '<form method="post" action="shop_form_done.php">';
      print '<input type="hidden" name="customer_name" value="'.$customer_name.'">';
      print '<input type="hidden" name="email" value="'.$email.'">';
      print '<input type="hidden" name="postal1" value="'.$postal1.'">';
      print '<input type="hidden" name="postal2" value="'.$postal2.'">';
      print '<input type="hidden" name="address" value="'.$address.'">';
      print '<input type="hidden" name="tel" value="'.$tel.'">';
      print '<input type="hidden" name="order" value="'.$order.'">';
      print '<input type="hidden" name="pass" value="'.$pass.'">';
      print '<input type="hidden" name="gender" value="'.$gender.'">';
      print '<input type="hidden" name="birth" value="'.$birth.'">';
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
