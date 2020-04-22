<div id="block-news">
    <center><img id="news-prev" src="images/img-prev.png"/></center>
    <div id="newsticker">
        <ul>
            <?php 
                $result = mysql_query("SELECT * FROM table_cars ORDER BY datetime DESC",$link);
                    If (mysql_num_rows($result) > 0){
                        $row = mysql_fetch_array($result);
                        do{
                            if  ($row["image"] != "" && file_exists("./uploads_images/".$row["image"])){
                    $img_path = './uploads_images/'.$row["image"];
                    $max_width = 300; 
                    $max_height = 300; 
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
echo '<li>
            <span>'.$row["datetime"].'</span><a href="" >'.$row["title"].'</a><p><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'" /></p>
    </li>';
    }
    while ($row = mysql_fetch_array($result)); 
}
?>
        </ul>   
    </div>
    <center><img id="news-next" src="images/img-next.png"/></center>
</div>
