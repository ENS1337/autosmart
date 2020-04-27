<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    define('autosmart', true);
    session_start();
    if ($_SESSION['likeid'] != (int)$_POST["id"])
    {
        include("db_connect.php");
        $id = (int)$_POST["id"];
     	$result = mysql_query("SELECT * FROM table_cars WHERE cars_id = '$id'",$link);
         
        If (mysql_num_rows($result) > 0){
        $row1 = mysql_fetch_array($result); 
        $new_count = $row1["like_cars"] + 1;
        $update = mysql_query ("UPDATE table_cars SET like_cars='$new_count' WHERE cars_id='$id'",$link);
        echo $new_count;
        }
    $_SESSION['likeid'] = (int)$_POST["id"]; 
    }
    else
    {
        echo 'no';
    }
}
?>