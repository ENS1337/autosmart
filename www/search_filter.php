<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    
    $cat = clear_string($_GET["cat"]);
    $type = clear_string($_GET["type"]);
    
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="sokol0198" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="trackbar/trackbar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script>
    <script type="text/javascript" src="/js/shop-script.js"></script>
    <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>
    <script type="text/javascript" src="/trackbar/jquery.trackbar.js"></script>
    
	           <title>Поиск по параметрам</title>
        
        <style> 
            li{list-style-type: none}
            ul{list-style-type: none}
        </style>
</head>

<body>
    <div id="block-body">
    <?php
         include("include/block-header.php");
        ?>
    <div id="block-right">
    <?php
         include("include/block-category.php");
         include("include/block-parameter.php");
         include("include/block-news.php");
        ?>
    </div>
    <div id="block-content">   
    <?php
    
    if($_GET["mark_auto"]){
        $check_mark_auto = implode(',',$_GET["mark_auto"]);
    }   
    $start_price = (int)$_GET["start_price"];
    $end_price = (int)$_GET["end_price"];
    
    if(!empty($check_mark_auto) OR !empty($end_price)){
        if(!empty($check_mark_auto)) $query_mark_auto = "AND mark_auto_id IN($check_mark_auto)";
        if(!empty($end_price)) $query_price = "AND price BETWEEN $start_price AND $end_price";
    }
    
    $result = mysql_query("SELECT * FROM table_cars WHERE visible='1' $query_mark_auto $query_price ORDER BY cars_id DESC",$link);
      
    if(mysql_numrows($result) > 0)
      {
        $row = mysql_fetch_array($result);
        
        echo '<div id="block-sorting">
            <p id="nav-breadcrumbs"><a href="index.php">Главная страница</a> \ <span>Все автомобили</span></p>
                <ul id="option-list">
                    <li>Вид: </li>
                    <li><img id="style-grid" src="images/icon-grid.png"/></li>
                    <li><img id="style-list" src="images/icon-list.png"/></li>
                    
                    <li>Сортировать: </li>
                    <li><a id="select-sort">'.$sort_name.'</a>
                        <ul id="sorting-list">
                            <li><a href="view_cat.php?'.$catlink.'type='.$type.'&sort=price-asc">От дешевых к дорогим</a></a></li>
                            <li><a href="view_cat.php?'.$catlink.'&type='.$type.'&sort=price-desc">От дорогих к дешевым</a></a></li>
                            <li><a href="view_cat.php?'.$catlink.'&type='.$type.'&sort=news">Новинки</a></a></li>
                            <li><a href="view_cat.php?'.$catlink.'&type='.$type.'&sort=mark">От А-Я</a></a></li>              
                        </ul>  
                    </li>
                </ul>
        </div>
        <ul id="block-car-grid">    
        ';
        do{
            if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"])){
                    $img_path = './uploads_images/'.$row["image"];
                    $max_width = 200; 
                    $max_height = 200; 
                     list($width, $height) = getimagesize($img_path); 
                    $ratioh = $max_height/$height; 
                    $ratiow = $max_width/$width; 
                    $ratio = min($ratioh, $ratiow); 
                    $width = intval($ratio*$width); 
                    $height = intval($ratio*$height);    
            }
                    else{
                    $img_path = "/images/noimages80x70.png";
                    $width = 80;
                    $height = 70;
                    } 
        echo'<li>
            <div class="block-images-grid">
                        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
                        <ul class="reviews-and-counts-grid">
                        <li><img src="/images/eye-icon.png"/><p>0</p></li>
                        <li><img src="/images/comment-icon.png"/><p>0</p></li>
                    </ul>  
                    </div>
                    <p class="style-title-grid"><a href="">'.$row["title"].'</a></p>
                    <a class="add-cart-style-grid"></a>
                    <p class="style-price-grid"><strong>'.$row["price"].'</strong> руб.</p>
                    <div class="mini-featurescar">
                        '.$row["mini_featurescar"].'
                    </div>
                </li>';
            
        }while($row = mysql_fetch_array($result)); 
    ?>
    </ul>
    
    <ul id="block-car-list">    
    <?php
	  $result = mysql_query("SELECT * FROM table_cars WHERE visible='1' $query_mark_auto $query_price ORDER BY cars_id DESC",$link);
      
      if(mysql_numrows($result) > 0)
      {
        $row = mysql_fetch_array($result);
        do{
            if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"])){
                    $img_path = './uploads_images/'.$row["image"];
                    $max_width = 150; 
                    $max_height = 150; 
                     list($width, $height) = getimagesize($img_path); 
                    $ratioh = $max_height/$height; 
                    $ratiow = $max_width/$width; 
                    $ratio = min($ratioh, $ratiow); 
                    $width = intval($ratio*$width); 
                    $height = intval($ratio*$height);    
            }
                    else{
                    $img_path = "/images/noimages80x70.png";
                    $width = 80;
                    $height = 70;
                    } 
            echo'<li>
                    <div class="block-images-list">
                        <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" />
                    </div>
                    
                    <ul class="reviews-and-counts-list">
                        <li><img src="/images/eye-icon.png"/><p>0</p></li>
                        <li><img src="/images/comment-icon.png"/><p>0</p></li>
                    </ul>
                    
                    <p class="style-title-list"><a href="">'.$row["title"].'</a></p>
                    <a class="add-cart-style-list"></a>
                    
                    <p class="style-price-list"><strong>'.$row["price"].'</strong> руб.</p>
                    <div class="mini-description-list">
                        '.$row["mini_description"].'
                    </div>
                </li>';
            
        }while($row = mysql_fetch_array($result));
      }
   }else{
        echo '<h3>По вашему запросу ничего не найдено.</h3>';
   }
    ?>
    </ul>    
    </div>
    <?php
         include("include/block-footer.php");
        ?>            
    </div>
    </body>
</html>