<?php
  session_start();
  session_regenerate_id(true);

  if(isset($_SESSION['member_login'])==false){
    print 'ログインされてません。';
    print '<a href = "shop_list.php">商品一覧へ</a>';
    exit();
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
    try{
      require_once('../common/common.php');

      $post = sanitize($_POST);

      $customer_name=$post['customer_name'];
      $email=$post['email'];
      $postal1=$post['postal1'];
      $postal2=$post['postal2'];
      $address=$post['address'];
      $tel=$post['tel'];

      print $customer_name.'様<br />';
      print 'ご購入ありがとうございました！！<br /><br />';
      print $email.'にメールをお送りしましたのでご確認ください。<br />';
      print '商品は以下の住所に発送させていただきます。<br />';
      print $postal1.'-'.$postal2.'<br />';
      print $address.'<br />';
      print $tel.'<br />';

      $honbun='';
      $honbun.=$customer_name."様 \n\n この度はご注文ありがとうございました。\n";
      $honbun.="ご注文商品 \n";
      $honbun.="---------------\n";

      $cart=$_SESSION['cart'];
      $kazu=$_SESSION['kazu'];
      $max=count($cart);

      $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
      $user = 'root';
      $password = '';
      $dbh = new PDO($dsn,$user,$password);
      $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      for($i=0; $i < $max; $i++){
        $sql = 'SELECT name, price FROM mst_product WHERE code=?';
        $stmt = $dbh ->prepare($sql);
        $data[0] = $cart[$i];
        $stmt -> execute($data);

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

        $name = $rec['name'];
        $price = $rec['price'];
        $kakaku[] = $price;
        $quantity = $kazu[$i];
        $subtotal = $price * $quantity;

        $honbun.=$name.' ';
        $honbun.=$price.'円 x';
        $honbun.=$quantity.'個 = ';
        $honbun.=$subtotal."円 \n";
      }
      $sql = 'LOCK TABLES dat_sales WRITE, dat_sales_product WRITE, dat_member WRITE';
      $stmt = $dbh->prepare($sql);
      $stmt -> execute();

      $lastmembercode=$_SESSION['member_code'];

      $sql = 'INSERT INTO dat_sales (code_member,name,email,postal1,postal2,address,tel) VALUES (?,?,?,?,?,?,?)';
      $stmt = $dbh->prepare($sql);
      $data = array();
      $data[] = $lastmembercode;
      $data[] = $customer_name;
      $data[] = $email;
      $data[] = $postal1;
      $data[] = $postal2;
      $data[] = $address;
      $data[] = $tel;
      $stmt -> execute($data);

      $sql = 'SELECT LAST_INSERT_ID()';
      $stmt = $dbh->prepare($sql);
      $stmt -> execute();
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $lastcode = $rec['LAST_INSERT_ID()'];

      for($i=0; $i<$max; $i++){
        $sql = 'INSERT INTO dat_sales_product(code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $lastcode;
        $data[] = $cart[$i];
        $data[] = $kakaku[$i];
        $data[] = $kazu[$i];
        $stmt -> execute($data);
      }
      $sql = 'UNROCK TABLES';
      $stmt = $dbh->prepare($sql);
      $stmt -> execute();

      $dbh = null;

      print '<br />';
      print '<a href = "shop_list.php">商品画面へ</a>';

      // $honbun.="送料は無料です。\n";
      // $honbun.="--------------\n";
      // $honbun.="\n";
      // if($order=='registration'){
      //   print "会員登録完了しました。\n";
      //   print "次回からメールアドレスとパスワードでログインしてください。";
      //   print "ご注文が簡単にできるようになります。\n";
      //   print "\n";
      // }
      //
      // $honbun.="代金は以下の口座に振り込んでください。\n";
      // $honbun.="ろくまる銀行 野菜支店 普通口座 1234567 \n";
      // $honbun.="入金確認が取れ次第、発送させていただきます。\n";
      // $honbun.="\n";
      // $honbun.="□□□□□□□□□□□□□□□□□□□ \n";
      // $honbun.="～安心野菜のろくまる農園～\n";
      // $honbun.="\n";
      // $honbun.="岐阜県六丸郡六丸町 124-4\n";
      // $honbun.="電話 123-4567-8990\n";
      // $honbun.="メール info@rokumarunouen.jp\n";
      // $honbun.="□□□□□□□□□□□□□□□□□□□□□□□\n";
      // print '<br />';
      // print nl2br($honbun);
      //
      // $title = 'ご注文ありがとうございます。';
      // $header = 'From:info@rokumarunouen.jp';
      // $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
      // mb_language('Japanese');
      // mb_internal_encoding('UTF-8');
      // mb_send_mail($email,$title,$honbun,$header);
      //
      // $title = 'お客様からご注文がありました。';
      // $header = 'From:'.$email;
      // $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
      // mb_language('Japanese');
      // mb_internal_encoding('UTF-8');
      // mb_send_mail('info@rokumarunouen.jp',$title,$honbun,$header);

    }
    catch(Exception $e){
      print '障害によりご迷惑をお掛けしております。';
      exit();
    }
  ?>

</body>
</html>
