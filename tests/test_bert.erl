-module(test_bert).

-export([test/0]).

test() ->
    List = [{hypertag, <<"bricknell">>}, {timestamp, <<"dogbreath">>}],
    Bert = bert:encode(List),
    io:format("Bert is ~p~n", [Bert]),
    ok.
