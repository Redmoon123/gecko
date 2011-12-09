<?php
//prevent URL direct access - start
session_start();
if(isset($_SESSION['id'])){

$weblist = $_GET['weblist'];

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



			
	
			
	
			jQuery("#fadd").click(function(){
			
			
				var name= jQuery("#fname").val();
				var type= jQuery("#ftype").val();
				var value= jQuery("#fvalue").val();
			
				
			

			
			
				if(name){
			
					jQuery.post("/admin/weblist_createfields2.php",{ name:name, type:type, value:value, weblist:<?=$weblist?> }, function(data){
					
						if(data=='fail'){
							alert('Fail');
						}else{
					
						jQuery("#jalert2").dialog({
												autoOpen: false,
												show: "blind",
												hide: "explode",
												close: function(){
												window.location="/admin/weblist_createfields.php?weblist=<?=$weblist?>";
												}
											});
						jQuery("#jalert2").dialog("open");
						
					
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
			
			
			// show/hide value script on weblist fields
			jQuery("#ftype").change(function(){
			
			var x = jQuery(this).val();
			
			if(x=="dropdown"||x=="radio"||x=="checkbox"){
				jQuery("#trfval").fadeIn();
			}else{
				jQuery("#trfval").fadeOut();
			}
			
			});
			
			

		
		
		

	

});
</script>
	</head>
	<body>
	
		<div id="jalert1" title="gecko" style="display:none;">Please enter web list name</div>
		<div id="jalert2" title="gecko" style="display:none;">New Field has been saved!</div>


		<h1 id="head"><a style="color:#FFFFFF;text-decoration:none;" href="/admin/dashboard.php">Gecko</a></h1>

		<?php require_once("include/menu.php"); ?>
		
		<div id="content" class="container_16 clearfix">
			<div class="grid_11" style="width: 746px !important;">

			<h1>Create Web List</h1>
			

<table>
<tr><td>fields</td>
<td>type: 
<select name="ftype" id="ftype" style="width:auto;">
<option value="string">String</option>
<option value="texarea">Textarea</option>
<option value="dropdown">Dropdown</option>
<option value="checkbox">Checkbox</option>
<option value="radio">Radio</option>
<option value="image">Image</option>
<option value="date">Date</option>
</select>
</td></tr>
<tr><td>&nbsp;</td><td>Name: <input type="text" name="fname" id="fname" style="width: 234px" /></td></tr>
<tr id="trfval" style="display:none;"><td>&nbsp;</td><td>Value: <input type="text" name="fvalue" id="fvalue" style="width: 191px;" /></td></tr>
<tr><td>items</td>
<td>
<table style="width:auto">
<?php

include_once('include/connect.php');

$sql = mysql_query("SELECT * FROM weblist_field WHERE weblist='".$weblist."'");
while($row=mysql_fetch_array($sql)){

switch($row['type']){
	case 'dropdown':
		$x = explode(",",$row['value']);
		foreach($x as $val){
			$y.= "<option>".$val."</option>";
		}
		$prev = "<td>".$row['name']."</td><td><select style='width: auto;'>".$y."</select></td>";
		break;
	case 'checkbox':
		$x = explode(",",$row['value']);
		foreach($x as $val){
			$y.= "<input type='checkbox' style='width:auto!important;' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	case 'radio':
		$x = explode(",",$row['value']);
		foreach($x as $val){
			$y.= "<input type='radio' style='width:auto!important;' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	default:
		$prev = "<td>".$row['name']."(".$row['type'].")</td>";
	}

	echo "<tr>".$prev."</tr>";
	$y = "";

}



?>
</table>
</td>
</tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td>&nbsp;</td><td><input type="submit" name="fadd" id="fadd" value="add" /></td></tr>
</table>

			
			</div>
			
				<div class="grid_5" style="width:164px !important;">
				<h2 style="padding-left: 35px;">Action</h2>
				<ul>
					<li><a href="/admin/menu.php">Create Web List</a></li>
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