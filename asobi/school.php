<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>ろくまる農園</title>
</head>
<body>
  <?php
    $school = $_POST['school'];

    switch ($school) {
      case '1':
        $building = 'あなたの校舎は南校舎です。';
        break;
      case '2':
        $building = 'あなたの校舎は西校舎です。';
        break;
      case '3':
        $building =  'あなたの校舎は東校舎です。';
        break;
      default:
        $building = 'あなたの校舎は3年生と同じです。';
    }
    print '校舎 ' .$building.'<br />';
  ?>
</body>
</html>
