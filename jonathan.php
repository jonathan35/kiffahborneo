
<?php
session_start();

ini_set("error_log", "/kiffah.log");

$_SESSION['validation'] = 'YES';


if($_SESSION['validation']=='YES'){
    echo 'pass';
}else{
	echo 'not pass';
}
?>