<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/10/6
 * Time: 19:42
 */
/**
 * ���ļ��ṩ�Զ����ع��� ͨ���������ļ� ����ʹ��composer ������������
 */

define('DS',DIRECTORY_SEPARATOR) ;

function autoloadVendor()
{
    $rootBaseName = 'php-space' ;
    $phpSpaceRootDir = substr(__DIR__,0,strpos(__DIR__,$rootBaseName)).$rootBaseName;
    // die($phpSpaceRootDir) ;
    $vendorDir = $phpSpaceRootDir.DS.'vendor';

    require $vendorDir.'/autoload.php';
}
// �Զ�����vendorĿ¼�µ�������
autoloadVendor() ;
