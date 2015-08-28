<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 9:39
 */
$cmt = <<< CMT
You can easily parse command line arguments into the \$_GET variable by using the parse_str() function.

>
    $ php -f somefile.php a=1 b[]=2 b[]=3
    $ php -f somefile.php a=1 b[]=2 b[]=3

    This will set \$_GET['a'] to '1' and \$_GET['b'] to array('2', '3').

    Even better, instead of putting that line in every file, take advantage of PHP's auto_prepend_file directive.
    Put that line in its own file and set the auto_prepend_file directive in your cli-specific php.ini like so:

    auto_prepend_file = "/etc/php/cli-php5.3/local.prepend.php"

    It will be automatically prepended to any PHP file run from the command line.
CMT;

// echo $cmt , PHP_EOL ;
?>

<?php

parse_str(implode('&',array_slice($argv,1)),$_GET) ;

print_r($_GET) ;
