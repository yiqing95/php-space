<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/19
 * Time: 14:51
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../',3). 'bootstrap.php');

?>
<?php

$browser = new Buzz\Browser();
$response = $browser->get('http://www.baidu.com');

echo $browser->getLastRequest()."\n";
echo $response;
