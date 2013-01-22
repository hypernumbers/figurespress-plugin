<?php

// add a button to open up the spreadsheet in editing mode
add_action ( 'media_buttons_context', 
	'gg_fp_add_open_spreadsheet_button_fn' );

// add a button to the visual editor to select a bit of the spreadsheet
// to insert into the page

add_action ( 'init', 'gg_fp_add_insert_spreadsheet_button_fn' );

// add a custom button to the rich text editor
add_filter( 'tiny_mce_version', 'gg_fp_refresh_mce_fn');

function gg_fp_get_vixo_url_fn () {
	// now build the spreadsheet page to open
	$gg_fp_spreadsheet_site = get_option('gg_fp_spreadsheet_site');

	$gg_fp_tokens = parse_url ( get_permalink ( ));
	$gg_fp_url = $gg_fp_spreadsheet_site 
	 			 . $gg_fp_tokens['path'];
	return $gg_fp_url;
}

function gg_fp_add_open_spreadsheet_button_fn( $context ) {
	 debug_logger ("adding open spreadsheet button...");
	// Check permissions
	if ( (! current_user_can('edit_posts') )
		&& ( ! current_user_can('edit_pages') )
		|| ! gg_fp_has_prettylinks () ) {
    	return $context .= "<span style='color:red;font-weight:bold;'>"
    	 . _("FiguresPress plugin requires prettylinks")
    	 . "</span>";
    }

	// append the icon if the plugin is configured
	$gg_fp_spreadsheet_site = get_option('gg_fp_spreadsheet_site');

	if ($gg_fp_spreadsheet_site !== '') {
		// icon
		$gg_fp_icon = plugins_url ( 'images/spreadsheet.png', 
	 								 dirname ( __FILE__ ) );
		// title
		$gg_fp_title = __( 'Insert Spreadsheet' );
		// url
		$gg_fp_url = gg_fp_get_vixo_url_fn () ;

		// now the hidden field for the editor to know the url
		// the spreadsheet is bound to
		$gg_fp_span = "<span id='gg_fp_insertss_tinymce'  style='display:none;'>" 
					. $gg_fp_url
					. "</span>";

		$context .= "<a title='{$gg_fp_title}' "
				. "href='" . $gg_fp_url . "?view=spreadsheet' " 
	 			. "target='_vixo' class='button'>"
		 	    . "<img src='{$gg_fp_icon}' />" 
		 	    . __( 'Open Spreadsheet' ) 
		 	    . "</a>"
		 	    . $gg_fp_span;
	} else {
		$context .= '';
	}	 
	return $context;
}

// add the TinyMCE button is mostly taken from this tutorial
// http://wp.tutsplus.com/tutorials/theme-development/wordpress-shortcodes-the-right-way/

function gg_fp_add_insert_spreadsheet_button_fn () {

	// Check permissions

	if ( (! current_user_can('edit_posts') )
		&& ( ! current_user_can('edit_pages') )
		|| ! gg_fp_has_prettylinks () ) {
    	return;
    }

    if ( get_user_option ( 'rich_editing' ) == 'true' ) {
     	add_filter ( 'mce_external_plugins', 'gg_fp_add_ss_tinymce_plugin_fn' );
     	add_filter ( 'mce_buttons', 'gg_fp_register_ss_button_fn' );
   }

}

function gg_fp_register_ss_button_fn($buttons) {

	array_push($buttons, "|", "insertss");
	return $buttons;

}

function gg_fp_add_ss_tinymce_plugin_fn($plugin_array) {

	// get the path of the javascript
	$gg_fp_js = plugins_url ( 'js/figurespress.tinymce-editor.plugin.js', 
	 							 dirname ( __FILE__ ) );

	$plugin_array['insertss'] = get_bloginfo('template_url')
	. $gg_fp_js;
	return $plugin_array;

}

function gg_fp_refresh_mce_fn($ver) {

  $ver += 3;
  return $ver;

}

?>