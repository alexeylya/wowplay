<?php

	$dbip = "127.0.0.1";           	// IP mysql
	$dblogin = "trinity";           // логин mysql 
    $dbpass = "trinity";            // пароль mysql
	$adminpassnews = "12345";       //Пароль администратора для добавления новостей
    $saitbd = "auth";               //название базы сайта(с новостями)
	
	if (!$conn = mysql_connect($dbip, $dblogin, $dbpass))
{
	echo "<h2>MySQL Error!</h2>";
	exit;
}


	$sex1= $_POST['fullnews'];
	$sex2= $_POST['textmini'];
	$sex3= $_POST['data'];
	$sex4= $_POST['nazva'];
	$sex5= $_POST['images'];



	
	if (empty($_POST['fullnews'])){echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Не введено полное название новости</font></br>Через 3 секунды вы будете перенапревлены назад</center>
<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	
	";}
	elseif (empty($_POST['textmini'])){echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Не ввели короткий текст новости</font></br>Через 3 секунды вы будете перенапревлены назад</center>
	<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	";}
	elseif (empty($_POST['nazva'])){echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Не ввели название новости</font></br>Через 3 секунды вы будете перенапревлены назад</center>
	<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	";}
		elseif (empty($_POST['data'])){echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Не ввели дату</font></br>Через 3 секунды вы будете перенапревлены назад</center>
	<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	";}
	//------------------------------------------------------------------------
			elseif (empty($_POST['images'])){echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Не ввели дату</font></br>Через 3 секунды вы будете перенапревлены назад</center>
	<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	";}
	//------------------------------------------------------------------------
	elseif($_POST['adminpassword'] != $adminpassnews)
	{echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:red;margin-top:200px;\">Пароль администратора неверный</font></br>Через 3 секунды вы будете перенапревлены назад</center>
	<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/?page=addnews\"; 
} 
setTimeout( 'GoNah()', 3000 ); 
//--> 
</script>
	";}

	 
	
 else{

	 	mysql_select_db($saitbd) or die ("не выбралась дб");
		mysql_query("set names UTF8");
		
			$result = mysql_query("INSERT INTO news(textfull,textmini,data,nazva,images) VALUES('$sex1','$sex2','$sex3','$sex4','$sex5')");
            echo "<center style=\"margin-top:300px;\"><font style=\"font-size:30px;color:green;margin-top:200px;\">Новость успешно добавлена!</font></br>Через 6 секунд вы будете перенапревлены назад</center>
				<script language=\"JavaScript\" type=\"text/javascript\">
<!-- 
function GoNah(){ 
 location=\"http://".$_SERVER['HTTP_HOST']."/\"; 
} 
setTimeout( 'GoNah()', 6000 ); 
//--> 
</script>
			";

			}
 
 
      
?>