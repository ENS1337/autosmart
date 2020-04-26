<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{  
    session_start();
    if ($_SESSION['likeid'] != (int)$_POST["id"])
    {
        include("db_connect.php");
        $id = (int)$_POST["id"];
     	$result = mysql_query("SELECT * FROM table_cars WHERE cars_id = '$id'",$link);
         
        If (mysql_num_rows($result) > 0){
        $row = mysql_fetch_array($result); 
        $new_count = $row["like"] + 1;
        $update = mysql_query ("UPDATE table_cars SET like='$new_count' WHERE cars_id='$id'",$link);
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