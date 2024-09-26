<?php

$day = "Cumartesi";

    switch($day){
        case "Pazartesi":
            echo "Bugün Pazartesi"
            break;
    default:
    echo "Bugün haftasonu";
            break;
    }
$age =20;
 $result = ($age >=18 ) ? "Yetişkin" : "Çocuk";
 echo $result;

 $username = $_GET['user'] ?? "Misafir";
 echo "Merhaba, $username"

 function carpma($a,$b){
    return $a*$b;
 }
$sonuc = carpma(4,5);
echo $sonuc;

function toplamaHepsi(){
    $toplam =0;
    foreach(func_get_args() as $sayi){
        $toplam +=$sayi;
    }
    return $toplam;

}

echo toplamaHepsi(1,2,3,4,5);


?>