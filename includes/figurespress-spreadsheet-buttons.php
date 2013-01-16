<?php

add_action ( 'media_buttons_context', 'gg_fp_add_spreadsheet_button' );

function gg_fp_add_spreadsheet_button( $context ) {
	 
	 // icon
	 $gg_fp_icon = plugins_url ( 'images/spreadsheet.png', 
	 							 dirname ( __FILE__ ) );

	 // title
	 $gg_fp_title = 'Insert Spreadsheet';

	 // append the icon
	 $context .= "<a title='{$gg_fp_title}' href='http://hypernumbers.dev:9000/some/page/' target='_vixo' class='button'>
		 	     <img src='{$gg_fp_icon}' /> Open Spreadsheet</a>";
	 
	 return $context;
}
?>