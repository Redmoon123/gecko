<?php

//prevent URL direct access - start
session_start();
if(isset($_SESSION['id'])){

include_once('include/connect.php');



$wi_id = $_POST['wi_id'];
$wi_id2 = $_POST['wi_id2'];

$name = $_POST['name'];
$jcontent = $_POST['jcontent'];
$template = $_POST['template'];

$wval = $_POST['wval'];
$wf = $_POST['wf'];

if($name){


	if($wi_id){
	
	$sql = mysql_query("UPDATE weblist_item SET name='".$name."' WHERE id='".$wi_id."'");

		if($sql){
		echo $wi_id;
		}else{
		echo "fail";
		}	
		
	}else{
	
	
		$sql = mysql_query("INSERT INTO weblist_item VALUES('','".$name."','','')");

		if($sql){
		echo mysql_insert_id();
		}else{
		echo "fail";
		}	
	
	
		
	
	}
	
	}else if($template){
	
	$sql = mysql_query("UPDATE weblist_item SET template='".$template."' WHERE id='".$wi_id ."'");
	if($sql){
	echo 'success';
	}else{
	echo "fail";
	}	
	
	}else if($jcontent){
	
	$sql = mysql_query("UPDATE weblist_item SET content='".$content."' WHERE id='".$wi_id ."'");
	if($sql){
	echo 'success';
	}else{
	echo "fail";
	}	
	
	}else{
	
			if($wi_id2){
			
			
			$sql2 = mysql_query("SELECT * FROM weblist_value WHERE id='".$wi_id2."'");
	
		
		if(mysql_num_rows($sql2)==0){
		
		
					$sql = mysql_query("INSERT INTO weblist_value VALUES('','1','".$wf."','".$wval."')");
		
					if($sql){
						echo mysql_insert_id();
					}else{
						echo "fail";
					}	

				
		
		}else{
		
			$sql = mysql_query("UPDATE weblist_value SET value='".$wval."' WHERE id='".$wi_id2."'");
		
			if($sql){
				echo "success";
			}else{
				echo "fail";
			}
		
		}
		
			
		
		}else{
		

		
		
		$sql = mysql_query("INSERT INTO weblist_value VALUES('','1','".$wf."','".$wval."')");
		
		if($sql){
		echo mysql_insert_id();
		}else{
		echo "fail";

		}	
		
		}
	
	}



//prevent URL direct access - end
}else{
echo "<div style='color:red'>FUCK YOU KA!</div>";
}


?>
