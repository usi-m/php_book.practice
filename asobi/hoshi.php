<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
    $mbango = $_POST['mbango'];

    $hoshi['M1']='カニ星雲';
    $hoshi['M31']='アンドロメダ大星雲';
    $hoshi['M42']='オリオン星雲';
    $hoshi['M45']='すばる';
    $hoshi['M57']='ドーナツ大星雲';

    foreach ($hoshi as $key => $value) {
      print $key.'は'.$value;
      print '<br /><br />';
    }
    print 'あなたが選んだ星は';
    print $hoshi[$mbango];

   ?>
</body>
</html>
