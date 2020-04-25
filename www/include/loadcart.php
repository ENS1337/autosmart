<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    include("db_connect.php");
    include("../functions/functions.php");
    
    $result = mysql_query("SELECT * FROM cart,table_cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_cars.cars_id = cart.cart_id_cars",$link);
    If (mysql_num_rows($result) > 0)
    {
    $row = mysql_fetch_array($result);
    
    do
    {
    $count = $count + $row["cart_count"];    
    $int = $int + $row["price"]; 
    }
     while ($row = mysql_fetch_array($result));
     
    If ($count == 1 or $count == 21) ( $str = ' автомобиль');
    If ($count == 2 or $count == 3 or $count == 4) ( $str = ' автомобиля');
    If ($count == 5 or $count == 6 or $count == 7 or $count == 8 or $count == 9 or $count == 10 or $count == 11 or $count == 12 or $count == 13 or $count == 14 or $count == 15 or $count == 16 or $count == 17 or $count == 18 or $count == 19 or $count == 20) ( $str = ' автомобилей');
    
    if ($count > 21)
    {
        $str=" авто";
    }
     
         echo '<span>'.$count.$str.'</span> на сумму <span>'.group_numerals($int).'</span> руб';
    }
    else
    {
         echo '0';
    
    }
}
?>