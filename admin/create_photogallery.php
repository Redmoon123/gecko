<?php
//prevent URL direct access - start

session_start();
if(isset($_SESSION['id'])){
$photogeneric = 2012;
	
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
			require_once("include/loadjQuery.php");
		 ?>	
		<script type="text/javascript" src="js/geckoLightbox/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/geckoLightbox/sexylightbox.v2.3.jquery.min.js"></script>
		<link rel="stylesheet" href="js/geckoLightbox/sexylightbox.css" type="text/css" media="all" />
		<script type="text/javascript">
			$(document).ready(function(){
				SexyLightbox.initialize({color:'white', dir: 'js/geckoLightbox/sexyimages'});
			});
		</script>
	</head>
	<body>
		<h1 id="head"><a style="color:#FFFFFF;text-decoration:none;" href="/admin/dashboard.php">Gecko</a></h1>
		<?php require_once("include/menu.php"); ?>
		
		<div id="content" class="container_16 clearfix">
			<div class="grid_11" style="width: 746px !important;">
		<?php 	
			require_once("include/connect.php");
			
			if(isset($_GET['gstatus'])){
			switch($_GET['gstatus']){
				default:
				case "add":
		?>
			<h1>Create Galleries</h1>
				
				<table id="add_listGallery">
					<tr>
						<td colspan="2">Create New Gallery</td>
					</tr>
					<tr>
						<td colspan="2">Name of Gallery</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="gallery" id="admin-galleryname" />
						</td>
					</tr>
					<tr>	
						<td>
							
							<select id="admin-optionGallery">
								<option value="">SELECT DIRECTORY</option>
									<?php echo 	$gecko->SelectOptionGallery();?>
							</select>
						</td>
					</tr>
					<tr>	
						<td colspan="2">
							<input type="checkbox" checked="true" id="gallerystatus" name="gallerystatus" style="width:10px"> Enable ?
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Save" name="savegallery" onclick="javascript:SaveGallery();">
						</td>
					</tr>
				</table>

		<?
			break;
			case "update":
				
					$getID = $gecko->secureget('getID');
					$listgallery = $gecko->gallery_viewdetails($getID);
					$showlist = $gecko->fetch($listgallery);
					
		?>			
					<h1>Update Galleries</h1>
					<p class="updated" style="display:none;">Successfully Updated</p>
					<table id="add_listGallery">
					<tr>
						<td colspan="2">Create New Gallery</td>
					</tr>
					<tr>
						<td colspan="2">Name of Gallery</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="text" name="gallery" id="admin-galleryname" value="<?=$showlist['galleryname'];?>" />
						</td>
					</tr>
					<tr>	
						<td>
				
							<select id="admin-optionGallery">
								<option value="">SELECT DIRECTORY</option>
									<?php echo 	$gecko->SelectOptionGallery($showlist['directory']);?>
							</select>
						</td>
					</tr>
					<tr>	
						<td colspan="2">
							<input type="checkbox" checked="true" id="gallerystatus" name="gallerystatus" style="width:10px"> Enable ? 
							<strong id="copytext">{gecko_gallery_<?php echo $photogeneric.$getID;?>}</strong>
							
						</td>
					</tr>
					
				
					<tr>
						<td>
							<input type="submit" value="Update" name="saveupdate" onclick="javascript:updateGallery(<?=$getID?>);">
						</td>
					</tr>
				</table>
		<?		

			break;
			
			}
			}
		?>		
				
			</div>
			
				<div class="grid_5" style="width:164px !important;">
				<h2 style="padding-left: 35px;">Action</h2>
				<ul>
					<li><a href="/admin/create_photogallery.aspx?gstatus=add">Create a Gallery</a></li>
					<li><a href="/admin/photogallery.aspx">Dashboard</a></li>
				</ul>
			</div>
			
			
		</div>
		
		<div id="foot">
			<a href="/admin/logout.php">Logout</a>
		</div>
		
		<div id="jalert3" style="display:none;" title="Gallery Required Fields">we do not allow empty data</div>
		<script type="text/javascript" src="js/galleryfunctions.js"></script>
		
	</body>
</html>
<?php
//prevent URL direct access - end
}else{
echo "<div style='color:red'>FUCK YOU KA!</div>";
}
?>