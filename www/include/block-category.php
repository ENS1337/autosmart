<div id="block-category">
<p class="header-title">Категории автомобилей</p>
    <ul>
        <li><a id="index1">Легковые автомобили</a>
            <ul class="category-section">
                <li><a href="view_cat.php?type=cars"><strong>Все автомобили</strong></a></li>
                <?php
                    $result = mysql_query("SELECT * FROM category_cars WHERE type_car='cars' ORDER BY mark_auto",$link);
                        If (mysql_num_rows($result) > 0){
                            $row = mysql_fetch_array($result);
                            do{
                                echo '<li><a href="view_cat.php?cat='.strtolower($row["mark_auto"]).'&type='.$row["type_car"].'">'.$row["mark_auto"].'</a></li>';
                                }while ($row = mysql_fetch_array($result));
                        } 
                    ?>
            </ul>
        </li>
        <li><a id="index2">Грузовые автомобили</a>
            <ul class="category-section">
                <li><a href="view_cat.php?type=trucks"><strong>Все автомобили</strong></a></li>
                <?php
                    $result = mysql_query("SELECT * FROM category_cars WHERE type_car='trucks' ORDER BY mark_auto",$link);
                        If (mysql_num_rows($result) > 0){
                            $row = mysql_fetch_array($result);
                            do{
                                echo '<li><a href="view_cat.php?cat='.strtolower($row["mark_auto"]).'&type='.$row["type_car"].'">'.$row["mark_auto"].'</a></li>';
                                }while ($row = mysql_fetch_array($result));
                        } 
                    ?>
            </ul>
        </li> 
        <li><a id="index3">Пассажирские автомобили</a>
            <ul class="category-section">
                <li><a href="view_cat.php?type=passenger"><strong>Все автомобили</strong></a></li>
                <?php
                    $result = mysql_query("SELECT * FROM category_cars WHERE type_car='passenger' ORDER BY mark_auto",$link);
                        If (mysql_num_rows($result) > 0){
                            $row = mysql_fetch_array($result);
                            do{
                                echo '<li><a href="view_cat.php?cat='.strtolower($row["mark_auto"]).'&type='.$row["type_car"].'">'.$row["mark_auto"].'</a></li>';
                                }while ($row = mysql_fetch_array($result));
                        } 
                    ?>
            </ul>
        </li>  
    </ul>
</div>