<script type="text/javascript">
$(document).ready(function(){
   $('#blocktrackbar').trackbar({
    onMove: function(){
        document.getElementById("start-price").value = this.leftValue;
        document.getElementById("end-price").value = this.rightValue;
    },
    width : 160,
    leftLimit : 60000,
    leftValue : <?php
	
    if ((int)$_GET["start_price"] >=60000 AND (int)$_GET["start_price"] <=9960000){
        echo(int)$_GET["start_price"];
    }else{
        echo "60000";
    }
?>,
    rightLimit : 9960000,
    rightValue : <?php
	
    if ((int)$_GET["end_price"] >=60000 AND (int)$_GET["end_price"] <=9960000){
        echo(int)$_GET["end_price"];
    }else{
        echo "6000000";
    }
?>,
    roundUp : 60000    
   });     
});
</script>
<div id="block-parameter">
    <p class="header-title">Поиск по параметрам</p>
    <p class="title-filter">Стоимость</p>
        <form method="GET" action="search_filter.php">
            <div id="block-input-price">
                <ul>
                    <li><p>от</p></li>
                    <li><input type="text" id="start-price" name="start_price" value="1000"/></li>
                    <li><p>до</p></li>
                    <li><input type="text" id="end-price" name="end_price" value="3000000"/></li>
                    <li><p>руб</p></li>  
                </ul>
            </div>
            
            <div id="blocktrackbar"></div>
            <p class="title-filter">Производители</p>
                <ul class="checkbox-markauto">
                <?php
                    $result = mysql_query("SELECT * FROM category_cars WHERE type_car='cars'",$link);
 
                        If (mysql_num_rows($result) > 0){
                            $row = mysql_fetch_array($result);
                            do{
                                $checked_mark_auto = "";
                                if($_GET["mark_auto"]){
                                    if (in_array($row["id"],$_GET["mark_auto"])){
                                        $checked_mark_auto = "checked";
                                    }
                                }
 echo '

    <li><input '.$checked_mark_auto.' type="checkbox" name="mark_auto[]" value="'.$row["id"].'" id="checkmarkauto'.$row["id"].'" /><label for="checkmarkauto'.$row["id"].'">'.$row["mark_auto"].'</label></li>
  
  
  '; 
 }
  while ($row = mysql_fetch_array($result));	
} 
                
                ?>
                </ul>
            <center><input type="submit" name="submit" id="button-param-search" value=""/></center>
        </form>
</div>