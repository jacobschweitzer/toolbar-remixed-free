<?php
/*
Plugin Name: Toolbar Remixed - Free
Plugin URI: http://siteguru.biz/toolbar-remixed
Description: Control and Enhance the WordPress Toolbar.
Version: 1.0
Author: Jacob Schweitzer
Author URI: http://ijas.me/
License: GPL2
*/

add_filter( 'show_admin_bar', '__return_true' , 1000 );
// Load Options Page
add_action('admin_menu', 'toolbar_remixed_actions');
function toolbar_remixed_actions() {
	add_options_page("Toolbar Remixed Free", "Toolbar Remixed Free", 'manage_options', "ToolbarRemixedFree", "toolbar_remixed_free_admin");
}

		
	
// Options Page Function 	
function toolbar_remixed_free_admin() {
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$tr_options = get_option("toolbar_remixed_option");
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'jquery-ui-button');
	wp_register_style('tr_admin_options_style', plugins_url('toolbar-remixed/css/divtoolbar_remixed_admin_options/jquery-ui-1.10.1.custom.min.css')  );
	wp_enqueue_style('tr_admin_options_style');
?>
<script type="text/javascript">
		jQuery(document).ready( function($) {
			$("#tr_on").button();
			$("#btn-group-wp").buttonset();
			$("#btn-group-colors").buttonset();
			
			$("form#toolbar_remixed_options_form input#make_colors_black").click( function() {
				$('form#toolbar_remixed_options_form input#tr_colors_font').attr('value','#ffffff');
				$('form#toolbar_remixed_options_form input#tr_colors_font').parent().prev("a.wp-color-result").css('background-color','#ffffff');
				
				$('form#toolbar_remixed_options_form input#tr_colors_primary').val('#464646');
				$('form#toolbar_remixed_options_form input#tr_colors_primary').parent().prev("a.wp-color-result").css('background-color','#464646');
				
				$('form#toolbar_remixed_options_form input#tr_colors_secondary').val('#373737');
				$('form#toolbar_remixed_options_form input#tr_colors_secondary').parent().prev("a.wp-color-result").css('background-color','#373737');
				
				$('form#toolbar_remixed_options_form input#tr_colors_border').val('#000000');
				$('form#toolbar_remixed_options_form input#tr_colors_border').parent().prev("a.wp-color-result").css('background-color','#000000');

				$('div.tr_color_box').hide();
				$("input#tr_theme").val('black');
				return false;
			});
			
			
			$("form#toolbar_remixed_options_form input#make_colors_blue").click( function() {
				$('form#toolbar_remixed_options_form input#tr_colors_font').attr('value','#f9f9f9');
				$('form#toolbar_remixed_options_form input#tr_colors_font').parent().prev("a.wp-color-result").css('background-color','#f9f9f9');
				
				$('form#toolbar_remixed_options_form input#tr_colors_primary').val('#21759B');
				$('form#toolbar_remixed_options_form input#tr_colors_primary').parent().prev("a.wp-color-result").css('background-color','#21759B');
				
				$('form#toolbar_remixed_options_form input#tr_colors_secondary').val('#1b607f');
				$('form#toolbar_remixed_options_form input#tr_colors_secondary').parent().prev("a.wp-color-result").css('background-color','#1b607f');
				
				$('form#toolbar_remixed_options_form input#tr_colors_border').val('#2480a9');
				$('form#toolbar_remixed_options_form input#tr_colors_border').parent().prev("a.wp-color-result").css('background-color','#2480a9');

				$('div.tr_color_box').hide();
				$("input#tr_theme").val('blue');	
				return false;
			});
			$('div.tr_color_box').hide();
		});
    </script>
<style type="text/css">
.ui-icon { 
	display:inline-block !important;
}
#toolbar_remixed_admin_options label {
	padding: 6px; 
}
<?php 
echo <<<EOD
</style>
	<h1>Toolbar Remixed Admin</h1>
	<div id="toolbar_remixed_admin_options">
	<form id="toolbar_remixed_options_form" class="toolbar_remixed_options_form_class">
		<label for="tr_on">Toolbar Remixed Javascript and Style is ON?</label>
		<input type="checkbox" name="tr_on" id="tr_on" 
EOD;
		if ( $tr_options['tr_on'] == "on" ) {
			echo 'checked="checked"';
		}
echo "/>";
echo "<div style='display:none'>";
print_r($tr_options);
echo "</div>";

