-module(test_base64).

-export([
         test/0
         ]).

test() ->
    Text = "Now is the time for all good men to come to the aid of the party "
        ++ "so it is. The quality of bloody mercy is not strained but falleth "
        ++ "as the dew from heaven, ya bas, dingo!",

    Enc = base64:encode(Text),
    Dec = base64:decode(Enc),
    io:format("Text is ~p~nEnc is ~p~nDec is ~p~n",
              [Text, Enc, Dec]).
