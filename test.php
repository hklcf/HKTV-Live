<?php
$json = 'https://www.hktvmall.com/ott/token';
$result = json_decode(file_get_contents($json, true));

foreach($result as $value) {
    echo $value['token'] . " ";
    echo $value['expiry_date'] . '<br>';
}
//var_dump($result);
?>
