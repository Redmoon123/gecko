<?php

//prevent URL direct access - start
session_start();
if(isset($_SESSION['id'])){

include_once('include/connect.php');

$name = $_POST['name'];
$template = $_POST['template'];

$sql = mysql_query("INSERT INTO weblist VALUES ('','".$name."','".$template."')");

if($sql){
	echo mysql_insert_id();
}else{
	echo "fail";
}

//prevent URL direct access - end
}else{
echo "<div style='color:red'>FUCK YOU KA!</div>";
}

?>