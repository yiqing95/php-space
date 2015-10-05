<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/9/26
 * Time: 9:28
 */
?>
<?php

// Code highlighting produced by Actipro CodeHighlighter (freeware)http://www.CodeHighlighter.com/-->// Xml 转 数组, 包括根键，忽略空元素和属性，尚有重大错误
/**
 * @param $xml
 * @return array
 */
function xml_to_array( $xml )
{
    $reg = "/<(\\w+)[^>]*?>([\\x00-\\xFF]*?)<\\/\\1>/";
    if(preg_match_all($reg, $xml, $matches))
    {
        $count = count($matches[0]);
        $arr = array();
        for($i = 0; $i < $count; $i++)
        {
            $key= $matches[1][$i];
            $val = xml_to_array( $matches[2][$i] );  // 递归
            if(array_key_exists($key, $arr))
            {
                if(is_array($arr[$key]))
                {
                    if(!array_key_exists(0,$arr[$key]))
                    {
                        $arr[$key] = array($arr[$key]);
                    }
                }else{
                    $arr[$key] = array($arr[$key]);
                }
                $arr[$key][] = $val;
            }else{
                $arr[$key] = $val;
            }
        }
        return $arr;
    }else{
        return $xml;
    }
}


$xml = <<<XML_DOC
<?xml version='1.0' encoding='utf-8'?>
<!--
  Licensed to the Apache Software Foundation (ASF) under one or more
  contributor license agreements.  See the NOTICE file distributed with
  this work for additional information regarding copyright ownership.
  The ASF licenses this file to You under the Apache License, Version 2.0
  (the "License"); you may not use this file except in compliance with
  the License.  You may obtain a copy of the License at

      http://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License.
-->
<tomcat-users>
<!--
  NOTE:  By default, no user is included in the "manager-gui" role required
  to operate the "/manager/html" web application.  If you wish to use this app,
  you must define such a user - the username and password are arbitrary.
-->
<!--
  NOTE:  The sample user and role entries below are wrapped in a comment
  and thus are ignored when reading this file. Do not forget to remove
  <!.. ..> that surrounds them.
-->
<!--
  <role rolename="tomcat"/>
  <role rolename="role1"/>
  <user username="tomcat" password="tomcat" roles="tomcat"/>
  <user username="both" password="tomcat" roles="tomcat,role1"/>
  <user username="role1" password="tomcat" roles="role1"/>
-->
  <role rolename="tomcat"/>
  <role rolename="role1"/>
  <role rolename="manager-gui"/>

  <user username="tomcat" password="tomcat" roles="manager-gui"/>


  <user username="both" password="tomcat" roles="tomcat,role1"/>
  <user username="role1" password="tomcat" roles="role1"/>

</tomcat-users>
XML_DOC;


$xml2 = <<<XML2
<?xml version='1.0' encoding='utf-8'?>
  <role rolename="tomcat"/>
  <role rolename="role1"/>
  <role rolename="manager-gui"/>

  <user username="tomcat" password="tomcat" roles="manager-gui"/>


  <user username="both" password="tomcat" roles="tomcat,role1"/>
  <user username="role1" password="tomcat" roles="role1"/>

</tomcat-users>
XML2;


print_r(xml_to_array($xml2)) ;

$xml3 = <<<XML3
<role>test</role>
XML3;
print_r(xml_to_array($xml3)) ;