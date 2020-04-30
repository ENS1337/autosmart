<?php
    define('autosmart', true);
	include("include/db_connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="sokol0198" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
	<title>Интернет-магазин по продаже автомобилей</title>
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
    <div id="block-content-contacts">
        <p id="title-contacts">Контакты</p>
        <div id="nav-line"></div>
            <p id="p-contacts">Как к нам проехать</p>
            <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6caaa9f0b3457f3de518251737a8bc12669d9c9f1a9624e1d9b35be4d41f1045&amp;width=1035&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
            <div class="contacts">
            <p><img src="/images/1.png"/><div>г. Новосибирск,  ул. Ипподромская 2/1</div></p>
            </div>
            <div class="contacts">
            <p><img src="/images/2.png"/><div>+7 (383) 322-25-85</div></p>
            </div>
            <div class="contacts">
            <p><img src="/images/3.png"/><div id="block-3-contacts">Будние дни: с 9:00 до 20:00<br />Суббота, Воскресенье - выходные</div></p>
            </div>
            <div class="contacts">
            <p><img src="/images/4.png"/><div>info@autosmart.ru</div></p>
            </div>
        <div id="nav-line"></div>
        <p id="bottom-text">Вы остались чем то недовольны? Есть вопросы или пожелания нашей компании? Тогда настоятельно рекомендуем <a href="feedback.php">обратиться к нам.</a></p>
    </div>
    <?php
         include("include/block-footer.php");
        ?>            
    </div>
</body>
</html>