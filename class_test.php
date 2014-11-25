<?php
require('browser.class.php');

$browser = new Browser();
$browser->get('http://google.com');
print_r($browser->response_cookies);
?>
