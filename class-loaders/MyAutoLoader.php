<?php

/**
 * Description of MyAutoLoader
 * ---------------------------------
 * ע�ⷽ��class_exists�ᵼ���Զ����ط����ĵ���
 * ������� spl_autoload_register(__CLASS__.'::style1Loader', false);
 * ���һ����������false;
 * ------------------------------------
 * @author  yiqing95
 *
 */
class MyAutoLoader
{

    private static $includeDirArray = '';
    public static $autoloadRegistered = false;

    /**
     * ������Ŀ¼�в�����
     * @param mixed $dirs Ŀ¼���� ���ߵ���Ŀ¼ ·������������ڵ�ǰphp�ļ���
     * @param boolean $isZFClass �Ƿ���ZendFramework��� ����� ��Ҫ��
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
            //���Դ��ݵĲ���
        }
        /**
         * ������Ŀ¼��ӵ�includePath��
         */
        self::setIncludePath();

        /**
         * spl_autoload_register ��һ�Ǽӵ��Զ�����ջ�еĺ��� �ζ����Ƿ����쳣
         * ���������һ ��ô����Ĭ�ϵ��Ǹ����غ���spl_autoload()
         */
        spl_autoload_register();
        //spl_autoload_register(null, false); //��� �����ڲ����ܸ�����ĵ�Ч
        spl_autoload_register('spl_autoload', false);
        spl_autoload_extensions('.php,.inc,.class,.interface,.class.php');

        /**
         * �����һ���ű���ͬʱ����__autoload�������� ��ô����������ӵ�spl����ջ����ô���ͱ�������
         * ��������ķ��������׵�
         * spl_autoload_register
         */
        /**
         * ��ջδ��ʼ��ʱ������� ���߻�û��ע�ắ��ʱ
         */
        if (false === spl_autoload_functions()) {
            if (function_exists('__autoload')) {
                spl_autoload_register('__autoload', false);
            }
        }

        spl_autoload_register(__CLASS__ . '::zendStyleAutoLoader', false);
        spl_autoload_register(__CLASS__ . '::style1Loader', false);
        //spl_autoload_register(__CLASS__.'::style2Loader', false);
        //�Ƿ�֧��zend���������
        if ($supportZFClass) {
            //echo "heheh";
            spl_autoload_register(__CLASS__ . '::Style4ZendFrameworkLoader', false);
        }
        // print_r(spl_autoload_functions());
    }

    /**
     * ��ָ����Ŀ¼�в����࣬�������һ��boolֵ��ʾ֧��zend��
     * ����
     */
    public static function loadFrom()
    {
        $args = func_get_args();
        $argNum = func_num_args();
        //echo $argNum;
        // $argCount=func_num_args();
        // $nthArg=func_get_arg(0);
        /*
         * ������
          print_r($args);
          echo "������Ŀ��".$argCount;
          echo "<br>��һ�������ǣ�".$nthArg;
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
                    // echo "֧��zf��";
                }
            }
            self::loadFromDir($includedDirs, $supportZendFramework);
        } else {
            //���Բ���;
            // echo "���Բ���";
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
     * ע��һ��Ҫ����loadFromDir ��Ȼ��������Զ�ע��
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
     * ���ذ�����·��
     * @return string
     */
    public static function getIncludePath()
    {
        return get_include_path();
    }

    /**
     * �����Ѱ������ļ�
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
     * swift �Դ��� spl_autoload_register().
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
     * ZENDFramework���������� �Ȱ�includePath����һ��
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
          //�̵�����
          // throw $e;
          return false;
          } */
    }

    /**
     * ֧��zend����أ�ֻ��Ҫ��zend��Ŀ¼�ӵ�includepath�м���
     * �����������loadFrom��
     */
    public static function supportZendClass()
    {
        spl_autoload_register(__CLASS__ . '::Style4ZendFrameworkLoader', false);
    }

    /**
     * ��ĳ��Ŀ¼�ݹ�չ��ƽ��������ļ�
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
          //����Ч������
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
     * @param string $dir Ŀ¼
     * @param boolean $recursive �Ƿ�ݹ�չ��
     * @return array ���ص�ǰָ��Ŀ¼�µ���Ŀ¼��
     *   ��������˵ڶ���������ô�ݹ鷵�����е���Ŀ¼
     */
    static public function listSubDir($dir, $recursive = false)
    {
        //��Ŀ¼�ж�û������
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
                        //���ݹ�ʱ
                        $rsltList[] = $file;
                    }
                }
            }
        }
        return $rsltList;

        //sort($rsltList);  //����������
        //shuffle($rsltList); //�����������
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


