<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/17
 * Time: 21:36
 */
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

// include('Net/SSH2.php');

// $secHandler = new Net_SSH1() ;
// include('Crypt/RSA.php');

$rsa = new Crypt_RSA();
//$rsa->setPassword('password');
$rsa->loadKey('-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCqGKukO1De7zhZj6+H0qtjTkVxwTCpvKe4eCZ0FPqri0cb2JZfXJ/DgYSF6vUp
wmJG8wVQZKjeGcjDOL5UlsuusFncCzWBQ7RKNUSesmQRMSGkVb1/3j+skZ6UtW+5u09lHNsj6tQ5
1s1SPrCBkedbNf0Tp0GbMJDyR4e9T04ZZwIDAQABAoGAFijko56+qGyN8M0RVyaRAXz++xTqHBLh
3tx4VgMtrQ+WEgCjhoTwo23KMBAuJGSYnRmoBZM3lMfTKevIkAidPExvYCdm5dYq3XToLkkLv5L2
pIIVOFMDG+KESnAFV7l2c+cnzRMW0+b6f8mR1CJzZuxVLL6Q02fvLi55/mbSYxECQQDeAw6fiIQX
GukBI4eMZZt4nscy2o12KyYner3VpoeE+Np2q+Z3pvAMd/aNzQ/W9WaI+NRfcxUJrmfPwIGm63il
AkEAxCL5HQb2bQr4ByorcMWm/hEP2MZzROV73yF41hPsRC9m66KrheO9HPTJuo3/9s5p+sqGxOlF
L0NDt4SkosjgGwJAFklyR1uZ/wPJjj611cdBcztlPdqoxssQGnh85BzCj/u3WqBpE2vjvyyvyI5k
X6zk7S0ljKtt2jny2+00VsBerQJBAJGC1Mg5Oydo5NwD6BiROrPxGo2bpTbu/fhrT8ebHkTz2epl
U9VQQSQzY1oZMVX8i1m5WUTLPz2yLJIBQVdXqhMCQBGoiuSoSjafUhV7i1cEGpb88h5NBYZzWXGZ
37sJ5QsW+sJyoNde3xH8vdXhzU7eT82D6X/scw9RZz+/6rCJ4p0=
-----END RSA PRIVATE KEY-----'); // private key

$plaintext = '...';

$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$rsa->setHash('md5');
$signature = $rsa->sign($plaintext);

echo bin2hex($signature);
