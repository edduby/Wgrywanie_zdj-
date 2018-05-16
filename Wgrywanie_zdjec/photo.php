 <?php
 session_start();

 
 
 if((null==($_SESSION['logged'])))
 {
	 header('Location: index.php');
	 exit();
	 
 }
 ?>

<!DOCTYPE HTML>
<html>
 <head>
 <meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome,firefox=1" />
<link href="arkusz.css" rel="stylesheet" type="text/css">
 <title>Admin Panel</title>
 </head>
 <body>
 <?php
if(isset($_SESSION['e_login']))
{
	echo'<div class="error">'.$_SESSION['e_login'].'</div>';
	unset($_SESSION['e_login']);
}

?>
Wybierz zdjecie i wyslij:(zdjecie nie moze miec w nazwie znakow specjalnych max rozmiar 5,12MB)<br/>

<form enctype="multipart/form-data" action="file.php" 
		 method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="5120000" />
<input type="file" name="plik"/><br/>
<input type="submit" value="wyślij" />



<br/><br/><br/>
<br/><br/><br/>

 <?php
 echo '[<a href="logout.php">Logout!</a>]';
 echo "<p>Witaj ".$_SESSION['user']."! ";
  echo "Rola: ".$_SESSION['role'];
    echo '<br><br>Zdjecia dostepne w Twoim folderze:<br>';
  foreach(glob('foto/'.$_SESSION['user'].'/*', GLOB_BRACE) as $file) {  echo 'http://zdjecia-nst3.za.pl/'.$file.' <br>';
  echo '<img src="http://zdjecia-nst3.za.pl/'.$file.'" width="50px" height="50px"><br><br>';}
 
 ?>
</form>
 </body>
</html>
