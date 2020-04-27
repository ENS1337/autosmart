<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    define('autosmart', true);
    include("db_connect.php");
    include("../functions/functions.php");
            
    $id = clear_string($_POST["id"]);
    
    $result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_cars = '$id'",$link);
    If (mysql_num_rows($result) > 0)
    {
    $row = mysql_fetch_array($result);       
    }else{
    $result = mysql_query("SELECT * FROM table_cars WHERE cars_id = '$id'",$link);
    $row = mysql_fetch_array($result);
    
    		mysql_query("INSERT INTO cart(cart_id_cars,cart_price,cart_datetime,cart_ip)
						VALUES(	
                            '".$row['cars_id']."',
                            '".$row['price']."',					
							NOW(),
                            '".$_SERVER['REMOTE_ADDR']."'                                                                        
						    )",$link);	
          }
}
?>