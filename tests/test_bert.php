<?php

    require_once 'classes/Bert.php';

	function dump($Msg, $Binary) {
		echo $Msg . ":";
		$Len = strlen($Binary);
		for ($i = 0; $i < $Len; $i = $i + 1) {
			echo ord($Binary[$i]) . " ";
		}
		echo "\n";
	}


    $bert = Bert::encode(
    	array(
        Bert::t(Bert::a('hypertag'), "bricknell"),
        Bert::t(Bert::a('timestamp'), "dogbreath")
      )
    );
    echo $bert . "\n";
    dump("Bert", $bert);

?>