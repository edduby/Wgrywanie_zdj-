<?php
session_start();
if (isset($_POST['login'])&&isset($_POST['password1'])&&isset($_POST['forumpassword'])){
	$all_ok=true;
	$login=$_POST['login'];
	$password1=$_POST['password1'];
	$password2=$_POST['password2'];
	$forumpassword=$_POST['forumpassword'];
	
	
	//nick lenght
if(( strlen($login)<3||strlen($login)>20))
{
	$all_ok=false;
	$_SESSION['e_login']="Error - nick musi miec pomiedzy 3 a 20 znakow";
}

if(ctype_alnum($login)==false)
{	
	$all_ok=false;
	$_SESSION['e_login']="Nie uzywaj znakow specjalnych!@!#$%^&*( etc";
	
}	

if($forumpassword!='nst3')
{	
	$all_ok=false;
	$_SESSION['e_login']="Zle forum password";
	
}	

if($password1!=$password2)
{	
	$all_ok=false;
	$_SESSION['e_login']="Hasla sie od siebie roznia :(";
	
}	



	require_once "connect.php";
	
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try 
	{
	$connect = new mysqli($host,$db_user,$db_password,$db_name);
	
	if($connect->connect_errno!=0)
{
	
	
	throw new Exception(mysqli_connect_errno());
}
else
{
	$result = $connect->query("SELECT id FROM photo WHERE login='$login'");
	
	if(!$result) throw new Exception($connect->error);
	$how_many_mail = $result->num_rows;
	if($how_many_mail>0)
	{
		$all_ok=false;
	$_SESSION['e_login']="Nick juz jest uzywany znajdz sobie inny";
		
	}
	
	$password_hash = md5($password1);
	
	
	if($all_ok==true){
		
		//insert 
		echo "Good Register"; 
		if($connect->query("INSERT INTO photo VALUES(NULL,'$password_hash','$login','user')"))
		{			
		$_SESSION['correctregister']=true;
		header('Location: index.php');			
		}
	else{
		
		throw new Exception($connect->error);
	}
		
	}
	$connect->close();
	
}	
	}
	catch(Exception $e)
	{
		$all_ok=false;
		echo '<span style="color:red;">Error server</span>';
		
	}	
}
else 
{	
}
?>
<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Registration panel</title>
<center><h1>Rejestracja uzytkownikow NST3 panelu zdjec</h1> <br> Tajne haslo z forum dostepne na naszym forum w opdowiednim temacie bez tego niestety nie mozesz sie zarejestrowac! 
 </head>
 <body>
 <?php
if(isset($_SESSION['e_login']))
{
	echo'<br><span style="color:red;">Error:'.$_SESSION['e_login'].'</span>';
	unset($_SESSION['e_login']);
}
?>
<form method="post">
Login:<br/> <input type="text" name="login"/> 
<br/>
Haslo:<br/> <input type="password" name="password1"/> <br/>
Potwierdz haslo:<br/> <input type="password" name="password2"/> <br/>
Tajne haslo z forum:<br/> <input type="password" name="forumpassword"/> <br/>

<br/>
<input type="submit" value="Register" /> 
</form>
<?php
 echo '[<a href="index.php">Powrot na glowna</a>]';
 
?>
 </body>
</html>

