-module(test_base64).

-export([
         test/0
         ]).

test() ->
    Text = "Now is the time for all good men to come to the aid of the party "
        ++ "so it is. The quality of bloody mercy is not strained but falleth "
        ++ "as the dew from heaven, ya bas, dingo!",

    Bin = list_to_binary(Text),

    Enc = base64:encode_to_string(Text),
    Dec = base64:decode(Enc),
    io:format("Text is ~p~nEnc is ~p~nDec is ~p~n",
              [Text, Enc, Dec]),
    Enc2 = base64:encode(Bin),
    Dec2 = base64:decode(Enc2),
    io:format("Bin is ~p~nEnc2 is ~p~nDec2 is ~p~n",
              [Bin, Enc2, Dec2]).
