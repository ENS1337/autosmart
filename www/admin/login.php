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