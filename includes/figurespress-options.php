<?php

// register some settings

add_action ( 'admin_init', 'gg_fp_register_settings_fn');

function gg_fp_register_settings_fn () {
	
	// register the settings for the plugin
	register_setting ( 'gg_fp_settings',
					   'gg_fp_spreadsheet_site',
					   'gg_fp_validate_options_fn' );

	add_settings_section ( 'gg_fp_main', 
					   	   'FiguresPress Settings',
					   	   'gg_fp_section_text_fn',
						   'figurespress-plugin' );

	add_settings_field( 'gg_fp_text_string',
						'Enter url of Vixo site',
						'gg_fp_settings_input_fn',
						'figurespress-plugin',
						'gg_fp_main' );

}

add_action ( 'admin_menu', 'gg_fp_add_admin_page_fn' );

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
	_e ( '<p>' . __('Please give the URL of the Vixo site that you are putting underneath this WordPress 
	      site, eg', 'figurespress-plugin') .
	      ' <code>http://example.com</code></p>' .
	      '<p>' . __('You must save your changes', 'figurespress-plugin') . '</p>');
}

function gg_fp_settings_input_fn () {
	$options = get_option ( 'gg_fp_spreadsheet_site' );
	echo "<input id='gg_fp_text' 
		  name='gg_fp_spreadsheet_site'
		  type='text'
	  	  value='{$options}'
	  	  />";
}	

function gg_fp_validate_options_fn ( $input ) {
    // check this is a valid url
    $clean = array ();
    $clean['clean']  = esc_url( $input );
    $url    = filter_var ( $clean['clean'], FILTER_VALIDATE_URL );
    $tokens = parse_url ( $url );
    if ( $tokens['scheme'] === "http" || 
    	 $tokens['scheme'] === "https" ) {
    	$site = $tokens['scheme'] . "://" . $tokens['host'];
    	if ( array_key_exists ( 'port', $tokens ) ) {
    		debug_logger ( "there is a port..." );
    		debug_logger ( $clean['port'] );
    		$site = $site . ":" . strval ( $tokens['port'] );
    	}
    } else {
    	$site = '';
    }
	debug_logger ( $tokens );
	debug_logger ( $site );
	return $site ;
}

?>