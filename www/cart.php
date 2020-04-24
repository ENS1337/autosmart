<?php
	include("include/db_connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");
    
    $id = clear_string($_GET["id"]);
    $action = clear_string($_GET["action"]);
    
   switch ($action) {

	    case 'clear':
        $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);     
	    break;
        
        case 'delete':     
        $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'",$link);        
        break;
        
	}
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
    <script type="text/javascript" src="/js/TextChange.js"></script>
	<title>Корзина заказов</title>
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
        $action = clear_string($_GET["action"]);
        switch ($action){
            
            case 'onclick':
            echo '
                <div id="block-step">
                    <div id="name-step">
                        <ul>
                            <li><a class="active">1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 1 из 3</p>
                    <a href="cart.php?action=clear">Очистить</a>
                </div>';
            
            $result = mysql_query("SELECT * FROM cart, table_cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_cars.cars_id = cart.cart_id_cars", $link);    
            if (mysql_num_rows($result) > 0){
               $row = mysql_fetch_array($result);
               
                echo '
                <div id="header-list-cart">
                    <div id="head1">Изображение</div>
                    <div id="head2">Название Автомобиля</div>
                    <div id="head3">Цена</div>
                </div>';
                
               do{
                $int = $row["cart_price"];
                $all_price = $all_price + $int;
                    
                    if  (strlen($row["image"]) != "" && file_exists("./uploads_images/".$row["image"])){
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
                   echo '<div class="block-list-cart">
                    <div class="img-cart">
                        <center><p><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p></center>
                    </div>
                    <div class="title-cart">
                        <p><a href="">'.$row["title"].'</a></p>
                        <p class="cart-mini_featurescar">'.$row["mini_featurescar"].'</p>
                    </div>
                    <div class="price-cars">
                        <h5><span>'.$int.'</span></h5><p>'.$int.'</p>
                    </div>
                    <div class="delete-cart">
                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="images/bsk_item_del.png"/></a>
                    </div>
                    <div id="bottom-cart-line"></div>
                    </div>
                </div>';  
               }while ($row = mysql_fetch_array($result));
               echo '
               <h2 class="itog-price" align="right">Итого: <strong>'.$all_price.'</strong> руб</h2>
               <p align="right" class="button-next" ><a href="cart.php?action=confirm">Далее</a></p> ';
            }
            else{
                echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
            }
            break;
            
            case 'confirm':
            echo '
                <div id="block-step">
                    <div id="name-step">
                        <ul>
                            <li><a>1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a class="active">2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 1 из 3</p>
                    <a href="cart.php?action=clear">Очистить</a>
                </div>';
            break;
            
            case 'completion':
            echo '
                <div id="block-step">
                    <div id="name-step">
                        <ul>
                            <li><a>1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a class="active">3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 1 из 3</p>
                    <a href="cart.php?action=clear">Очистить</a>
                </div>';
            break;
            
            default:
            echo '
                <div id="block-step">
                    <div id="name-step">
                        <ul>
                            <li><a class="active">1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 1 из 3</p>
                    <a href="cart.php?action=clear">Очистить</a>
                </div>';
            
            $result = mysql_query("SELECT * FROM cart, table_cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_cars.cars_id = cart.cart_id_cars", $link);    
            if (mysql_num_rows($result) > 0){
               $row = mysql_fetch_array($result);
               
                echo '
                <div id="header-list-cart">
                    <div id="head1">Изображение</div>
                    <div id="head2">Название Автомобиля</div>
                    <div id="head3">Цена</div>
                </div>';
                
               do{
                $int = $row["cart_price"];
                $all_price = $all_price + $int;
                    
                    if  (strlen($row["image"]) != "" && file_exists("./uploads_images/".$row["image"])){
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
                   echo '<div class="block-list-cart">
                    <div class="img-cart">
                        <center><p><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p></center>
                    </div>
                    <div class="title-cart">
                        <p><a href="">'.$row["title"].'</a></p>
                        <p class="cart-mini_featurescar">'.$row["mini_featurescar"].'</p>
                    </div>
                    <div class="price-cars">
                        <h5><span>'.$int.'</span></h5><p>'.$int.'</p>
                    </div>
                    <div class="delete-cart">
                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="images/bsk_item_del.png"/></a>
                    </div>
                    <div id="bottom-cart-line"></div>
                    </div>
                </div>';  
               }while ($row = mysql_fetch_array($result));
               echo '
               <h2 class="itog-price" align="right">Итого: <strong>'.$all_price.'</strong> руб</h2>
               <p align="right" class="button-next" ><a href="cart.php?action=confirm">Далее</a></p> ';
            }
            else{
                echo '<h3 id="clear-cart" align="center">Корзина пуста</h3>';
            }
            break;
        }
      ?>   
    </div>
    <?php
         include("include/block-footer.php");
        ?>            
    </div>
</body>
</html>