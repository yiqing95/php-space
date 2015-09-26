<form action="" METHOD="POST">
    <input type="text" name="param"/>
    <button type="submit">提交</button>
</form>
<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/15
 * Time: 16:46
 */
/**
 * @LINK
 * +-----------------------------------------------------+
 *
 *
 * $_POST：通过 HTTP POST 方法传递的变量组成的数组。是自动全局变量。
 *
 *
 *
 * $GLOBALS['HTTP_RAW_POST_DATA'] ：总是产生 $HTTP_RAW_POST_DATA 变量包含有原始的 POST 数据。此变量仅在碰到未识别 MIME 类型的数据时产生。$HTTP_RAW_POST_DATA 对于 enctype="multipart/form-data" 表单数据不可用。
 *
 *
 *
 * 也就是说基本上$GLOBALS['HTTP_RAW_POST_DATA'] 和 $_POST是一样的。
 *
 * 但是如果post过来的数据不是PHP能够识别的，你可以用 $GLOBALS['HTTP_RAW_POST_DATA']来接收，比如 text/xml 或者 soap 等等。
 * 补充说明：PHP默认识别的数据类型是application/x-www.form-urlencoded标准的数据类型。
 * +------------------------------------------------------+
 * 通过 HTTP POST 发送的变量不会显示在 URL 中。
 *
 * 　　当我们用$_POST接受不到页面传过来信息时，我们可以用php://input去接受值，那么他俩有什么区别
 *
 * 　　首先当$_POST 与 php://input可以取到值时$HTTP_RAW_POST_DATA 为空;
 *
 * 　　$http_raw_post_data是PHP内置的一个全局变量。
 *     它用于，PHP在无法识别的Content-Type的情况下，将POST过来的数据原样地填入变量$http_raw_post_data。
 *     它同样无法读取Content-Type为multipart/form-data的POST数据。
 *     需要设置php.ini中的always_populate_raw_post_data值为On，PHP才会总把POST数据填入变量$http_raw_post_data。
 *
 * 　　然后$_POST以关联数组方式组织提交的数据，并对此进行编码处理，如urldecode，甚至编码转换;
 * 7
 *
 * 而php://input 通过输入流以文件读取方式取得未经处理的POST原始数据;
 *
 * 　　php://input 允许读取 POST 的原始数据。
 *     和 $HTTP_RAW_POST_DATA 比起来，它给内存带来的压力较小，并且不需要任何特殊的 php.ini 设置。
 *     php://input 不能用于 enctype=”multipart/form-data”;
 *
 * 　　php://input读取不到$_GET数据。是因为$_GET数据作为query_path写在http请求头部(header)的PATH字段，而不是写在http请求的body部分
 *
 * +-------------------------------------------------------+
 */
print_r([
    'post' => $_POST,
    'global-row-post-data' => $GLOBALS['HTTP_RAW_POST_DATA'],
    'raw-input' => file_get_contents('php://input')
]);