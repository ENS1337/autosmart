<?php
    session_start();
    define('autosmart', true);
    include("include/db_connect.php");
    include("include/functions.php");

    
 If ($_POST["submit_enter"])
 {
    $login = clear_string($_POST["input_login"]);
    $pass  = clear_string($_POST["input_pass"]);
    
  
 if ($login && $pass)
  {
    $pass   = md5($pass);
    $pass   = strrev($pass);
    $pass   = strtolower("mb03foo51".$pass."qj2jjdp9");

   $result = mysql_query("SELECT * FROM reg_admin WHERE login = '$login' AND pass = '$pass'",$link);
   
 If (mysql_num_rows($result) > 0)
  {
    $row = mysql_fetch_array($result);

    $_SESSION['auth_admin'] = 'yes_auth';
    
    $_SESSION['auth_admin_login'] = $row["login"];
	// Должность
    $_SESSION['admin_role'] = $row["role"];
    // Привилегии
      // Заказы
    $_SESSION['accept_orders'] = $row["accept_orders"];
    $_SESSION['delete_orders'] = $row["delete_orders"];
    $_SESSION['view_orders'] = $row["view_orders"];
      // Автомобили  
    $_SESSION['delete_car'] = $row["delete_car"];
    $_SESSION['add_car'] = $row["add_car"];
    $_SESSION['edit_car'] = $row["edit_car"];  
     // Клиенты
    $_SESSION['view_clients'] = $row["view_clients"];
    $_SESSION['delete_clients'] = $row["delete_clients"]; 
      // Категории
    $_SESSION['add_category'] = $row["add_category"]; 
    $_SESSION['delete_category'] = $row["delete_category"];  
    // Администраторы
    $_SESSION['view_admin'] = $row["view_admin"];

    header("Location: index.php");
    }else
    {
        $msgerror = "Неверный Логин и(или) Пароль."; 
    }  
  }else
  {
    $msgerror = "Заполните все поля!";
  }
 
 }

?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <link href="css/style-login.css" rel="stylesheet" type="text/css" />
	<meta name="author" content="sokol0198" />

	<title>Панель Управления - Вход</title>
    <style> 
            li{list-style-type: none}
            ul{list-style-type: none}
    </style>
</head>

<body>

<div id="block-pass-login">
<?php
	if($msgerror)
    {
        echo '<p id="msgerror">'.$msgerror.'</p>';
    }
?>
    <form method="POST">
        <ul id="pass-login">
            <li><label>Логин</label><input type="text" name="input_login"/></li>
            <li><label>Пароль</label><input type="password" name="input_pass"/></li>
        </ul>
        <p align="right"><input type="submit" name="submit_enter" id="submit_enter" value="Вход"/></p>
     </form>

</div>

</body>
</html>