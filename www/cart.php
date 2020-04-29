<?php
define('autosmart', true);
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
if (isset($_POST["submitdata"]))
{
    $_SESSION["order_delivery"] = $_POST["order_delivery"];
    $_SESSION["order_fio"] = $_POST["order_fio"];
    $_SESSION["order_email"] = $_POST["order_email"];
    $_SESSION["order_phone"] = $_POST["order_phone"];
    $_SESSION["order_address"] = $_POST["order_address"];
    $_SESSION["order_note"] = $_POST["order_note"];

    header("Location: cart.php?action=completion");
}
$result = mysql_query("SELECT * FROM cart, table_cars WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_cars.cars_id = cart.cart_id_cars", $link);
If (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    do{

        $int = $int + $row["price"];

    }while ($row = mysql_fetch_array($result));

    $itogpricecart = $int;
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
                            $width = 200;
                            $height = 150;
                        }
                        echo '<div class="block-list-cart">
                    <div class="img-cart">
                        <center><p><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p></center>
                    </div>
                    <div class="title-cart">
                        <p><a href="view_content.php?id='.$row["cars_id"].'">'.$row["title"].'</a></p>
                        <p class="cart-mini_featurescar">'.$row["mini_featurescar"].'</p>
                    </div>
                    <div class="price-cars">
                        <strong>Стоимость:</strong>
                        <ul id="price-cart">
                            <li><h5><span>'.group_numerals($int).'</span></h5></li>
                            <li><p> руб.</p></li>
                        </ul>
                    </div>
                    <div class="delete-cart">
                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="images/bsk_item_del.png"/></a>
                    </div>
                    <div id="bottom-cart-line"></div>
                    </div>';
                    }while ($row = mysql_fetch_array($result));
                    echo '
               <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
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
                            <li><a href="cart.php?action=onclick">1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a class="active">2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a>3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 2 из 3</p>
                </div>';
                if ($_SESSION['order_delivery'] == "Автовозом") $chck1 = "checked";
                if ($_SESSION['order_delivery'] == "Самовывоз") $chck2 = "checked";
                echo '
            <h3 class="title-h3" >Способы доставки:</h3>
            <form method="POST">
            <ul id="info-radio">
            <li>
            <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="Автовозом" '.$chck1.'  />
            <label class="label_delivery" for="order_delivery1">Автовозом</label>
            </li>
            <li>
            <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Самовывоз" '.$chck2.' />
            <label class="label_delivery" for="order_delivery2">Самовывоз</label>
            </li>
            </ul>
            <h3 class="title-h3" >Информация для доставки:</h3>
            <ul id="info-order">';
                if ( $_SESSION['auth'] != 'yes_auth' ) {
                    echo '
                <li><label for="order_fio"><span>*</span>ФИО</label><input type="text" name="order_fio" id="order_fio" value="'.$_SESSION["order_fio"].'" /><span class="order_span_style" >Пример: Иванов Иван Иванович</span></li>
                <li><label for="order_email"><span>*</span>E-mail</label><input type="text" name="order_email" id="order_email" value="'.$_SESSION["order_email"].'" /><span class="order_span_style" >Пример: ivanov@mail.ru</span></li>
                <li><label for="order_phone"><span>*</span>Телефон</label><input type="text" name="order_phone" id="order_phone" value="'.$_SESSION["order_phone"].'" /><span class="order_span_style" >Пример: 8 950 100 12 34</span></li>
                <li><label class="order_label_style" for="order_address"><span>*</span>Адрес<br /> доставки</label><input type="text" name="order_address" id="order_address" value="'.$_SESSION["order_address"].'" /><span>Пример: г. Москва,<br /> ул Интузиастов д 18, кв 58</span></li>
            ';
                }
                echo '
        <li><label class="order_label_style" for="order_note">Примечание</label><textarea name="order_note"  >'.$_SESSION["order_note"].'</textarea><span>Уточните информацию о заказе.<br />  Например, удобное время для звонка<br />  нашего менеджера</span></li>
        </ul>
        <p align="right" ><input type="submit" name="submitdata" id="confirm-button-next" value="Далее" /></p>
        </form>';

                break;

            case 'completion':
                echo '
                <div id="block-step">
                    <div id="name-step">
                        <ul>
                            <li><a href="cart.php?action=onclick">1. Корзина автомобилей</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a href="cart.php?action=confirm">2. Контактная информация</a></li>
                            <li><span>&rarr;</span></li>
                            <li><a class="active">3. Завершение</a></li>
                        </ul>
                    </div>
                    <p>Шаг 3 из 3</p>
                </div>
                <h3>Конечная информация:</h3>';

                if ( $_SESSION['auth'] == 'yes_auth' ) {
                    echo '
                <ul id="list-info" >
                <li><strong>Способ доставки:</strong>'.$_SESSION['order_delivery'].'</li>
                <li><strong>Email:</strong>'.$_SESSION['auth_email'].'</li>
                <li><strong>ФИО:</strong>'.$_SESSION['auth_surname'].' '.$_SESSION['auth_name'].' '.$_SESSION['auth_patronymic'].'</li>
                <li><strong>Адрес:</strong>'.$_SESSION['auth_address'].'</li>
                <li><strong>Телефон:</strong>'.$_SESSION['auth_phone'].'</li>
                <li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>
                </ul>';
                }else{
                    echo '
                <ul id="list-info" >
                <li><strong>Способ доставки:</strong>'.$_SESSION['order_delivery'].'</li>
                <li><strong>Email:</strong>'.$_SESSION['order_email'].'</li>
                <li><strong>ФИО:</strong>'.$_SESSION['order_fio'].'</li>
                <li><strong>Адрес:</strong>'.$_SESSION['order_address'].'</li>
                <li><strong>Телефон:</strong>'.$_SESSION['order_phone'].'</li>
                <li><strong>Примечание: </strong>'.$_SESSION['order_note'].'</li>
                </ul>';
                }
                echo '
                    <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($itogpricecart).'</strong> руб</h2>
                    <p align="right" class="button-next" ><a href="" >Оплатить</a></p>';
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
                        <strong>Стоимость:</strong>
                        <ul id="price-cart">
                            <li><h5><span>'.group_numerals($int).'</span></h5></li>
                            <li><p> руб.</p></li>
                        </ul>
                    </div>
                    <div class="delete-cart">
                        <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="images/bsk_item_del.png"/></a>
                    </div>
                    <div id="bottom-cart-line"></div>
                    </div>';
                    }while ($row = mysql_fetch_array($result));
                    echo '
               <h2 class="itog-price" align="right">Итого: <strong>'.group_numerals($all_price).'</strong> руб</h2>
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