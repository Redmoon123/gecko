<?php
//prevent URL direct access - start
session_start();
if(isset($_SESSION['id'])){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Gecko</title>
		<link rel="stylesheet" href="css/960.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/template.css" type="text/css" media="screen" charset="utf-8" />
		<link rel="stylesheet" href="css/colour.css" type="text/css" media="screen" charset="utf-8" />
		<style type="text/css">
		#navigation a{
		text-decoration:none;
		}
		
		</style>
		<?php 
// load jQuery
include_once('include/loadjQuery.php');
 ?>
	<?php
	// load content slide effects
	include_once("include/slide_effects.php");
	?>
 <script type="text/javascript">
jQuery(document).ready(function(){



			
	
			
	
			jQuery("#save").click(function(){
			
			
				var name= jQuery("#name").val();
				var template= jQuery("#template").val();
			
				
			

			
			
				if(name){
			
					jQuery.post("/admin/create_weblist2.php",{ name:name, template:template }, function(data){
					
						if(data=='fail'){
							alert('Fail');
						}else{
								window.location="/admin/weblist_createfields.php?weblist="+data+"&frm_crt=1";
						}
					
					});
					
					
				}else{
				
				
					jQuery("#jalert1").dialog({
												autoOpen: false,
												show: "blind",
												hide: "explode"
											});
					jQuery("#jalert1").dialog("open");
		
				
		
				}
					
			
			});
			
			
		
		
		
		

	

});
</script>
	</head>
	<body>
	
		<div id="jalert1" title="gecko" style="display:none;">Please enter web list name</div>


		<h1 id="head"><a style="color:#FFFFFF;text-decoration:none;" href="/admin/dashboard.php">Gecko</a></h1>

		<?php require_once("include/menu.php"); ?>
		
		<div id="content" class="container_16 clearfix">
			<div class="grid_11" style="width: 746px !important;">

			<h1>Create Web List Item</h1>
			

<table>
<tr><td>Weblist Item Name</td><td><input type="text" name="name" id="name" style="width: 234px" /></td></tr>
<tr><td colspan="2">custom fields</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<?php

require_once("include/connect.php");

$sql = mysql_query("SELECT * FROM weblist_field WHERE weblist =1");
while($row=mysql_fetch_array($sql)){
	switch($row['type']){
	case '1':
		$prev = "<td>".$row['name']."</td><td><input type='text' /></td>";
		break;
	case '2':
		$prev = "<td>".$row['name']."</td><td><textarea></textarea></td>";
		break;
	case '3':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<option>".$val."</option>";
		}
		$prev = "<td>".$row['name']."</td><td><select style='width: auto;'>".$y."</select></td>";
		break;
	case '4':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<input type='checkbox' style='width:auto!important;' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	case '5':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<input type='radio' style='width:auto!important;' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	case '6':
		$prev = "<td>".$row['name']."</td><td><input type='text' /></td>";
		break;
	case '7':
		$prev = "<td>".$row['name']."</td><td><input type='text' /></td>";
		break;		
	}
	
	
	echo "<tr>".$prev."</tr>";
	$y = "";
	
}
?>
<tr><td>&nbsp;</td><td><input type="submit" name="save" id="save" value="save" /></td></tr>
</table>

			
			</div>
			
				<div class="grid_5" style="width:164px !important;">
				<h2 style="padding-left: 35px;">Action</h2>
				<ul>
					<li><a href="/admin/create_weblist.php">Create Web List</a></li>
					<li><a href="/admin/create_weblist_item.php">Create Web List Item</a></li>
					<li><a href="/admin/dashboard.php">Dashboard</a></li>
				</ul>
			</div>
			
			
		</div>
		
		<div id="foot">
					<a href="/admin/logout.php">Logout</a>
		</div>

		
	</body>
</html>
<?php
//prevent URL direct access - end
}else{
echo "<div style='color:red'>FUCK YOU KA!</div>";
}
?>