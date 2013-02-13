<?php

	$Text = "Now is the time for all good men to come to the aid of the party " .
        "so it is. The quality of bloody mercy is not strained but falleth " .
        "as the dew from heaven, ya bas, dingo!";

    $Enc = base64_encode($Text);
    $Dec = base64_decode($Enc);
    echo "Text is " . $Text . "\n";
    echo "Enc is  " . $Enc . "\n";
    echo "Dec is  " . $Dec . "\n";

?>