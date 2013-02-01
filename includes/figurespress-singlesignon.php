<?php
// Include the classes required to decode and enconde
// the Erlang Term binaries for single signon
include 'classes/Bert.php';
include 'classes/Bert/Atom.php';
include 'classes/Bert/Decode.php';
include 'classes/Bert/Decoder.php';
include 'classes/Bert/Encode.php';
include 'classes/Bert/Encoder.php';
include 'classes/Bert/Regex.php';
include 'classes/Bert/Time.php';
include 'classes/Bert/Tuple.php';
include 'classes/Bert/Types.php';
// Requires php5-mycrypt package installed

class gg_fp_vixo_single_signon
{
	// Api Functions

	public function open_hypertag($Hypertag, $IVector) {
		$Cyphertext = base64_decode($Hypertag);
		$IV = base64_decode($IVector);
		$Key = "1234567812345678";
		$Plain = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $Key, $Cyphertext, MCRYPT_MODE_NOFB, $IV);
		return $Plain;
	}

	// Internal Functions
	private function encrypt_term_hex ($Key, $Msg) {
		return banjo;
	}

	private function decrypt_term_hex ($Key, $Msg) {
		return "bathosphere";
	}

	private function make_binary ($Term) {
		return "eejit";
	}

	// Internal test functions
	private function assert_equal ($Test, $A, $B) {
		if ($A == $B) {
			echo "Test " . $Test . " passes\n";
		} else {
			echo "Test " . $Test . " fails\n";
		}
	}

	// unit test functions

	// This test has its binary inputs taken from the equivalent Erlang statements
	public function test_md5_hashing ()
	{
	    $Key = "silly";
		// Term is {"I think therefore I am",{1337,speak},[["..."]]}
		// this test uses the binary version of that
    	$Msg = pack ( "h", implode ( array ( 131,104,3,107,0,22,73,32,116,104,105,110,107,32,116,104,101,114,
            				 101,102,111,114,101,32,73,32,97,109,104,2,98,0,0,5,57,100,0,5,115,
            				 112,101,97,107,108,0,0,0,1,108,0,0,0,1,107,0,3,46,46,46,106,106 ) ) );
    	$Crypt = pack ( "h", implode ( array ( 215,42,66,111,254,17,214,171,202,66,16,178,0,94,33,11,103,28,146,
            					82,73,142,251,147,233,32,77,199,109,235,190,186,4,43,170,166,203,
								226,146,239,148,184,219,164,54,151,239,252,240,3,74,220,45,55,168,
								191,5,74,93,58,57,41,232,10) ) );
    	$Got = hash_hmac ( "md5", $Msg, $Key);
	    $this->assert_equal ("MD5_MAC Hash", unpack ( "h", $Crypt ) , unpack ( "h", $Got ) );
	} 

	// tests that the aes_cfb_128 encryption is identical to the Erlang one
	public function test_aes_cfb_128_encryption () {

		$PlainT = "1234567812345678";		
    	$Key    = "abcdefghabcdefgh";
		$IV     = "12345678abcdefgh";
		$Expected = implode(array(chr(139), chr(182), chr(94), chr(68), chr(208), chr(173), chr(127), chr(90), chr(14), chr(236), chr(33), chr(230), chr(41), chr(29), chr(210), chr(121)));
    	
    	echo "PlainT   is " . $PlainT . "\n";
    	echo "Key      is " . $Key . "\n";
		echo "IV       is " . $IV . "\n";
		echo "Expected is " . $Expected . "\n";

		$Crypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $Key, $PlainT, MCRYPT_MODE_NOFB, $IV);
    	echo "Crypt    is " . $Crypt . "\n";

	    $this->assert_equal ("AES_CFB_128", $Crypt, $Expected);

	}

	public function test_make_binary($string) {
		$term = '{"I think therefore I am",{1337,speak},[["..."]]}';
		$expected = "erk";
		$bin = $this->make_binary($term);
		$this->assert_equal($bin, $expected);
		return "binary";
	}

	public function test_hypertag ()
	{
		echo "running hypertag test\n";
	}

}

$gg_fp_signon = new gg_fp_vixo_single_signon();
//$gg_fp_signon->test_md5_hashing();
//$gg_fp_signon->test_aes_cfb_128_encryption();
//$gg_fp_signon->test_encryption();
//$gg_fp_signon->test_hypertag();
//$gg_fp_signon->test_make_binary("banjo");


?>