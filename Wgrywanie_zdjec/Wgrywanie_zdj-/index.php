<?php
session_start();

if((isset($_SESSION['logged']))&&($_SESSION['logged']==true)&&($_SESSION['role']=='user'))
{
header('Location: photo.php');
exit();

}
if((isset($_SESSION['logged']))&&($_SESSION['logged']==true)&&($_SESSION['role']=='admin'))
{
header('Location: photoadmin.php');
exit();

}

?>

<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Photo Upload zdjec dla NST3 Team</title>
 </head>
 <body>
 <center><h1>Photo Upload zdjec dla NST3 Team</h1>
 <br> <img src="http://zdjecia-nst3.za.pl/foto/admin/4_1383166910.jpg"/></center>
 <div class="center">
<div id="panel">
<form action="login.php" method="post">

<label for="username">User name:</label>
 	<br /> <input type="text" name="login" id="username"/> <br />
	<label for="password">Password:</label>
  	<br /> <input type="password" name="password" id="password" /> <br /> 
 	
	 <div id="lower">
	 
	<br /> 
	<a href="register.php">Registration</a>
	<input type="submit" value="Login" />

	<br /> 
	</div>
	Instrukcja: <br>
	Strona zostala stworzona aby umozliwic w latwy sposob dodawanie zdjec na forum. Jezeli ktos nie ma konta wystarczy sie zarejestrowac.
	Jezeli juz mamy konto logujemy sie do swojego panelu gdzie mozemy wybrac zdjecie ktore chcemy wrzyucic a nastepnie je dodajemy gdzie ukazuje nam sie gotowy kod ktory nalezy wkleic w tworzony post na forum.
	Pamietajmy tylko o tym ze zdjecia o tej samej nazwie beda podmieniane, dlatego dodajac nowe zdjecie zmienncie jego nazwe. Powodzenia!
	Zapraszam do odwiedzenia strony Pensjonatu Martin w Szklarskiej Porębie <a href="http://www.martin-szklarska.pl"> Pensjonat Martin Szklarska Poręba </a>
</form> 
 

 <?php
if(isset($_SESSION['error'])) {	echo $_SESSION['error'];}
 ?>
 
 </div>
 </div>
 <br><br><br>
<center>© eddu</center>
 </body>
</html>

