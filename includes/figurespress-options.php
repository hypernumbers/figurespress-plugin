<?php

// register some settings
add_action ( 'admin_init', 'gg_fp_register_settings_fn');

// add the admin menus
add_action ( 'admin_menu', 'gg_fp_add_admin_page_fn' );

function gg_fp_register_settings_fn () {
	
	// register the settings for the plugin
	register_setting ( 'gg_fp_settings',
					   'gg_fp_spreadsheet_site',
					   'gg_fp_validate_options_fn' );

	register_setting ( 'gg_fp_settings',
					   'gg_fp_secret',
					   'gg_fp_validate_secret_fn' );

	register_setting ( 'gg_fp_settings',
					   'gg_fp_time_drift',
					   'gg_fp_validate_time_drift_fn' );

	add_settings_section ( 'gg_fp_main', 
					   	   'FiguresPress Settings',
					   	   'gg_fp_section_text_fn',
						   'figurespress-plugin' );

	add_settings_field( 'gg_fp_text_string',
						'Enter url of Vixo site',
						'gg_fp_settings_input_fn',
						'figurespress-plugin',
						'gg_fp_main' );

	add_settings_field( 'gg_fp_secret_string',
						'Enter shared secret (emailed to you)',
						'gg_fp_secret_input_fn',
						'figurespress-plugin',
						'gg_fp_main' );

	add_settings_field( 'gg_fp_time_drift_integer',
						'Allowable time drift for single-signon (15 mins/900 seconds)',
						'gg_fp_time_drift_fn',
						'figurespress-plugin',
						'gg_fp_main' );

}

function gg_fp_add_admin_page_fn ( ) {

	add_options_page( 'FiguresPress',  
					  'FiguresPress', 
					  'manage_options', 
					  'figurespress-plugin', 
					  'gg_fp_options_page_fn' );

}

function gg_fp_options_page_fn () {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2>FiguresPress</h2>
		<form action='options.php' method='post'>
			<?php settings_fields ( 'gg_fp_settings' );
			do_settings_fields ( 'gg_fp_settings', 'gg_fp_main' );
			do_settings_sections ( 'figurespress-plugin' );
			submit_button ( );
			?>
		</form>
	</div>
	<?php
}

function gg_fp_section_text_fn () {
	$gg_fp_txt1 = '<p>'
				  . __('Please give the URL of the Vixo site 
					    that you are putting underneath this 
					    WordPress site, eg', 'figurespress-plugin')
	    		  . ' <code>http://example.com</code></p>'
	    		  .'<p>'
	    		  . __('You must save your changes')
	      		  . '</p>'
	      		  . '<p style="color:red;font-weight:bold;">'
	      		  . __ ('Fix so it only works with permalinks' )
	      		  . '</p>';

	if ( ! gg_fp_has_prettylinks () ) {
    	$gg_fp_txt2 = "<span style='color:red;font-weight:bold;'>"
    	              . __( "FiguresPress plugin "
    	              . "requires prettylinks" )
    	              . "</span>";
    }  else {
    	$gg_fp_txt2 = '';
    }
    _e( $gg_fp_txt1 . $gg_fp_txt2 );
}

function gg_fp_settings_input_fn () {
	$gg_fp_options = get_option ( 'gg_fp_spreadsheet_site' );
	echo "<input id='gg_fp_text' 
		  class='regular-text ltr'
		  name='gg_fp_spreadsheet_site'
		  type='text'
	  	  value='{$gg_fp_options}'
	  	  />";
}	

function gg_fp_secret_input_fn () {
	$gg_fp_options = get_option ( 'gg_fp_secret' );
	echo "<input id='gg_fp_secret_text' 
		  class='regular-text ltr'
		  name='gg_fp_secret'
		  type='text'
	  	  value='{$gg_fp_options}'
	  	  />";
}	

function gg_fp_time_drift_fn () {
	$gg_fp_options = get_option ( 'gg_fp_time_drift' );
	echo "<input id='gg_fp_time_drift' 
		  class='regular-text ltr'
		  name='gg_fp_time_drift'
		  type='text'
	  	  value='{$gg_fp_options}'
	  	  />";
}	


function gg_fp_validate_options_fn ( $input ) {
    // check this is a valid url
    $gg_fp_cleanurl  = filter_var ( $input, FILTER_VALIDATE_URL );
    $gg_fp_tokens = parse_url ( $gg_fp_cleanurl );
    if ( $gg_fp_tokens['scheme'] === "http" || 
         $gg_fp_tokens['scheme'] === "https" ) {
    	$gg_fp_site = $gg_fp_tokens['scheme'] 
    					. '://' . $gg_fp_tokens['host'];
    	if ( array_key_exists ('port', $gg_fp_tokens ) ) {
   			$gg_fp_site = $gg_fp_site . ":" 
   							. strval ( $gg_fp_tokens['port'] );
    	} 
	} else {
    	$gg_fp_site = '';
    }
    return $gg_fp_site ;
}

function gg_fp_validate_secret_fn($input) {
	return $input;
}

function gg_fp_validate_time_drift_fn($input) {
	return $input;
}


?>