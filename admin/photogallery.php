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
include_once("include/loadjQuery.php");
 ?>	
 	<?php
	// load content slide effects
	include_once("include/slide_effects.php");
	?>

	</head>
	<body>
	
	<div id="jalert1" title="gecko" style="display:none;">Are you sure you want to delete?</div>
	<div id="jalert2" title="gecko" style="display:none;">Fail!</div>
	<div id="jalert3" title="View Gallery Details" style="display:none;">Select at least one item to delete</div>

		<h1 id="head"><a style="color:#FFFFFF;text-decoration:none;" href="/admin/dashboard.php">Gecko</a></h1>

		<?php require_once("include/menu.php"); ?>
		
		<div id="content" class="container_16 clearfix">
			<div class="grid_11">
				<h2 style="padding-left:22px;" style="padding-left:22px;">PhotoGallery</h2>
				
				<table id="jtable">
					<thead>
						<tr>
							<th style="width:22px;"><input type="checkbox" name="chkall" id="chkall" style="width:auto!important;" /></th>
							<th>Name</th>
							<th>Photo Directory</th>
						</tr>
					</thead>
					<tbody>
						<?php
					
							require_once("include/connect.php");
							
							$each = $gecko->gallery_list();
							if($each !==""){
								foreach($each as $eachmore){
								extract($eachmore);
						?>
						
							<tr>
								<td><input type="checkbox" name="chckgallery[]" class="photolist" value="<?php echo $id;?>" class="chckgallery" style="width:auto!important;" /></td>
								<td><span style="color:green;font-weight:bold;"><?php echo "<a href=\"create_photogallery.php?gstatus=update&getID=$id\" class=\"gallerydataEdit\">".$galleryname."</a>";?></span></td>
								<td><span><?=$directory;?></span></td>
							</tr>

						<?php
								}
							}
						?>
						
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="Dirdelete" id="Dirdelete" value="delete" /></td>
						</tr>
					</tbody>
				</table>
					<p class="debug_info" style="display:none;"></p>	
			</div>
			
				<div class="grid_5">
				<h2 style="padding-left: 35px;">Action</h2>
				<ul>
					<li><a href="/admin/create_photogallery.php?gstatus=add">Create Gallery</a></li>
					<li><a href="/admin/dashboard.php">Dashboard</a></li>
				</ul>
				</div>
			
			
		</div>
		
		<div id="foot">
					<a href="/admin/logout.php">Logout</a>
		</div>

				<script type="text/javascript" src="js/galleryfunctions.js"></script>
	</body>
</html>
<?php
//prevent URL direct access - end
}else{
echo "<div style='color:red'>FUCK YOU KA!</div>";
}
?>