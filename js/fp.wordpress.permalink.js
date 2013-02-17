jQuery(document).ready(function() {
	var permalinkfn, postid, vixo, input;
	input  = jQuery("#hn_open_spreadsheet");
	postid = jQuery(input).attr("data-postid");
	vixo   = jQuery(input).attr("data-href");
	// only enable the Spreadsheet button once there is a permalink
	permalinkfn = function () {

		// force a WordPress autosave to make sure the 
		// permalink is written
		autosave();

		var openfn;
		jQuery(input).removeAttr('disabled');
		
		// open the spreadsheet page
		openfn = function () {
			var type, wpurl, dataType, success;
			type     = "POST";
			wpurl    = "./admin-ajax/?action=vixo_get_sample_permalink&id=" + postid;
			dataType = "json";
			success = function (data) {
				var vixourl = vixo + data.path + "?view=spreadsheet";
				window.open(vixourl, "_vixo");
			};
			jQuery.ajax({
				"type"     : type,
				"url"      : wpurl,
				"dataType" : dataType,
				"success"  : success
			});
		};
		jQuery(input).click(openfn);
	};
	jQuery("#titlewrap").change(permalinkfn);
});