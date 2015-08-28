php 基本命令行程序练习
============

参考：[http://php.net/manual/zh/features.commandline.php](http://php.net/manual/zh/features.commandline.php)

知识点
-----------

- 运行php文件： php my_script.php
    > 指定的 PHP 脚本并非必须要以 .php 为扩展名，它们可以有任意的文件名和扩展名
    
- 在命令行直接运行 PHP 代码
    >  php -r 'print_r(get_defined_constants());'    
    
- 通过标准输入（stdin）提供需要运行的 PHP 代码。 
    > $ some_application | some_filter | php | sort -u >final_output.txt
    
+   变量传递
    
    传递给脚本的参数可在全局变量 $argv 中获取。该数组中下标为零的成员为脚本的名称
    （当 PHP 代码来自标准输入获直接用 -r 参数以命令行方式运行时，该名称为“-”）。
    另外，全局变量 $argc 存有 $argv 数组中成员变量的个数（而非传送给脚本程序的参数的个数）。 
    
    只要传送给脚本的参数不是以 - 符号开头，就无需过多的注意什么。向脚本传送以 - 开头的参数会导致错误，
    因为 PHP 会认为应该由它自身来处理这些参数。可以用参数列表分隔符 -- 来解决这个问题。
    在 PHP 解析完参数后，该符号后所有的参数将会被原样传送给脚本程序。 
    
    ```
            
            # 以下命令将不会运行 PHP 代码，而只显示 PHP 命令行模式的使用说明：
            $ php -r 'var_dump($argv);' -h
            Usage: php [options] [-f] <file> [args...]
            [...]
            
            # 以下命令将会把“-h”参数传送给脚本程序，PHP 不会显示命令行模式的使用说明：
            $ php -r 'var_dump($argv);' -- -h
            array(2) {
              [0]=>
              string(1) "-"
              [1]=>
              string(2) "-h"
            }
    ```
    
    >
         除此之外，还有另一个方法将 PHP 用于外壳脚本。可以在写一个脚本，并在第一行以 #!/usr/bin/php 开头，在其后加上以 PHP 开始和结尾标记符包含的正常的 PHP 代码，然后为该文件设置正确的运行属性（例如：chmod +x test）。该方法可以使得该文件能够像外壳脚本或 PERL 脚本一样被直接执行。
        #!/usr/bin/php
        <?php
            var_dump($argv);
        ?>
+
    > 
        PHP 的命令行模式能使得 PHP 脚本能完全独立于 web 服务器单独运行。
        如果使用 Unix 系统，需要在 PHP 脚本的最前面加上一行特殊的代码，使得它能够被执行，这样系统就能知道用哪个程序去运行该脚本。
        在 Windows 平台下可以将 php.exe 和 .php 文件的双击属性相关联，也可以编写一个批处理文件来用 PHP 执行脚本。
        为 Unix 系统增加的第一行代码不会影响该脚本在 Windows 下的运行，因此也可以用该方法编写跨平台的脚本程序
        
        
        在用 PHP 编写命令行应用程序时，可以使用两个参数：$argc 和 $argv。
        前面一个的值是比参数个数大 1 的整数（运行的脚本本身的名称也被当作一个参数）。
        第二个是包含有参数的数组，其第一个元素为脚本的名称，下标为数字 0（$argv[0]）。 

