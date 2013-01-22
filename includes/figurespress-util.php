<?php

function gg_fp_has_prettylinks () {
	$gg_fp_has_pretty_links = get_option('permalink_structure');
	if ($gg_fp_has_pretty_links === '') {
		return false;
	} else {
		return true;
	}
}

?>