<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
define('autosmart', true); 
include("../include/db_connect.php"); 

          $delete = mysql_query("DELETE FROM category_cars WHERE id = '{$_POST["id"]}'",$link); 
          echo "delete";   
}
?>