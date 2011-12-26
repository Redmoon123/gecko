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
	
	
		// instantiate CKEditor, pass arguments = id,attr(comma separated),path
echo $gecko->load_CKEditor("jcontent","height:400");
	?>
 <script type="text/javascript">
jQuery(document).ready(function(){


		
			var wi_id;
			var wi_id2;

			jQuery("#name").blur(function(){	
			
				var name = jQuery("#name").val();
				if(name){
			
					jQuery.post("/admin/create_weblist_item2.php",{ name:name, wi_id:wi_id }, function(data){
					
						if(data=='fail'){
							alert('Fail');
					
						}else{
						wi_id = data;
				
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
			
			
			
			
			
			jQuery("#template").blur(function(){
				
				var template= jQuery("#template").val();
				
				if(template){
			
					jQuery.post("/admin/create_weblist_item2.php",{ template:template, wi_id:wi_id }, function(data){
					
						if(data=='fail'){
							alert('Fail');
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
			
			
			
			
			
			jQuery("#jcontent").blur(function(){
			
				var jcontent = CKEDITOR.instances.jcontent.getData();
			
			
				if(name){
			
					jQuery.post("/admin/create_weblist_item2.php",{ jcontent:jcontent, wi_id:wi_id }, function(data){
					
						if(data=='fail'){
							alert('Fail');
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
			
			
			
	
			jQuery(".wval").blur(function(){
			
			
				var wval = jQuery(this).val();
				var wf = jQuery(this).attr("alt");
			
				
				
			
			
				if(wval){
			
					jQuery.post("/admin/create_weblist_item2.php",{ wval:wval, wf:wf, wi_id2:wi_id2 }, function(data){
					
						if(data=='fail'){
							alert('Fail');
					
						}else if(data=='success'){
							wi_id2 = null;
						}else{
							wi_id2 = data;
					
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
	
		<div id="jalert1" title="gecko" style="display:none;">Cannot submit Empty fields</div>
		


		<h1 id="head"><a style="color:#FFFFFF;text-decoration:none;" href="/admin/dashboard.php">Gecko</a></h1>

		<?php require_once("include/menu.php"); ?>
		
		<div id="content" class="container_16 clearfix">
			<div class="grid_11" style="width: 746px !important;">

			<h1>Create Web List Item</h1>
			

<table>
<tr><td>Weblist Item Name</td><td><input type="text" name="name" id="name" class="wval2"  style="width: 234px" /></td></tr>
<tr><td>template</td>
<td>
<?php

include_once('include/connect.php');

$sql2 = mysql_query("SELECT * FROM template");



?>
<select name="template" id="template" class="wval2" style="width: auto;">
<option>no template</option>
<option value="-1">use default template</option>
<?php
while($row2=mysql_fetch_array($sql2)){
?>
<option value="<?=$row2['id']?>"><?=$row2['name']?></option>
<?php } ?>
</select>
</td>
</tr>
<tr><td colspan="2">Custom Fields:</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<?php

require_once("include/connect.php");

$sql = mysql_query("SELECT * FROM weblist_field WHERE weblist =1");
$wf = array();
$ctr = 1;
while($row=mysql_fetch_array($sql)){
	switch($row['type']){
	case '1':
		$prev = "<td>".$row['name']."</td><td><input type='text' class='wval' name='wval' alt='".$row['id']."' /></td>";
		break;
	case '2':
		$prev = "<td>".$row['name']."</td><td><textarea class='wval' name='wval' alt='".$row['id']."'></textarea></td>";
		break;
	case '3':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<option>".$val."</option>";
		}
		$prev = "<td>".$row['name']."</td><td><select style='width: auto;' class='wval' name='wval' alt='".$row['id']."'>".$y."</select></td>";
		break;
	case '4':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<input type='checkbox' style='width:auto!important;' class='wval' name='wval' alt='".$row['id']."' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	case '5':
		$x = explode(",",$row['option']);
		foreach($x as $val){
			$y.= "<input type='radio' style='width:auto!important;' class='wval' name='wval' alt='".$row['id']."' /> ".$val."<br />";
		}
		$prev = "<td>".$row['name']."</td><td>".$y."</td>";
		break;
	case '7':
		$prev = "<td>".$row['name']."</td><td><input type='text' id='jdatepicker' class='wval' name='wval' alt='".$row['id']."' /></td>";
		break;		
	}
	
	
	echo "<tr>".$prev."</tr>";
	$y = "";
	
	$ctr++;
	

}




?>
<tr><td>content</td><td><textarea id="jcontent" name="content" class="wval2"></textarea></td></tr>
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