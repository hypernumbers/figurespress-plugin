%%% @author Gordon Guthrie <gordon@hypernumbers.dev>
%%% @copyright (C) 2013, Gordon Guthrie
%%% @doc
%%%
%%% @end
%%% Created : 29 Jan 2013 by Gordon Guthrie <gordon@hypernumbers.dev>

-module(test_crypto).

-export([
         test/0
        ]).

test() ->
    code:add_patha("/home/gordon/hypernumbers/lib/hypernumbers-1.0/ebin"),
    Key  = <<"abcdefghabcdefgh">>,
    IV   = <<"12345678abcdefgh">>,
    Text = <<"Now is the winter of our discontent made glorious summer by this son of York, ya bas...The quality of mercy is not strained but falleth as the dew from heaven. Now is the time for all good men to come to the aid of the party, I tell you, so it is big man, so it is...">> ,

    KeySize  = bit_size(Key),
    IVSize   = bit_size(IV),
    TextSize = bit_size(Text),

    io:format("Key  is ~p with size ~p~n", [Key, KeySize]),
    io:format("IV   is ~p with size ~p~n", [IV, IVSize]),
    io:format("Text is ~p with size ~p~n", [Text, TextSize]),

    PaddedText = extend(Text),

    PaddedSize = bit_size(PaddedText),

    io:format("PaddedText is ~p with size ~p~n", [PaddedText, PaddedSize]),

    Crypt = crypto:aes_cfb_128_encrypt(Key, IV, PaddedText),
    io:format("Crypt is ~p~n", [Crypt]),
    B64 = base64:encode(Crypt),
    io:format("Crypt B64 is ~p~n", [B64]),

    Decrypt = unpad(crypto:aes_cfb_128_decrypt(Key, IV, Crypt)),
    io:format("Decrypt is ~p~n", [Decrypt]),
    io:format("Decrypted text is ~p~n", [binary_to_list(Decrypt)]),
    ok.

%% Extend binary to a multiple of 128 bits.
-spec extend(binary()) -> binary().
extend(Bin) ->
    Len = size(Bin),
    io:format("Len is ~p~n", [Len]),
    Pad = 16 - ((Len + 2) rem 16),
    io:format("Padding plain text with: ~p~n", [Pad]),
    <<Len:16, Bin/binary, 0:Pad/unit:8>>.

unpad(<<Len:16, Bin2/binary>>) -> binary:part(Bin2, 0, Len - 1).
