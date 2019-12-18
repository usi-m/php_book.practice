<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  商品の追加 <br />
  <br />
  <form method="post" action="pro_add_check.php" enctype="multipart/form-data" />
    ・商品名を入力してください<br />
    <input type="text" name="name" style="width:200px" /><br />
    <br />
    ・価格を入力してください<br />
    <input type="text" name="price" style="width:50px" /><br />
    <br />
    ・画像を選んでください<br />
    <input type="file" name="picture" style="width:400px"><br />
    <br />
    <br />
    <input type="button" onclick="history.back()" value="戻る" />
    <input type="submit" value="OK" />
  </form>
</body>
</html>
