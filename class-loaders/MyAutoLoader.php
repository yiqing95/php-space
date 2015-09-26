<?php

/**
 * Description of MyAutoLoader
 * ---------------------------------
 * 注意方法class_exists会导致自动加载方法的调用
 * 所以最好 spl_autoload_register(__CLASS__.'::style1Loader', false);
 * 最后一个参数都用false;
 * ------------------------------------
 * @author  yiqing95
 *
 */
class MyAutoLoader
{

    private static $includeDirArray = '';
    public static $autoloadRegistered = false;

    /**
     * 从以下目录中查找类
     * @param mixed $dirs 目录数组 或者单个目录 路径必须是相对于当前php文件的
     * @param boolean $isZFClass 是否是ZendFramework类库 如果是 就要先
     */
    public static function loadFromDir($dirs, $supportZFClass = false)
    {
        if (is_string($dirs) && is_dir($dirs)) {
            self::$includeDirArray = array($dirs);
        } else if (is_array($dirs)) {
            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    throw new InvalidArgumentException("not a dir!");
                }
            }
            self::$includeDirArray = $dirs;
        } else {
            //忽略传递的参数
        }
        /**
         * 将所有目录添加到includePath中
         */
        self::setIncludePath();

        /**
         * spl_autoload_register 参一是加到自动加载栈中的函数 参二是是否抛异常
         * 如果不给参一 那么会用默认的那个加载函数spl_autoload()
         */
        spl_autoload_register();
        //spl_autoload_register(null, false); //这个 估计内部可能跟上面的等效
        spl_autoload_register('spl_autoload', false);
        spl_autoload_extensions('.php,.inc,.class,.interface,.class.php');

        /**
         * 如果在一个脚本中同时存在__autoload函数定义 那么如果不把他加到spl调用栈上那么他就被忽略了
         * 所以下面的方法是稳妥的
         * spl_autoload_register
         */
        /**
         * 在栈未初始化时在做这个 或者还没有注册函数时
         */
        if (false === spl_autoload_functions()) {
            if (function_exists('__autoload')) {
                spl_autoload_register('__autoload', false);
            }
        }

        spl_autoload_register(__CLASS__ . '::zendStyleAutoLoader', false);
        spl_autoload_register(__CLASS__ . '::style1Loader', false);
        //spl_autoload_register(__CLASS__.'::style2Loader', false);
        //是否支持zend风格的类加载
        if ($supportZFClass) {
            //echo "heheh";
            spl_autoload_register(__CLASS__ . '::Style4ZendFrameworkLoader', false);
        }
        // print_r(spl_autoload_functions());
    }

    /**
     * 从指定的目录中查找类，如果传人一个bool值表示支持zend类
     * 加载
     */
    public static function loadFrom()
    {
        $args = func_get_args();
        $argNum = func_num_args();
        //echo $argNum;
        // $argCount=func_num_args();
        // $nthArg=func_get_arg(0);
        /*
         * 测试用
          print_r($args);
          echo "参数数目：".$argCount;
          echo "<br>第一个参数是：".$nthArg;
         *
         */
        $includedDirs = array();
        $supportZendFramework = false;
        if ($argNum > 0) {
            foreach ($args as $arg) {
                if (is_dir($arg)) {
                    $includedDirs[] = $arg;
                }
                if (is_bool($arg)) {
                    $supportZendFramework = true;
                    // echo "支持zf类";
                }
            }
            self::loadFromDir($includedDirs, $supportZendFramework);
        } else {
            //忽略参数;
            // echo "忽略参数";
            throw new Exception('need args!');
        }
        // print_r($includedDirs);
        unset($includedDirs);
    }

    private static function setIncludePath()
    {
        set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, self::$includeDirArray));
    }

    /**
     * 注意一定要调用loadFromDir 不然不会调用自动注册
     * @param <type> $dirs
     * @param <type> $recursiveInclude
     */
    public static function setIncludeDir($dirs, $recursiveInclude = false)
    {
        if (is_string($dirs)) {
            $dirs = explode(',', $dirs);
        }
        if ($recursiveInclude && is_array($dirs)) {
            $allDirs = array();
            foreach ($dirs as $dir) {
                // print_r(self::listSubDir($dir,true));
                $allDirs = array_merge($allDirs, (array)$dir, self::listSubDir($dir, true));
            }
            $dirs = $allDirs;
        }
        // print_r($dirs);
        if (is_array($dirs)) {
            set_include_path(get_include_path() . PATH_SEPARATOR .
                implode(PATH_SEPARATOR, $dirs));
            /*
             *
              foreach($dirs as $dir){
              if(is_dir($dir)){
              set_include_path(get_include_path() . PATH_SEPARATOR .$dir);
              }
              }
             *
             */
        } else {
            echo "<br/>\n the argument is illeagel:<br/>";
            var_dump($dirs);
            throw new Exception('wrong argument for ' . __METHOD__);
        }
    }

    /**
     * 返回包含的路径
     * @return string
     */
    public static function getIncludePath()
    {
        return get_include_path();
    }

    /**
     * 返回已包含的文件
     * @return array
     */
    public static function getIncludeFiles()
    {
        return get_included_files();
    }

    private static function style1Loader($class)
    {
        //echo "hi".__METHOD__;
        // $classFileStyle1 = $class . '.php';
        $classFileStyle2 = 'class.' . $class . '.php';
        include $classFileStyle2;
        /*
        if (file_exists($classFileStyle1)) {
          require_once 'class.' . $class . ".php";
          return true;
        } elseif (file_exists($classFileStyle2)) {
          require_once $class . ".php";
          return true;
        } else {
          return false;
        }*/
    }

    /**
     * swift 自带的 spl_autoload_register().
     *
     * @param string $class
     */
    public static function SwiftAutoload($class)
    {
        //Don't interfere with other autoloaders
        if (0 !== strpos($class, 'Swift')) {
            return false;
        }

        $path = dirname(__FILE__) . '/' . str_replace('_', '/', $class) . '.php';

        if (!file_exists($path)) {
            return false;
        }

        require_once $path;
    }

    public static function zendStyleAutoLoader($class)
    {
        $path = str_replace('_', '/', $class) . '.php';
        include $path;
    }

    private static function style2Loader($class)
    {
        require_once 'inc.' . $class . '.php.class';
    }

    /**
     * ZENDFramework风格的类名， 先把includePath设置一下
     * @param <type> $class
     */
    private static function Style4ZendFrameworkLoader($class)
    {
        $classPath = str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        require_once $classPath;
        /*
          try{

          require_once $classPath;
          return true;
          }catch(Exception $e){
          //吞掉错误
          // throw $e;
          return false;
          } */
    }

    /**
     * 支持zend类加载，只需要把zend根目录加到includepath中即可
     * 或者用上面的loadFrom做
     */
    public static function supportZendClass()
    {
        spl_autoload_register(__CLASS__ . '::Style4ZendFrameworkLoader', false);
    }

    /**
     * 将某个目录递归展成平面的数组文件
     * @param <type> $path
     * @param <type> $ignoreDirs
     * @return <type>
     *  if (substr($uploadDir, -1) != '/')
     *                                 $uploadDir .= '/';
     */
    public static function flatListDir($path, $ignoreDirs = null)
    {
        /*
          echo 'hi0';
          $dirs = array($path);
          $contents = scandir($path);
          foreach ($contents as $filename) {
          //更高效做法：
          if(strpos('.',$filename ) ==0){
          continue;
          }
          $item = "{$path}/{$filename}";
          if (is_dir($item)) {

          if(empty($ignoreDirs)){
          $dirs = array_merge($dirs, self::flatListDir($item,$ignoreDirs));
          }elseif(is_string($ignoreDirs)){
          if($ignoreDirs == $item){
          continue;
          }else{
          $dirs = array_merge($dirs, self::flatListDir($item,$ignoreDirs));
          }
          }elseif(is_array($ignoreDirs)){
          if(in_array($item, $ignoreDirs)){
          continue;
          }else{
          $dirs = array_merge($dirs, self::flatListDir($item,$ignoreDirs));
          }
          }
          }
          }
         *
         */
        //echo ' p:'.$path;
        if (is_dir($path)) {

            $dirs = array($path);
            $contents = scandir($path);
            foreach ($contents as $filename) {
                echo $filename;
                if (strpos('.', $filename) == 0) {
                    continue;
                }
                echo "yyyyye";
                $item = "{$path}/{$filename}";
                if (is_dir($item)) {
                    echo $item . '<br>';
                    $dirs = array_merge($dirs, self::flatListDir($item));
                }
            }
            return $dirs;
        } else {
            throw new Exception("not a dir" . $path);
        }
    }

    /**
     *
     * @param string $dir 目录
     * @param boolean $recursive 是否递归展开
     * @return array 返回当前指定目录下的子目录，
     *   如果设置了第二个参数那么递归返回所有的子目录
     */
    static public function listSubDir($dir, $recursive = false)
    {
        //非目录判断没有做：
        $rsltList = array();
        $files = scandir($dir);
        if ($files) {
            foreach ($files as $filename) {
                if ($filename == '.' || $filename == '..') {
                    continue;
                }
                $file = str_replace('//', '/', $dir . '/' . $filename);
                if (is_dir($file)) {
                    // echo $file;
                    if ($recursive) {
                        //echo "ye";
                        $rsltList[] = $file;
                        $rsltList = array_merge($rsltList, self::listSubDir($file));
                    } else {
                        //不递归时
                        $rsltList[] = $file;
                    }
                }
            }
        }
        return $rsltList;

        //sort($rsltList);  //数字性排序
        //shuffle($rsltList); //随机乱序排列
    }

    /**
     *
     * @param <type> $dir
     * @return <type>
     * foreach (ListFiles('/home/ibbo') as $key=>$file){
     *     echo $file ."<br />";
     * }
     */
    private static function ListFiles($dir)
    {
        if ($dh = opendir($dir)) {
            $files = Array();
            $inner_files = Array();
            while ($file = readdir($dh)) {
                if ($file != "." && $file != ".." && $file[0] != '.') {
                    if (is_dir($dir . "/" . $file)) {
                        $inner_files = ListFiles($dir . "/" . $file);
                        if (is_array($inner_files)) $files = array_merge($files, $inner_files);
                    } else {
                        array_push($files, $dir . "/" . $file);
                    }
                }
            }

            closedir($dh);
            return $files;
        }
    }


}


