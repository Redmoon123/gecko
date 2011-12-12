<?php
#	Author : Christopher Cuizon
#	Codename : Bogary the master of Dota undefeated Champion oh yeah world greatest dota player
#	Powered by: Gecko 
	class Objectdir{
	
	var $gfields;
	var $geckorows;
		
		function list_directory($dir){
			$source = $dir;
			$open 	= @opendir($source);
			$counter = array();
			if(is_dir($source)==1){
				if($open !==""){
					while(false !== ($each = @readdir($open))){
						if($each == '.' || $each == '..'){
						
						}else{
							$counter[] =  $each;
						}
					}
					closedir($open);
					return $counter;
				}
			}else{
				return false;
			}
		}
		
		function getAttributeExtension($file){
			$args = explode(".",$file);
			$takeextention =  $args[count($args) - 1];
			return $takeextention;
		}
		
		function filterFirstGallery($dir){
			$takedir = $dir;
			$getdirectory = @scandir($dir);
			$getcounter = array();
		
				foreach($getdirectory as $val){
					if($val =="." || $val == ".."){
						
					}else if($this->getAttributeExtension($val) == "jpg" || $this->getAttributeExtension($val) == "gif" || $this->getAttributeExtension($val) == "png"){
						$getcounter[] = $val;	
					}
				}
			return $getcounter;
		}
		
		function say(){
			echo "were connected...";
		}
		
		function securepost($str){
			return (isset($_POST[$str])) ? $_POST[$str]:'';
		}
		
		function photoGalleries($dir,$viewpgs=4,$numberofpagi=4){
			$getVal = 0;
			if(isset($_GET['pg'])){
				$gets = intval($_GET['pg'])-1;
				$getVal = $gets * 4;
			}else{
				$getVal = 0;
			}
				$getClean = $this->filterFirstGallery($dir);
				$getCount = intval(count($getClean)/$numberofpagi);
	
				$getScan = array_slice($getClean,$getVal,$numberofpagi);
			
				foreach($getScan as $eachtarget){
					$getsource = $dir." /".$eachtarget;
					echo "<a href=\"{$getsource}\" rel=\"sexylightbox\" title=\"\" >";
					echo "<img src='".$getsource."' style=\"width:100px;height:100px;border:1px solid pink;\">";
					echo "</a>";
				}
				
				for($i = 1;$i < $getCount+1; $i++){
					echo "<a href=\"?pg={$i}\">".$i."</a>";
				}
		}

		function SelectOptionGallery(){
			$theroot = $_SERVER['DOCUMENT_ROOT'];
			$scandir = scandir($theroot);
			$args = array("jpg","gif","png","JPG","txt","PNG","BMP","js","php","htaccess","git","admin","ckeditor","db");
			foreach($scandir as $each){
				if($each =="." || $each ==".." || in_array($this->getAttributeExtension($each),$args)){
				
				}else{  
					echo "<option value=\"$each\">".$each."</option>";
				}
			}
		}
		
		function galleryFields($args,$fields){
			$this->gfields[] = $args."='".$fields."'";
		}
		

		function gettable($tbl){
			$sql = "INSERT $tbl SET ".implode(",",$this->gfields);;
			$res = $this->query($sql);
			return $res;
		}
		
		function therows(){
			return $this->geckorows;
		}
		
		function gallerySave($name,$dir,$status=""){
			$this->galleryFields('galleryname',mysql_escape_string($name));
			$this->galleryFields('directory',mysql_escape_string($dir));
			if($status !==""){
				$this->galleryFields('gallery_status',mysql_escape_string($status));
			}
			$this->gettable('gallery');
		}
		
		function query($str){
			$data = mysql_query($str)or die(mysql_error());
			$geckorows = @mysql_num_rows($data);
			return $data;
		}
		
		function gallerymany($str){
			$args = array();
			while($row = mysql_fetch_array($str)){
				$args[] = $row;	
			}	
			return $args;
		}
	
		function gallery_list(){
		$args = array();
			$sql = "SELECT * from gallery";
			$res = mysql_query($sql)or die(mysql_error());
			if(@mysql_num_rows($res)>0){
				while($rows = mysql_fetch_array($res)){
					$args[] = $rows;
				}
			}
			return $args;
		}
		
		function fetch($fetch){
			$rows = mysql_fetch_array($fetch);
			return $rows;	
		}
		
		function gallery_viewdetails($id){
			$args = "SELECT * from gallery where id=".$id;
			$res = $this->query($args);
			return $res;
		}
	}
	
	
	