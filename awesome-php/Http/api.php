<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/19
 * Time: 14:00
 */

echo json_encode(
    [
     'request' => $_REQUEST,
        'api_file' => __FILE__,
        'raw_post'=>$HTTP_RAW_POST_DATA,
        'php-input' => file_get_contents('php://input') ,
    ]


) ;