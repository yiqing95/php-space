<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/19
 * Time: 11:16
 */

// require_once( dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR .'bootstrap.php' ) ;
require_once(__DIR__ . DIRECTORY_SEPARATOR . '../../bootstrap.php');

// NOTE PHP 还能这样玩！！！ 直接包含某个phar
// Point to where you downloaded the phar
// include('./httpful.phar');
?>
<?php
/**
 * @see http://phphttpclient.com/
 * */
if(PHP_SAPI == 'cli' ){
  echo 'execution under cli ' ;
}else{
    echo 'under web env .'.PHP_SAPI;
    /*
    print_r(
        $_SERVER
    );
    */
    $httpHost = $_SERVER['HTTP_HOST'] ;
    $requestUrl = dirname( $_SERVER['REQUEST_URI'] );

    $url =  $httpHost . ''.$requestUrl . '/api.php' ;
   // die($url) ;
}

// Make a request to the GitHub API with a custom
// header of "X-Trvial-Header: Just as a demo".
// $url = "https://api.github.com/users/nategood";

$response = \Httpful\Request::get($url)
    // ->expectsJson()
    ->withXTrivialHeader('Just as a demo')
    ->send();
/*
echo "{$response->body->name} joined GitHub on " .
    date('M jS', strtotime($response->body->created_at)) ."\n";
*/

print_r([
   'body'=> $response->body,
   'raw-body'=>$response->raw_body ,
    ]
) ;


//  TODO  这个用法太搓了 有机会fork下改改 || 通过阅读其README.php 在版本更新历史中找到此hack用法！

// Example overriding the default JSON handler with one that encodes the response as an array
\Httpful\Httpful::register(\Httpful\Mime::JSON, new \Httpful\Handlers\JsonHandler(array('decode_as_array' => true)));

$response = Httpful\Request::post($url,json_encode(['key'=>1]),\Httpful\Mime::JSON)

         ->expects(\Httpful\Mime::JSON)
          ->send();
print_r([
        'body'=> $response->body,
        'raw-body'=>$response->raw_body ,
    ]
) ;