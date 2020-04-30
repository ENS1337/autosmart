<?php
	defined('autosmart') or die('Доступ запрещён!');
    
    $result1 = mysql_query("SELECT * FROM orders WHERE order_confirmed='no'",$link);
    $count1 = mysql_num_rows($result1);
    
    if ($count1 > 0) { $count_str1 = '<p>+'.$count1.'</p>'; } else { $count_str1 = ''; }
?>
<div id="block-header">

    <div id="block-header1" >
        <h3>AUTOSMART. Панель Управления</h3>
        <p id="link-nav"><?php echo $_SESSION['urlpage']; ?></p> 
    </div>

    <div id="block-header2" >
        <p align="right"><a href="administrators.php" >Администраторы</a> | <a href="?logout">Выход</a></p>
        <p align="right">Вы - <span></span></p>
    </div>

</div>

<div id="left-nav">
    <ul>
        <li><a href="orders.php">Заказы</a><?php echo $count_str1;?></li>
        <li><a href="cars.php">Автомобили</a></li>
        <li><a href="category.php">Категории</a></li>
        <li><a href="clients.php">Клиенты</a></li>
    </ul>
</div>