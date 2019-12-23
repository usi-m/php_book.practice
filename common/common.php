<?php
  function sanitize($before){
    foreach($before as $key => $value){
      $after[$key] = htmlspecialchars($value, ENT_QUOTES,'UTF-8');
    }
    return $after;
  }

  function gengo($seireki){
    if(1868<=$seireki && $seireki<=1911){
      $gengo = '明治';
    }
    else if(1912<$seireki && $seireki<=1925){
      $gengo = '大正';
    }
    else if(1926<=$seireki && $seireki<= 1988){
      $gengo = '昭和';
    }
    else{
      $gengo = '平成';

    }
    return($gengo);
  }
?>
