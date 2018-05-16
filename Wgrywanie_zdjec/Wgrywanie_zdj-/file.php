
<?php
//tworzymy folder jezeli nie ma dalej zdjecie 
session_start(); 
if (!file_exists('./foto/'.$_SESSION['user'])){
$dir = './foto/'.$_SESSION['user'];
$oldmask = umask(0);
mkdir($dir, 0777);
umask($oldmask);
 }

$oldmask = umask(0);
mkdir("test", 0777);

$dir = "./foto/test";
mkdir($dir, 0777);
umask($oldmask);
   
   
   
$max_rozmiar = 4096*4096;
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
    if ($_FILES['plik']['size'] > $max_rozmiar) {
        echo 'Blad! Plik jest za duży!';
    } else {
        echo 'Odebrano plik. Poczatkowa nazwa: '.$_FILES['plik']['name'];
        echo '<br/>';
        if (null!=($_FILES['plik']['type'])) {
            echo 'Typ: '.$_FILES['plik']['type'].'<br/>';
        }
        move_uploaded_file($_FILES['plik']['tmp_name'],
                './foto/'.$_SESSION['user'].'/'.$_FILES['plik']['name']);
				echo "Zdjecie znajduje sie na: http://zdjecia-nst3.za.pl".'/foto/'.$_SESSION['user'].'/'.$_FILES['plik']['name'].'<br>';
				echo '<input type="text" value="[IMG]http://zdjecia-nst3.za.pl/foto/'.$_SESSION['user'].'/'.$_FILES['plik']['name'].'[/IMG]'.'" name="box" size="100" readonly="readonly" />';
    }
} else {
   echo 'Blad przy przesylaniu danych!';
}

?> 
<br>
<br>
 <?php
 echo '[<a href="photo.php">Dodaj kolejne zdjecie</a>]';
 echo '[<a href="logout.php">Logout!</a>]';
 echo "<p>Hello ".$_SESSION['user']."! ";
 echo "Role: ".$_SESSION['role'];
?>


<?php
echo "Typ pliku:";
echo $_FILES['plik']['type'].'<br/>';


echo "Rozmiar:";
echo $_FILES['plik']['size'].'<br/>';


echo "Nazwa pliku:";
echo $_FILES['plik']['name'].'<br/>';


echo "Nazwa tymczasowa:";
echo $_FILES['plik']['tmp_name'].'<br/>';


echo "Ewentualne bledy:";
echo $_FILES['plik']['error'].'<br/>';

echo '<img src="http://zdjecia-nst3.za.pl/foto/'.$_SESSION['user'].'/'.$_FILES['plik']['name'].'">';
?>