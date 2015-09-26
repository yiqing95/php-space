<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/17
 * Time: 22:53
 */

// 建设银行测试
?>
<?php

define('DS',DIRECTORY_SEPARATOR) ;
/**
 * get the php-space dir path
 *
 * @return string
 */
function getRootSpaceDir()
{
    $phpSpaceRootDir = substr(__DIR__,0,strpos(__DIR__,'php-space')).'php-space';
    return $phpSpaceRootDir ;
}
$phpSecLibDir = getRootSpaceDir() .DS . 'php-libs'.DS. 'phpseclib1.0.0' ;

set_include_path(get_include_path() . PATH_SEPARATOR . $phpSecLibDir);


require getRootSpaceDir().DS. 'class-loaders/MyAutoLoader.php';
// MyAutoLoader::loadFromDir(array(''));
MyAutoLoader::supportZendClass() ;


$strPubKey ="30819d300d06092a864886f70d010101050003818b00308187028181009ba4951169c5deecf03a8ddb2fd934f53747c03a211f63bccc84773182bdd8f7159634705041087e4c9053df05326952a143e1aab5e8ba75ed891a91c2db484b66a064abba6605418944d8763814ff23c161101948ec9ef2dfac735b4bb7c7dac18fbf87157b424780eb7080a3e7c9e79dd4841e44a001edfe497b9e3d2181b9020111";
$strPriKey="30820277020100300d06092a864886f70d0101010500048202613082025d020100028181009ba4951169c5deecf03a8ddb2fd934f53747c03a211f63bccc84773182bdd8f7159634705041087e4c9053df05326952a143e1aab5e8ba75ed891a91c2db484b66a064abba6605418944d8763814ff23c161101948ec9ef2dfac735b4bb7c7dac18fbf87157b424780eb7080a3e7c9e79dd4841e44a001edfe497b9e3d2181b9020111028181008954fc004e452e1c5b7ef5a348563dc94ee4f4e7ff1bb25b4b0b783abea783345e575b7228b1da51529d772e31c311a342ffa90009eb7758fec4449ebafdb84126d1d2443dbcec07d9807638ef32cb91bf18eaaa46f6db84de5eba05edfe70ad029449a4cb4de7a95f5c903d6a3fa301f1cc0fe3e29ac72eeab68737f3b2f57d024100d428be0e1463c6b25cc493f23777135a9251b8092f3439c9604d61df8aadb958b947222fd60a489e5de44c379e806015edb0b15030a22cbc5e0ff693fd5bedcf024100bbce1eb6b55f5530f1bb7a437a0f0512f0153d0ada5c5b4ea57c3ea83bd89fe0166d5af1d07f153e83c05eae1585b113c03c8d989bb4d151c96aa78691fac1f7024100bb33020c6c5809ac6ff8bec6a9691113ae481adaed6a511b18bcbfc53e20d0b7b28a0f1b26454f2252d87f7c5ead81f53b236f46c180095ae9959d556714e0e3024100b0c1feca141d7d5b3ddda03f81f004c6879b84beeba237d18cb12be9a1bcd2b4c9d055984bc2e6d16cf14a0d416ec4c74b8449081a1397d48155526089647a51024100bcfe9b05b25578d5d96f80229e015aa58a0af5b0c0aa3ad695fe0d270c4818a737a7abc2f59cf1ea22c7155e06b7d26fba2594e29cb7fd02bd9b6e24b49e425a";
$strSrc="POSID=000000000&BRANCHID=110000000&ORDERID=19991101234&PAYMENT=500.00&CURCODE=01&REMARK1=19991101&REMARK2=北京商户&SUCCESS=Y&ACC_TYPE=11";

$rsa = new Crypt_RSA();
//$rsa->setPassword('password');
// TODO 这里签名错误！！！
$rsa->loadKey($strPubKey); // private key

$plaintext = '' ;// $strSrc;

$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$rsa->setHash('md5');
$signature = $rsa->sign($plaintext);

print_r([
   $strPubKey,
    $strPriKey,
    $strSrc,
]);
echo bin2hex($signature);
