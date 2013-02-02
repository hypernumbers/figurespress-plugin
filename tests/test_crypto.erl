%%% @author Gordon Guthrie <gordon@hypernumbers.dev>
%%% @copyright (C) 2013, Gordon Guthrie
%%% @doc
%%%
%%% @end
%%% Created : 29 Jan 2013 by Gordon Guthrie <gordon@hypernumbers.dev>

-module(test_crypto).

-export([
         test/0,
         test2/0
        ]).

test() ->
    code:add_patha("/home/gordon/hypernumbers/lib/hypernumbers-1.0/ebin"),
    Key  = <<"abcdefghabcdefgh">>,
    IV   = <<"12345678abcdefgh">>,
    Text = <<"12345678123456781234567812345678">> ,

    KeySize  = bit_size(Key),
    IVSize   = bit_size(IV),
    TextSize = bit_size(Text),

    io:format("Key  is ~p with size ~p~n", [Key, KeySize]),
    io:format("IV   is ~p with size ~p~n", [IV, IVSize]),
    io:format("Text is ~p with size ~p~n", [Text, TextSize]),

    Crypt = crypto:aes_cfb_128_encrypt(Key, IV, Text),
    io:format("Crypt is ~p~n", [Crypt]),
    B64 = base64:encode(Crypt),
    io:format("Crypt B64 is ~p~n", [B64]),

    Decrypt = crypto:aes_cfb_128_decrypt(Key, IV, Crypt),
    io:format("Decrypt is ~p~n", [Decrypt]),
    ok.

test2() ->
    code:add_patha("/home/gordon/hypernumbers/lib/hypernumbers-1.0/ebin"),
    Key = <<97,98,99,100,101,102,103,104,97,98,99,100,101,102,103,104>>,
    IV   = <<49,50,51,52,53,54,55,56,97,98,99,100,101,102,103,104>>,
    Text  = <<49,50,51,52,53,54,55,56,49,50,51,52,53,54,55,56>>,

    KeySize  = bit_size(Key),
    IVSize   = bit_size(IV),
    TextSize = bit_size(Text),

    io:format("Key  is ~p with size ~p~n", [Key, KeySize]),
    io:format("IV   is ~p with size ~p~n", [IV, IVSize]),
    io:format("Text is ~p with size ~p~n", [Text, TextSize]),

    Crypt = crypto:aes_cfb_128_encrypt(Key, IV,Text),
    io:format("Crypt is ~p~n", [Crypt]),

    Decrypt = crypto:aes_cfb_128_decrypt(Key, IV, Crypt),
    io:format("Decrypt is ~p~n", [Decrypt]),
    ok.
