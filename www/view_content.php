<?php
    define('autosmart', true);
	include("include/db_connect.php");
    include("functions/functions.php");
    session_start();
    include("include/auth_cookie.php");
    
    $id = clear_string($_GET["id"]);
    
    $seoquery = mysql_query("SELECT seo_words,seo_description FROM table_cars WHERE cars_id='$id' AND visible='1'",$link);
    If (mysql_num_rows($seoquery) > 0)
    {
        $resquery = mysql_fetch_array($seoquery);
    }

    If ($id != $_SESSION['countid'])
    {
        
        $querycount = mysql_query("SELECT count_views FROM table_cars WHERE cars_id='$id'",$link);
        $resultcount = mysql_fetch_array($querycount); 
        
        $newcount = $resultcount["count_views"] + 1;
        
        $update = mysql_query ("UPDATE table_cars SET count_views='$newcount' WHERE cars_id='$id'",$link);  
    }
    $_SESSION['countid'] = $id;
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
    
    <link rel="stylesheet" type="text/css" href="/fancybox/jquery.fancybox.css" />
    <script type="text/javascript" src="/fancybox/jquery.fancybox.js"></script>
    <script type="text/javascript" src="/js/jTabs.js"></script>
    
	<title>Интернет-магазин по продаже автомобилей</title>
        <style> 
            li{list-style-type: none}
            ul{list-style-type: none}
        </style>
 <script type="text/javascript">
 $(document).ready(function(){
    
    $("ul.tabs").jTabs({content: ".tabs_content", animate: true, effect:"fade"});
    $(".image-modal").fancybox();
    
 });
 
 </script>
        
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
    $result1 = mysql_query("SELECT * FROM table_cars WHERE cars_id='$id' AND visible='1'",$link);
    If (mysql_num_rows($result1) > 0)
    {
    $row1 = mysql_fetch_array($result1);
    do
        {   
        if  (strlen($row1["image"]) > 0 && file_exists("./uploads_images/".$row1["image"]))
        {
            $img_path = './uploads_images/'.$row1["image"];
            $max_width = 200; 
            $max_height = 200; 
             list($width, $height) = getimagesize($img_path); 
            $ratioh = $max_height/$height; 
            $ratiow = $max_width/$width; 
            $ratio = min($ratioh, $ratiow); 
            
            $width = intval($ratio*$width); 
            $height = intval($ratio*$height);    
        }else
        {
            $img_path = "/images/no-image.png";
            $width = 110;
            $height = 200;
        }
echo '
<div id="block-breadcrumbs-and-rating">
    <p id="nav-breadcrumbs"><a href="view_cat.php?type=cars">Легковые автомобили</a> \ <span>'.$row1["mark_auto"].'</span></p>
    <div id="block-like">
        <p id="likegood" tid="'.$id.'">Нравится</p><p id="likegoodcount">'.$row1["like_cars"].'</p> 
    </div>
</div>
<div id="block-content-info">
    <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"/>
        <div id="block-mini-description">
            <p id="content-title">'.$row1["title"].'</p>
            <ul class="reviews-and-counts-content">
                <li><img src="/images/eye-icon.png"/><p>'.$row1["count_views"].'</p></li>
            </ul>
            <p id="style-price">'.group_numerals($row1["price"]).' руб</p>
            <a class="add-cart" id="add-cart-view" tid="'.$row1["cars_id"].'"></a>
            <p id="content-text">'.$row1["mini_description"].'</p>
        </div>
</div>';
    }while ($row1 = mysql_fetch_array($result1));

 $result = mysql_query("SELECT * FROM uploads_images WHERE cars_id='$id'",$link);
 If (mysql_num_rows($result) > 0)
 {
    $row = mysql_fetch_array($result);
    
    echo '<p id="title-add-image">Дополнительные фото автомобиля:</p>
    <div id="block-img-slide">
            <ul>';
    do
{
    
$img_path = './uploads_images/'.$row["image"];
$max_width = 70; 
$max_height = 70; 
 list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 

$width = intval($ratio*$width); 
$height = intval($ratio*$height);    
    
    
echo '
<li>
<a class="image-modal" href="#image'.$row["id"].'"><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></a>
</li>
<a style="display:none;" class="image-modal" rel="group" id="image'.$row["id"].'" ><img  src="./uploads_images/'.$row["image"].'" /></a>
';
}
 while ($row = mysql_fetch_array($result));
 
 echo '</ul>
    </div>';
}

$result = mysql_query("SELECT * FROM table_cars WHERE cars_id='$id' AND visible='1'",$link);
$row = mysql_fetch_array($result);

if ($row["description"] > "" AND $row["featurescar"] > ""){
  echo '
<ul class="tabs">
    <li><a class="active" href="#">Описание автомобиля</a></li>
    <li><a href="#">Характеристики</a></li>
</ul>
<div class="tabs_content">
    <div>'.$row["description"].'</div>
    <div>'.$row["featurescar"].'</div>
</div>';  
}else
echo '';
}    
	?>    
    </div>
    <?php
         include("include/block-footer.php");
        ?>            
    </div>
</body>
</html>