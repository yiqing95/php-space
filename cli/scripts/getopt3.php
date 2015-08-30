<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/8/28
 * Time: 22:41
 */
/**
 * 高级例子 可以让脚步同时运行于命令行和web环境
 */
?>
<?php
/**
 * Get options from the command line or web request
 *
 * @param string $options
 * @param array $longopts
 * @return array
 */
function getoptreq ($options, $longopts)
{
    if (PHP_SAPI === 'cli' || empty($_SERVER['REMOTE_ADDR']))  // command line
    {
        return getopt($options, $longopts);
    }
    else if (isset($_REQUEST))  // web script
    {
        $found = array();

        $shortopts = preg_split('@([a-z0-9][:]{0,2})@i', $options, 0, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
        $opts = array_merge($shortopts, $longopts);

        foreach ($opts as $opt)
        {
            if (substr($opt, -2) === '::')  // optional
            {
                $key = substr($opt, 0, -2);

                if (isset($_REQUEST[$key]) && !empty($_REQUEST[$key]))
                    $found[$key] = $_REQUEST[$key];
                else if (isset($_REQUEST[$key]))
                    $found[$key] = false;
            }
            else if (substr($opt, -1) === ':')  // required value
            {
                $key = substr($opt, 0, -1);

                if (isset($_REQUEST[$key]) && !empty($_REQUEST[$key]))
                    $found[$key] = $_REQUEST[$key];
            }
            else if (ctype_alnum($opt))  // no value
            {
                if (isset($_REQUEST[$opt]))
                    $found[$opt] = false;
            }
        }

        return $found;
    }

    return false;
}
?>


<?php
// php script.php -a -c=XXX -e=YYY -f --two --four=ZZZ --five=5
// script.php?a&c=XXX&e=YYY&f&two&four=ZZZ&five=5

$opts = getoptreq('abc:d:e::f::', array('one', 'two', 'three:', 'four:', 'five::'));

var_dump($opts);
