-module(basic).

-export([
        test/0
        ]).

test() ->
    %Key = "key",
    %String = "stri\nng1234567890123456789012345678901234567890",
    String = "DELETE\n\n\n\nx-amz-date:Tue, 27 Mar 2007 21:20:26 +0000\n/johnsmith/photos/puppy.jpg",
    Key = "uV3F3YluFJax1cknvbcGwgjvx4QpvB+leU8dUj2o",
    io:format("Key is ~p~n", [Key]),
    io:format("String is ~p~n", [String]),
    Sign = xmerl_ucs:to_utf8(String),  
    io:format("Sign is   ~p~n", [Sign]),
    Hash = crypto:sha_mac(Key, Sign),
    io:format("Hash is ~s~n", [binary_to_list(Hash)]),
    dump("Hash ", binary_to_list(Hash)),
    Bin = base64:encode(Hash),
    io:format("Bin is ~p~n", [Bin]),
    dump("Bin ", binary_to_list(Bin)).

dump(Str, List) -> io:format("~s", [Str]),
                   dump2(List).

dump2([])      -> io:format("\n");
dump2([H | T]) -> io:format("~p ", [H]),
                  dump2(T).
