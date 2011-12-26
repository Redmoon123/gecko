/*
*	Powered By : Gecko
*	Of the developer Author	: Christopher Cuizon
*	gmail	: christophercuizons@gmail.com
*	This framework is brought to us by gecko any copyrights of this framework is probihited
*	We don't have the liability if your website is broken this is only our free service	
*	Use it at your own risk!!!.
* 	If you like this library and want to thank me, send me some ca$h :D
* 	or you can email me your thoughts.
*/	

	function AjaxGallery($gname,$gselect){
		jQuery.post('create_photogallery2.aspx?process=save',{galleryname:$gname,galleryoption:$gselect},function(response){
			if(response !==""){
				redirect("create_photogallery.aspx?gstatus=update&getID="+response);
			}
		});	
	}
	
	function AjaxGalleryUpdate($gname,$gselect,$id){
		jQuery.post('create_photogallery2.aspx?process=update',{galleryname:$gname,galleryoption:$gselect,gid:$id},function(response){
		jQuery(".updated").slideToggle('slow').delay(3000).fadeOut('slow');
			if(response !==""){
				
				/* redirect("create_photogallery.aspx?gstatus=update&getID="+response); */
			}
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
		/* jQuery("#add_listGallery").fadeOut('slow'); */
		}
	}
	
	function updateGallery($id){
	
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
			AjaxGalleryUpdate(GGalleryname,GGdirectory,$id);
		/*	jQuery("#add_listGallery").fadeOut('slow'); */
		}
	
	
	}
	
	function AjaxDeleteGallery($id){
		jQuery.post("create_photogallery2.aspx?process=del",{"deletegal":$id},function(text){
			if(text == 1){
				jQuery(".debug_info").html("successfully delete").fadeIn('slow').delay(2000).hide('slow');
			}else{
				jQuery(".debug_info").html('Sorry there seems to be a problem try refreshing the content');
			}
		});
	}
	
	function editGallery(){
		jQuery(".gallerydata").live('click',function(e){
				e.preventDefault();
				var filtersplitid = jQuery(this).attr('href').split('gid=');
					var gallerypost = jQuery.post("create_photogallery2.aspx?process=viewdetails",{gid:filtersplitid[1]},function(data){
						jQuery("#jalert3").html(data);
						jQuery("#jalert3")
						.dialog({
							autoOpen: false,
							show: "drop",
							hide: "drop"
						});
						jQuery("#jalert3").dialog("open");
						return false;
					});
		});
	}
	
	function DeleteGalleryDirectory(){
		jQuery("input[id^='Dirdelete']").live('click',function(){
			var counterdata = new Array();
			var counterflow = 0;
				jQuery("input[name='chckgallery[]']:checked").each(function(){
						counterdata[counterflow] = jQuery(this).val();
						counterflow++;
						jQuery(this).parent().parent().hide('slow',function(){
							jQuery(this).remove();
						});
				});
			if(counterflow){
				AjaxDeleteGallery(counterdata);
			}
		});
	}
	
	function gallery_checkall(){
		jQuery("input[name='chkall']").live('click',function(){
			var check = jQuery(this).is(":checked");
				if(check == true){
					jQuery("input@[name='chckgallery[]']").attr("checked","true");
				}else{
				jQuery("input@[name='chckgallery[]']").removeAttr("checked");
			}
		});
	}
	
	
	jQuery(function(){
		editGallery();
		DeleteGalleryDirectory();
		gallery_checkall();
	});