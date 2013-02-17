<?php

function gg_fp_has_prettylinks () {
	$gg_fp_has_pretty_links = get_option('permalink_structure');
	if ($gg_fp_has_pretty_links === '') {
		return false;
	} else {
		return true;
	}
}

function gg_fp_get_path ($id) {
	$get_sample_permalink = get_sample_permalink($id);
	$url = str_replace("%postname%", $get_sample_permalink[1], $get_sample_permalink[0]);
	$tokens = parse_url($url);
	return array('path'=>$tokens['path']);
}
?>