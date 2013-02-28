<?php

function dump($Msg, $Binary) {
		echo $Msg . ":";
		$Len = strlen($Binary);
		for ($i = 0; $i < $Len; $i = $i + 1) {
			echo ord($Binary[$i]) . " ";
		}
		echo "\n";
}

//$key = "key";
//$str = "stri\nng1234567890123456789012345678901234567890";
$str = "DELETE\n\n\n\nx-amz-date:Tue, 27 Mar 2007 21:20:26 +0000\n/johnsmith/photos/puppy.jpg";
$key = "uV3F3YluFJax1cknvbcGwgjvx4QpvB+leU8dUj2o";
echo "key " . $key . "\n";
echo "str "  . $str . "\n";
$hash  = mhash(MHASH_SHA1, $str, $key);
dump("hash ", $hash);
echo "hash " . $hash . "\n";
$bin = base64_encode($hash);
dump("bin ", $bin);
echo "bin " . $bin . "\n";
?>
