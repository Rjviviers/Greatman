<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_rjsql = "localhost";
$database_rjsql = "greatman";
$username_rjsql = "root";
$password_rjsql = "";
$rjsql = mysql_pconnect($hostname_rjsql, $username_rjsql, $password_rjsql) or trigger_error(mysql_error(),E_USER_ERROR); 
?>