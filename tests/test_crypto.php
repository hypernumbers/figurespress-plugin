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
	$First = round($Len / 256);
	$Second = $Len % 256;
	$Pad = $Blocksize - (($Len + 2) % $Blocksize);
	echo "Padding plain text with:" . $Pad . "\n";
	$Binary .= str_repeat(chr(0), $Pad);
	return chr($First). chr($Second) . $Binary;
}

function unpad($Binary) {
	$First = $Binary[0];
	$Second = $Binary[1];
	echo "First is "  . $First . " and Second is " . $Second . "\n";
	$Length = ord($First) * 256 + ord($Second);
	echo "Length is " . $Length . "\n"; 
	return substr($Binary, 2, $Length);
}

$Key  = "abcdefghabcdefgh";
$IV   = "12345678abcdefgh";
$Text = "Now is the winter of our discontent made glorious summer by this son of York, ya bas...The quality of mercy is not strained but falleth as the dew from heaven. Now is the time for all good men to come to the aid of the party, I tell you, so it is big man, so it is...";

$KeySize  = strlen($Key) * 8;
$IVSize   = strlen($IV) * 8;
$TextSize = strlen($Text) * 8;

$PaddedText = extend($Text);

$PaddedSize = strlen($PaddedText) * 8;

$IVSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "IVSze     is " . $IVSize . " bytes or " . $IVSize * 8 . " bits\n";

$BlockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "BlockSize is " . $BlockSize . " bytes or " . $IVSize * 8 . " bits\n";

$Crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $Key, $PaddedText, 'ncfb', $IV);

$Decrypt = unpad(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $Key, $Crypt, 'ncfb', $IV));

echo "Key         is " . $Key        . " with size " . $KeySize  . "\n";
echo "IV          is " . $IV         . " with size " . $IVSize   . "\n";
echo "Text        is " . $Text       . " with size " . $TextSize . "\n";
dump("Text", $Text);
echo "PaddedText  is " . $PaddedText . " with size " . $PaddedSize . "\n";
dump("PaddedText", $PaddedText);
echo "Crypt       is " . $Crypt  . "\n";
dump("Crypt", $Crypt);
echo "Decrypt is " . $Decrypt . "\n";
dump("Decrypt", $Decrypt);
?>