<?php
  require_once "sql.php";
  $sql_db = new sql_db();
  $con_link = mysql_connect($sql_db->host,$sql_db->user,$sql_db->pwd);
  mysql_query("set names utf8"); 
  mysql_select_db($sql_db->db); 
?>