echo <<<EOD
<br />
<h3>Change The Toolbar Colors</h3>
<div id="btn-group-colors">
<input type="radio" id="make_colors_black" name="make_colors" class="button-secondary"
EOD;
if ( $tr_options['tr_theme'] == 'black' ) {
echo 'checked="checked"';
}
echo <<<EOD
/><label for="make_colors_black">Black</label><input type="radio" id="make_colors_blue" name="make_colors" class="button-secondary" 
EOD;
if ( $tr_options['tr_theme'] == 'blue' ) {
echo 'checked="checked"';
}
echo '/><label for="make_colors_blue">Blue</label>';
echo '<input type="radio" id="make_colors_grey" name="make_colors" class="button-secondary"'; 		
if ( $tr_options['tr_theme'] == 'grey' ) {
echo 'checked="checked"';
}
echo <<<EOD
</div>
	<input type="hidden" id="tr_theme" name="tr_theme" value="{$tr_options['tr_theme']}" /> 
		<br/>
		
EOD;
		$tr_colors = array(
		'tr_colors_font' => $tr_options['tr_colors_font'],
		'tr_colors_primary' => $tr_options['tr_colors_primary'],
		'tr_colors_secondary' => $tr_options['tr_colors_secondary'],
);

foreach ( $tr_colors as $one_color_key => $one_color_value ) {
$color_nice_name = ucfirst( str_replace('tr_colors_','',$one_color_key) );
?>
			<div class="tr_color_box" style="display:inline-block;width:30%;height:350px;">
			<p style="margin:0;"><label for="<?php echo $one_color_key; ?>"><?php 
			echo '<h3 style="margin:0">'.$color_nice_name.'</h3>'; 
			if ( $color_nice_name == 'Font' ) {
				echo '<p style="margin:0;">- Text, Arrows, Font Shadow</p>';
			}
			if ( $color_nice_name == 'Primary' ) {
				echo '<p style="margin:0;">- Main Color, Hover on Sub-Menu Items</p>';
			}
			if ( $color_nice_name == 'Secondary' ) {
				echo '<p style="margin:0;">- Borders, Hover on First Level Menu</p>';
			}
			?></label><br/>
			<input type="text" id="<?php echo $one_color_key; ?>" name="<?php echo $one_color_key; ?>" class="my-color-field" value="<?php echo $one_color_value ?>" data-default-color="<?php echo $one_color_value ?>" />
			</div>				
<?php } ?>
<br/>
<h3>Wordpress Defaults (Check to Hide)</h3>
<div id="btn-group-wp">
<?php
	$menu_array = array('my-sites','wp-logo','comments','new-content','edit','updates','search','site-name');	
	foreach ( $menu_array as $one_menu ) {
		$menu_nice_name = str_replace( '-', ' ', $one_menu );
		$menu_nice_name = ucwords( $menu_nice_name );
		echo <<<EOD
<label for="trwp_$one_menu">$menu_nice_name</label><input type="checkbox" name="trwp_$one_menu" id="trwp_$one_menu" 
EOD;
		if ( $tr_options['trwp_'.$one_menu] == "on" ) {
			echo 'checked="checked"';
		}
		echo '/ >';
	}

echo '</div>';	

	echo "<h4>BuddyPress</h4>";
	if ( is_plugin_active('buddypress/bp-loader.php') ) {
		$bp_components= array('activity','blogs','friends','groups','messages','settings','xprofile');
		
		foreach ( $bp_components as $bp_component ) { 
		echo '<label for="hide_my-account-'.$bp_component.'">'.ucfirst($bp_component).'</label>';
		echo '<input type="checkbox" name="hide_my-account-'.$bp_component.'" id="hide_my-account-'.$bp_component.'"';
		if ( $tr_options['hide_my-account-'.$bp_component] == "on" ) {
			echo 'checked="checked"';
		}
		echo '/>';
		}	
	}
	
	echo'</div>';
	
	echo '<h3>Change Howdy, UserName to Whatever You Want</h3>';
	echo '<label for="howdy">Howdy Text</label><input type="text" name="howdy" id="howdy" value="'.$tr_options["howdy"].'" />';
	echo '<p>Note: If you still want to put in the username, type   <b>##username##</b>  wherever you want it to appear';
	echo '<p>Example Howdy Text:    <b>Yo, ##username## </b> </p>';
	echo '<p>To go back to the default just remove any text you put in and save the options again.</p>';
echo <<<EOD
	<br />
	<input type="hidden" id="action" name="action" value="toolbar_remixed_ajax_save">
	<input type="submit" value="Save Options + Refresh" id="submit" class="button-primary">		
	</form>
	</div> 
	<div id="toolbar_remixed_change_result">
		<span></span>
	</div>
	<script type="text/javascript">		
		jQuery(document).ready(function($) {
			$("form#toolbar_remixed_options_form input#submit").click(function(){
				$("div#toolbar_remixed_change_result span").replaceWith("<br/><h3>Saving Options.....</h3>");
				var data = $(this).parent("form").serialize();
				$.post(ajaxurl, data, function(response) {
					$("div#toolbar_remixed_change_result span").replaceWith("<span>"+response+"</span>");
					$("div#toolbar_remixed_change_result span").contents().fadeOut(5000);
					 window.location.reload();
				 });	
			return false;
			}); 
		});
	</script>
