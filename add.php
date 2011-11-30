<?php

$label = "Add";
$term_id=0;
$term=null;


if (!current_user_can(mlv::$adminCapability))
	wp_die( __( 'Cheatin&#8217; uh?' ) );


print "
<div class='wrap'>
<h2>$label Video</h2><br>";

global $wpdb;


if($term_id==0)
{

	if ($_POST[mlv_title] && $_GET[mode]!="pca") {
		
		$title = mlv::cleanQuery(($_POST[mlv_title]));
		$embedCode = mlv::cleanQuery(($_POST[mlv_embedCode]));
		if($title&&$title!=''&&$embedCode&&$embedCode!='')
		{
			
			//Script to insert into db
			$date = date("Y-m-d G:i:s");
			$script = "
				INSERT INTO ". $wpdb->prefix . "posts
				(
					`post_author`,
					`post_date`,
					`post_date_gmt`,
					`post_content`,
					`post_title`,
					`post_excerpt`,
					`post_status`,
					`comment_status`,
					`ping_status`,
					`post_password`,
					`post_name`,
					`to_ping`,
					`pinged`,
					`post_modified`,
					`post_modified_gmt`,
					`post_content_filtered`,
					`post_parent`,
					`guid`,
					`menu_order`,
					`post_type`,
					`post_mime_type`,
					`comment_count`
				)
				VALUES
				(
					1	
					,'".$date."'	
					,'".$date."'
					,'$embedCode'	
					,'$title'	
					,''		
					,'inherit'	
					,'open'	
					,'open'	
					,''
					,'".sanitize_title(iz-overtherainbow)."'		
					,''			
					,''			
					,'".$date."'	
					,'".$date."'		
					,''			
					,0	
					,'http://www.youtube.com/embed/$embedCode'
					,0	
					,'attachment'	
					,'video/x-flv'	
					,0
				);

			";
			//'$mlv_base/youtube.jpg'	
			//print $script;
			$wpdb->query($script);
	
		
			print "<div class='highlight'>Successful Addition</div> <!--meta http-equiv='refresh' content='0'-->"; //header("location:$_SERVER[HTTP_REFERER]");
		
		}
		else
		{
			print "<div class='highlight'>ALL FIELDS ARE REQUIRED!</div><br><br>";
		
		}
		
	}
	else
	{
		print "<div class='highlight'>All fields are required.</div><br><br>";

	}
}



	
$base=get_option('siteurl');

print "


<table cellpadding='10px' cellspacing='0' style='width:100%' class='manual_add_table'><tr>
<td style='/*border-right:solid silver 1px;*/ padding-top:0px;' valign='top'>

<form name='manualAddForm' method=post>
	<table cellpadding='0' class='widefat'>
	<tr>
		<td>
		
			Title*<br><input name='mlv_title' size=40 ><br>
			Youtube Key*:<br><input name='mlv_embedCode' size=40 >
			<br><br>
			<input type='submit' value='$label Video' class='button'> 
			<a href=\"/wp-admin/upload.php\" class=\"button\">Cancel</a>
		
		</td>
	</tr>
	</table>
</form>

</td>
<td style='/*border-right:solid silver 1px;*/ padding-top:0px;' valign='top'>
</td>
<td valign='top' style='padding-top:0px;'>
</td>
</tr>
</table>
</div>";
?>


<?php

?>