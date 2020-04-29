<?php
session_start();
if ($_SESSION['auth_admin'] == "yes_auth"){
	define('autosmart', true);
    
    if (isset($_GET["logout"])){
        unset($_SESSION['auth_admin']);
        header("Location: login.php");
    }
    $_SESSION['urlpage'] = "<a href='index.php'>Главная</a>";
    
    include("include/db_connect.php");
    include("include/functions.php");
    
    if ($_POST["submit_add"])
    {

    $error = array();
    
    if ($_POST["admin_login"])
    {
        $login = clear_string($_POST["admin_login"]);
        $query = mysql_query("SELECT login FROM reg_admin WHERE login='$login'",$link);
 
     If (mysql_num_rows($query) > 0)
     {
        $error[] = "Логин занят!";
     }
        
        
    }else
    {
        $error[] = "Укажите логин!";
    }
    if (!$_POST["admin_pass"]) $error[] = "Укажите пароль!";
    if (!$_POST["admin_fio"]) $error[] = "Укажите ФИО!";
    if (!$_POST["admin_role"]) $error[] = "Укажите должность!";
    if (!$_POST["admin_email"]) $error[] = "Укажите E-mail!";

 if (count($error))
 {
    $_SESSION['message'] = "<p id='form-error'>".implode('<br />',$error)."</p>";
 }else
 {
    $pass   = md5(clear_string($_POST["admin_pass"]));
    $pass   = strrev($pass);
    $pass   = strtolower("mb03foo51".$pass."qj2jjdp9");
    
                  		mysql_query("INSERT INTO reg_admin(login,pass,fio,role,email,phone,view_orders,accept_orders,delete_orders,add_car,edit_car,delete_car,view_clients,delete_clients,add_category,delete_category,view_admin)
						VALUES(						
                            '".clear_string($_POST["admin_login"])."',
                            '".$pass."',
                            '".clear_string($_POST["admin_fio"])."',
                            '".clear_string($_POST["admin_role"])."',
                            '".clear_string($_POST["admin_email"])."',
                            '".clear_string($_POST["admin_phone"])."',
                            '".$_POST["view_orders"]."',
                            '".$_POST["accept_orders"]."',
                            '".$_POST["delete_orders"]."',							
                            '".$_POST["add_car"]."',
                            '".$_POST["edit_car"]."',                            
							'".$_POST["delete_car"]."',
							'".$_POST["view_clients"]."',
                            '".$_POST["delete_clients"]."',
							'".$_POST["add_category"]."',
							'".$_POST["delete_category"]."',
                            '".$_POST["view_admin"]."'
                            
                                                                                                                                                
						)",$link);
                   
          $_SESSION['message'] = "<p id='form-success'>Пользователь успешно добавлен!</p>";
          }   
        
    }else
    {
       $msgerror = 'У вас нет прав на добавление администраторов!'; 
    }    
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="jquery_confirm/jquery_confirm.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="jquery_confirm/jquery_confirm.js"></script>  
    
	<meta name="author" content="sokol0198" />

	<title>Панель Управления - Клиенты</title>
    <style> 
            li{list-style-type: none}
            ul{list-style-type: none}
    </style>
</head>

<body>
<div id="block-body">
<?php
	include("include/block-header.php");
    $all_client = mysql_query("SELECT * FROM reg_user",$link);
    $result_count = mysql_num_rows($all_client);
?>
    <div id="block-content">
        <div id="block-parameters">
        <p id="title-page">Добавление администратора</p>
        </div>
<?php
	if(isset($_SESSION['message'])){
	   echo $_SESSION['message'];
       unset($_SESSION['message']);
	}
?>        
<form method="POST" id="form-info" >

    <ul id="info-admin">
    <li><label>Логин</label><input type="text" name="admin_login" /></li>
    <li><label>Пароль</label><input type="password" name="admin_pass" /></li>
    <li><label>ФИО</label><input type="text" name="admin_fio" /></li>
    <li><label>Должность</label><input type="text" name="admin_role" /></li>
    <li><label>E-mail</label><input type="text" name="admin_email" /></li>
    <li><label>Телефон</label><input type="text" name="admin_phone" /></li>
    </ul>
    
    <h3 id="title-privilege" >Привилегии</h3>
    
    <p id="link-privilege"><a id="select-all" >Выбрать все</a> | <a id="remove-all" >Снять все</a></p>
    
    <div class="block-privilege">
    
    <ul class="privilege">
    <li><h3>Заказы</h3></li>
    
    <li>
    <input type="checkbox" name="view_orders" id="view_orders" value="1" />
    <label for="view_orders">Просмотр заказов.</label>
    </li>
    
    <li>
    <input type="checkbox" name="accept_orders" id="accept_orders" value="1" />
    <label for="accept_orders">Обработка заказов.</label>
    </li>
    
    <li>
    <input type="checkbox" name="delete_orders" id="delete_orders" value="1" />
    <label for="delete_orders">Удаление заказов.</label>
    </li>
    
    </ul>
    <ul class="privilege">
    <li><h3>Автомобили</h3></li>
    
    <li>
    <input type="checkbox" name="add_car" id="add_car" value="1" />
    <label for="add_car">Добавление автомобилей.</label>
    </li>
    
    <li>
    <input type="checkbox" name="edit_car" id="edit_car" value="1" />
    <label for="edit_car">Изменение автомобилей.</label>
    </li>
    
    <li>
    <input type="checkbox" name="delete_car" id="delete_car" value="1" />
    <label for="delete_car">Удаление автомобилей.</label>
    </li>
    
    </ul>
    
    </div>
    <div class="block-privilege">
    
    <ul class="privilege">
    <li><h3>Клиенты</h3></li>
    
    <li>
    <input type="checkbox" name="view_clients" id="view_clients" value="1" />
    <label for="view_clients">Просмотр клиентов.</label>
    </li>
    
    <li>
    <input type="checkbox" name="delete_clients" id="delete_clients" value="1" />
    <label for="delete_clients">Удаление клиентов.</label>
    </li>  
    </ul>

    <ul class="privilege">
    <li><h3>Категории</h3></li>
    
    <li>
    <input type="checkbox" name="add_category" id="add_category" value="1" />
    <label for="add_category">Добавление категорий.</label>
    </li>
    
    <li>
    <input type="checkbox" name="delete_category" id="delete_category" value="1" />
    <label for="delete_category">Удаление категорий.</label>
    
    </li>
    </ul>
    
    </div>
    
    <div class="block-privilege">
    
    <ul class="privilege">
    <li><h3>Администраторы</h3></li>
    
    <li>
    <input type="checkbox" name="view_admin" id="view_admin" value="1" />
    <label for="view_admin">Просмотр администраторов.</label>
    </li>
    
    </ul>
    
    </div>
    </div>
    <p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить"/></p>
</form>
</div>
</body>
</html>
<?php
}else{
    header("Location: login.php");
}
?>