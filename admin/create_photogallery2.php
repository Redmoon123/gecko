<?php
	session_start();
	require_once("include/connect.php");

	
	if(isset($_SESSION['id'])){
		switch($_GET['process']){
		
			case "save":
				$gname = $gecko->securepost('galleryname');
				$gdir  = $gecko->securepost('galleryoption');
				if($gname !=="" && $gdir !==""){
					$take = $gecko->gallerySave($gname,$gdir,"",'save');
				
				}else{
					die("your trying to access probihited area buzz off");
					
				}
			break;
			case "viewdetails":
				if($_REQUEST['gid']!==""){;
					$view = $gecko->gallery_viewdetails($_REQUEST['gid']);
					$fetch = $gecko->fetch($view);
					if($fetch !==""){
						echo "Gallery Name <span id='viewsname'>".$fetch['galleryname']."</span>";
						echo "<br />Directory Choosen <br /><img src='images/folder.png' alt='test' /><span id='viewsname'>".$fetch['directory']."</span>";
					}
				}else{
					echo "what the fuck your trying to hack something?!!";	
				}
			break;
			
			case "update":
				$gid = $gecko->securepost('gid');
				$gname = $gecko->securepost('galleryname');
				$gdir  = $gecko->securepost('galleryoption');
				
				$gecko->galleryUpdate($gname,$gdir,$gid);
			
			break;
			
			case "del":
				$gallerids = implode(",",$gecko->securepost('deletegal'));
				
				if($gallerids !==""){
					echo $gecko->geckoDelete("gallery","id IN (".$gallerids.")");
				}
			break;
		}
	}else{
		echo "hackers never wins";
	}
?>