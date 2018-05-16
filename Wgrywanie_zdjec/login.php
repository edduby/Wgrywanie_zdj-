<?php
session_start();

if((null==($_POST['login']))||(null==($_POST['password'])))
{
	header('Location: index.php');
	exit();	
}

require_once "connect.php"; //tutaj zatrzyma
//lub include to pojdzie dalej
//@ wyciszanie komunikatow mysql
$connect = @new mysqli($host,$db_user,$db_password,$db_name);
if($connect->connect_errno!=0)
{
	echo "Error:".$connect->connect_errno."Info".$connect->connect_error;
	
}
else
{

$login=$_POST['login'];
$password=$_POST['password'];
$login = htmlentities($login, ENT_QUOTES, "UFT-8");


$sql= "SELECT* FROM photo WHERE login='$login'";

	if($result = @$connect->query(sprintf("SELECT* FROM photo WHERE login='%s' ",
	mysqli_real_escape_string($connect,$login))))
	{
	$how_meny = $result->num_rows;
	
	if($how_meny>0)
	{
		$table = $result->fetch_assoc();
		echo "ddsdssddsds".$table['password'];
		if (md5($password)==$table['password'])
		{
		$_SESSION['logged']=true;
		$_SESSION['id']=$table['id'];
		$_SESSION['user']=$table['login'];
		$_SESSION['role']=$table['role'];
		unset($_SESSION['error']);	
		$result->close();

if($_SESSION['role'] == 'admin'){
	header('Location: photoadmin.php');
} 
else {
	header('Location: photo.php');
}	

		}	
		else{
		$_SESSION['error']='<span style="color:red">Wrong password or logoin2!</span>';
		header('Location: index.php');
		}
			
	}
	else
	{
		$_SESSION['error']='<span style="color:red">Wrong password or logoin!</span>';
		header('Location: index.php');
		
	}	
	}

$connect->close();
}
?>
