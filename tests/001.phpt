--TEST--
Basic functionality of the instrumentation hooks
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
function foo() {
    return 42;
}

var_dump(foo());
var_dump(array_sum([111, 111, 111]));
?>
--EXPECT--
[BEGIN foo()]
[END foo(): int]
[BEGIN var_dump()]
int(42)
[END var_dump(): null]
[BEGIN array_sum()]
[END array_sum(): int]
[BEGIN var_dump()]
int(333)
[END var_dump(): null]
