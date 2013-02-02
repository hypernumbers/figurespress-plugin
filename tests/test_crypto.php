<?php

function dump($String, $Bin) {
echo $String . " is " . ord($Bin[0]) . " " . ord($Bin[1]) . " " . ord($Bin[2]) . " " . ord($Bin[3]) . " " . ord($Bin[4]) . " " . ord($Bin[5]) . " " . ord($Bin[6]) . " " . ord($Bin[7]) . " " . ord($Bin[8]) . " " . ord($Bin[9]) . " " . ord($Bin[10]) . " " . ord($Bin[11]) . " " . ord($Bin[12]) . " " . ord($Bin[13]) . " " . ord($Bin[14]) . " " . ord($Bin[15]) . " " . ord($Bin[16]) . " " . ord($Bin[17]) . " " . ord($Bin[18]) . " " . ord($Bin[19]) . " " . ord($Bin[20]) . " " . ord($Bin[21]) . " " . ord($Bin[22]) . " " . ord($Bin[23]) . " " . ord($Bin[24]) . " " . ord($Bin[25]) . " " . ord($Bin[26]) . " " . ord($Bin[27]) . " " . ord($Bin[28]) . " " . ord($Bin[29]) . " " . ord($Bin[30]) . " " . ord($Bin[31]) ."\n";

}

$Key  = "abcdefghabcdefgh";
$IV   = "12345678abcdefgh";
$Text = "12345678123456781234567812345678";

$KeySize = strlen($Key) * 8;
$IVSize = strlen($IV) * 8;
$TextSize = strlen($Text) * 8;

$IVSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "IVSze is " . $IVSize . " bytes or " . $IVSize * 8 . " bits\n";

$BlockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'ncfb');
echo "BlockSize is " . $BlockSize . " bytes or " . $IVSize * 8 . " bits\n";

$Crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $Key, $Text, 'ncfb', $IV);

$UnCrypt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $Key, $Crypt, 'ncfb', $IV);

echo "Key   is   " . $Key  . " with size " . $KeySize  . "\n";
echo "IV    is   " . $IV   . " with size " . $IVSize   . "\n";
echo "Text  is   " . $Text . " with size " . $TextSize . "\n";
echo "Crypt is " . $Crypt  . "\n";
dump("Crypt", $Crypt);
echo "Decrypt is " . $UnCrypt . "\n";
dump("Decrypt", $UnCrypt);
?>