<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/26
 * Time: 11:16
 */
require_once(__DIR__ . DIRECTORY_SEPARATOR . str_repeat('../', 3) . 'bootstrap.php');

/**
 * +  --------------------------------------------------------------------------------------  +
 *                          ## 注册名空间前缀 查找路径
 *
 */
$classLoader = new \Symfony\Component\ClassLoader\ClassLoader();

// register classes with namespaces
// $loader->addPrefix('Symfony\Component', __DIR__.'/component');
//     $loader->addPrefix('Symfony',           __DIR__.'/framework');
$classLoader->addPrefix('Acme', __DIR__ . '/acme');

// activate the autoloader
$classLoader->register();

// to enable searching the include path (e.g. for PEAR packages)
$classLoader->setUseIncludePath(true);

/**
 * +  --------------------------------------------------------------------------------------  +
 */

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

$encoders = array(new XmlEncoder(), new JsonEncoder());
$normalizers = array(new ObjectNormalizer());

$serializer = new Serializer($normalizers, $encoders);

$person = new Acme\Person();
$person->setName('foo');
$person->setAge(99);
$person->setSportsman(false);

$jsonContent = $serializer->serialize($person, 'json');

// $jsonContent contains {"name":"foo","age":99,"sportsman":false}

echo $jsonContent; // or return it in a Response

// 反序列化
$data = <<<EOF
<person>
    <name>foo</name>
    <age>99</age>
    <sportsman>false</sportsman>
</person>
EOF;

$person = $serializer->deserialize($data, 'Acme\Person', 'xml');
var_dump($person) ;

// 更新对象

$person = new Acme\Person();
$person->setName('bar');
$person->setAge(99);
$person->setSportsman(true);

$data = <<<EOF
<person>
    <name>foo</name>
    <age>69</age>
</person>
EOF;

$serializer->deserialize($data, 'Acme\Person', 'xml', array('object_to_populate' => $person));
// $obj2 = Acme\Person(name: 'foo', age: '99', sportsman: true)
var_dump($person) ;