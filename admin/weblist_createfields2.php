<?php

//prevent URL direct access - start
session_start();
if(isset($_SESSION['id'])){

include_once('include/connect.php');

$name = $_POST['name'];
$type = $_POST['type'];
$value = $_POST['value'];
$weblist = $_POST['weblist'];

$sql = mysql_query("INSERT INTO weblist_field VALUES ('','".$name."','".$type."','".$value."','".$weblist."')");

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