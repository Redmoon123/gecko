<ul id="navigation">
			<li><span><a href="/admin/webpage.php">Web Pages</a></span></li>
			<li><a href="/admin/template.php">Templates</a></li>
			<li><a href="/admin/menu.php">Menu</a></li>
			<li><a href="/admin/photogallery.php">PhotoGalleries</a></li>
			<li><a href="/admin/create_weblist.php">Web list</a></li>
		</ul>
		<script type="text/javascript">
		jQuery(document).ready(function(){
		
			var page = window.location.pathname;
			
			if(page=='/admin/webpage.php'||page=='/admin/create_webpage.php'||page=='/admin/update_webpage.php'){
			jQuery("#navigation a").eq(0).addClass("active");
			}
			
			if(page=='/admin/template.php'||page=='/admin/create_template.php'||page=='/admin/update_template.php'){
			jQuery("#navigation a").eq(1).addClass("active");
			}
			
			
			if(page=='/admin/menu.php'||page=='/admin/create_menu.php'||page=='/admin/update_menu.php'||page=='/admin/update_menu_item.php'){
			jQuery("#navigation a").eq(2).addClass("active");
			}
			
			if(page=='/admin/photogallery.php'||page=='/admin/create_photogallery.php'){
			jQuery("#navigation a").eq(3).addClass("active");
			}
			
			if(page=='/admin/create_weblist.php'||page=='/admin/weblist_createfields.php'){
			jQuery("#navigation a").eq(4).addClass("active");
			}
		
		
		});
		</script>