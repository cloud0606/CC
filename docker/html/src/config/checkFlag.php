<?php
ob_start();
include "/flag";
$flag = ob_get_contents();
ob_end_clean();
# 替换文件读入后自动加入的换行符
$flag=preg_replace("/\s/","",$flag);
echo hash("sha256",$flag);
?>
