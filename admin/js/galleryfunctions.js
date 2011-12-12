	function AjaxGallery($gname,$gselect){
		jQuery.post('create_photogallery2.php?process=save',{galleryname:$gname,galleryoption:$gselect},function(response){
			alert(response);
		});	
	}
	
	function redirect($url){
		return window.location.href=$url;
	}
	
	function SaveGallery(){
		var GGalleryname = jQuery("input[id^='admin-galleryname']").val();
		var GGdirectory  = jQuery("select#admin-optionGallery option:selected").val();
		if(GGalleryname =="" || GGdirectory ==""){
		
				jQuery("#jalert3")
					.dialog({
						autoOpen: false,
						show: "drop",
						hide: "drop"
					});
				jQuery("#jalert3").dialog("open");
		}else{
			AjaxGallery(GGalleryname,GGdirectory);
		//k	jQuery("#add_listGallery").fadeOut('slow');
		}
	}
	
	function editGallery(){
		jQuery(".gallerydata").live('click',function(e){
				e.preventDefault();
				var filtersplitid = jQuery(this).attr('href').split('gid=');
					var gallerypost = jQuery.post("create_photogallery2.php?process=viewdetails",{gid:filtersplitid[1]},function(data){
						jQuery("#jalert3").html(data);
						jQuery("#jalert3")
						.dialog({
						autoOpen: false,
						show: "drop",
						hide: "drop"
						});
						jQuery("#jalert3").dialog("open");
						
					});
		});
	}
	
	jQuery(function(){
	
		editGallery();
	});