EOD;

}
// end of toolbar_remixed_admin

// AJAX Function to Save Options
add_action('wp_ajax_toolbar_remixed_ajax_save', 'toolbar_remixed_ajax_save');
function toolbar_remixed_ajax_save() {
	$data = $_POST;
	unset($data['action']);
	update_option("toolbar_remixed_option", $data);
	echo '<p style="font-size:24px;color:#00FF00;">Options Updated.. Refreshing the page.. Please Wait.. </p>';
	// print_r($_POST);
	die();
}

// Main Loader for scripts and styles
add_action('init','toolbar_remixed_loader',100);
function toolbar_remixed_loader() {
	$tr_options = get_option("toolbar_remixed_option");
if ( $tr_options['tr_on'] == 'on' ) {
	wp_enqueue_script( 'jquery' );
	wp_dequeue_script('admin-bar');
	wp_dequeue_style('admin-bar');
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active('blue-admin-bar/blue-admin-bar.php') ) {
		wp_dequeue_style('blue-admin-bar');
	}
	if ( is_plugin_active('buddypress/bp-loader.php') ) {
		wp_dequeue_style('bp-admin-bar');
	}
	// Load the admin bar in the header 
	remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 );
	remove_action( 'admin_footer', 'wp_admin_bar_render', 1000 );
	add_action( 'wp_head', 'wp_admin_bar_render', 1000 );
	add_action( 'admin_head', 'wp_admin_bar_render', 1000 );
	wp_register_style('tr_style_structure',plugins_url('/toolbar-remixed').'/css/Toolbar-Remixed-Structure.css');
	wp_enqueue_style('tr_style_structure');
}
}




add_action('wp_head','toolbar_onclick');
add_action('admin_head','toolbar_onclick');
function toolbar_onclick() {
	$tr_options = get_option("toolbar_remixed_option");
	if ( $tr_options['tr_on'] == 'on' ) {
		$menu_interaction_type = 'mouseenter';
		wp_register_script('toolbar-remixed-hover',plugins_url('/toolbar-remixed').'/js/toolbar-remixed-hover.js');
		wp_enqueue_script('toolbar-remixed-hover');
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		if ( $tr_options['tr_colors_font'] == '#f9f9f9' &&  $tr_options['tr_colors_primary'] == '#21759B' && $tr_options['tr_colors_secondary'] == '#1b607f' ) {
			wp_register_style('tr_style_blue',plugins_url('/toolbar-remixed').'/css/Toolbar-Remixed-Blue.css');
			wp_enqueue_style('tr_style_blue');
			$style = "blue";
		}
		if ( $tr_options['tr_colors_font'] == '#ffffff' &&  $tr_options['tr_colors_primary'] == '#464646' && $tr_options['tr_colors_secondary'] == '#373737' ) {
			wp_register_style('tr_style_black',plugins_url('/toolbar-remixed').'/css/Toolbar-Remixed-Black.css');
			wp_enqueue_style('tr_style_black');
			$style = "black";
		}
	} // end of it tr_on is on
}





add_action( 'wp_before_admin_bar_render', 'tr_load_menus',900 );
function tr_load_menus()
{
	global $wp_admin_bar;
	$tr_options = get_option("toolbar_remixed_option");
	if ( $tr_options != '' ) {
		$menu_array = array();
		foreach ($tr_options as $k => $v) {
			$first_five = substr($k, 0, 5);	
			if ( $first_five == "trwp_" ) {
				if ( $v == "on" ) {
					$menu_title = substr($k,5);
					$wp_admin_bar->remove_menu($menu_title);
				}
			}
			if ( $first_five == "hide_" ) {
				$plugin_to_hide = substr($k,5);
				$wp_admin_bar->remove_menu($plugin_to_hide);
			}
		}
	}
	
	if ( $tr_options['howdy'] != ''  ) {
		$user_id      = get_current_user_id();
		if ( $user_id ) {
			$current_user = wp_get_current_user();
			$profile_url  = get_edit_profile_url( $user_id );
			
			$avatar = get_avatar( $user_id, 16 );
			//$howdy  = $current_user->display_name;
			
			$howdy = $tr_options['howdy'];
			
			$howdy = str_replace('##username##',$current_user->display_name,$howdy);
			$class  = empty( $avatar ) ? '' : 'with-avatar';
			
			$wp_admin_bar->add_menu( array(
					'id'        => 'my-account',
					'parent'    => 'top-secondary',
					'title'     => $howdy . $avatar,
					'href'      => $profile_url,
					'meta'      => array(
							'class'     => $class,
							'title'     => __('My Account'),
					),
			) );
		}
	}
	
} // END of function tr_load_menus

?>