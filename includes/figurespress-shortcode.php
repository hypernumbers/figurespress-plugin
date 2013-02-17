<?php

// add the shortcode handler to available shortcodes
add_shortcode ( 'fp', array ( 'fp_gg_shortcode', 'shortcode') );

// this is the callback class that will be used on rendering the page
class fp_gg_shortcode {
      function shortcode( $atts, $content = null ) {
      	       extract ( shortcode_atts ( array ( 'url'    => '', 
      	       									  'cells'  => '',
      	       									  'width'  => '', 
      	       									  'height' => '' ), 
      	       							  $atts ) );
	       if (empty($url)) return '<!--No fp Url -->';

	       $fp_gg_h = "width:600px;";
	       $fp_gg_w = "height:800px;";
	       $fp_gg_resizeFlag = "";

	       if ( !empty ( $height ) ) {
	         $fp_gg_h = "height:$height;";
                 $fp_gg_resizeFlag = "hn_dont_resize";
	       }

	       if ( !empty ( $fp_gg_width ) ) {
	         $fp_gg_w = "width:$width;";
			 $fp_gg_resizeFlag = "hn_dont_resize";
	       }

	       // concatenate the strings
	       // $style = "border:0;display:none;" . $h . $w;
	       $fp_gg_style = "border:0;" . $fp_gg_h . $fp_gg_w;

	       // add the custom javascript and css
	       fp_gg_load_css_and_javascript();

	       // now return the html
	       $fp_gg_page = utf8_uri_encode(get_permalink());
	       $fp_gg_name = uniqid();
	       $fp_gg_iframe = "<iframe id='$fp_gg_name' "
	       . "class='hn_wordpress $fp_gg_resizeFlag' "
	       . "style='$fp_gg_style' "
	       . "src='$url$cells#wordpress!$fp_gg_page!$fp_gg_name'>"
	       . "</iframe>";
	       return $fp_gg_iframe;
	       }
}

// we need to load customer js and css - this function will be called to do it
// when the shortcode is rendered
function fp_gg_load_css_and_javascript() {

 	 # CSS first
	 wp_register_style('fp.wordpress.css', FP_PLUGIN_URL . 'css/fp.wordpress.css');
	 wp_enqueue_style('fp.wordpress.css');

	 # Now JS
	 wp_register_script('fp.wordpress.js', FP_PLUGIN_URL . 'js/fp.wordpress.js', false, "", true);
	 wp_enqueue_script('fp.wordpress.js');
	 wp_register_script('jquery.ba-postmessage.js', FP_PLUGIN_URL . 'js/jquery.ba-postmessage.js', false, "", true);
	 wp_enqueue_script('jquery.ba-postmessage.js');
}

?>