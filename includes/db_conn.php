<?php
require ("db_attrib.php");
$conn=mysql_connect(DB_HOST,DB_USER,DB_PASS);
if(!$conn)
{
    die("Database Connection Failed".mysql_error());
}
$db_select=  mysql_select_db(DB_NAME);
if(!$db_select)
{
    die("Database Connection Failed".mysql_error());
}
?>
