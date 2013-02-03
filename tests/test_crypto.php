<?php

function dump($Msg, $Binary) {
		echo $Msg . ":";
		$Len = strlen($Binary);
		for ($i = 0; $i < $Len; $i = $i + 1) {
			echo ord($Binary[$i]) . " ";
		}
		echo "\n";
	}

function extend($Binary) {
	$Blocksize = 16;
	$Len = strlen($Binary);
	echo "Len is " . $Len . "\n";
	$Pad = $Blocksize - (($Len + 2) % $Blocksize);
	echo "Padding plain text with:" . $Pad . "\n";
	$Binary .= str_repeat(chr(0), $Pad);
	return $Pad . " " . $Binary;
}

$Key  = "abcdefghabcdefgh";
$IV   = "12345678abcdefgh";
$Text = "Now is the winter of our discontent made glorious summer by this son of York, ya bas...";

$KeySize  = strlen($Key) * 8;
$IVSize   = strlen($IV) * 8;
$TextSize = strlen($Text) * 8;

$PaddedText = extend($Text);

$PaddedSize = strlen($PaddedText) * 8;

$IVSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "IVSze     is " . $IVSize . " bytes or " . $IVSize * 8 . " bits\n";

$BlockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "BlockSize is " . $BlockSize . " bytes or " . $IVSize * 8 . " bits\n";

$Crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $Key, $Text, 'ncfb', $IV);

$UnCrypt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $Key, $Crypt, 'ncfb', $IV);

echo "Key         is " . $Key        . " with size " . $KeySize  . "\n";
echo "IV          is " . $IV         . " with size " . $IVSize   . "\n";
echo "Text        is " . $Text       . " with size " . $TextSize . "\n";
echo "PaddedText  is " . $PaddedText . " with size " . $PaddedSize . "\n";
echo "Crypt       is " . $Crypt  . "\n";
dump("Crypt", $Crypt);
echo "Decrypt is " . $UnCrypt . "\n";
dump("Decrypt", $UnCrypt);
?>