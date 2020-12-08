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
?>
--EXPECT--
[BEGIN foo()]
[END foo(): int]
int(42)
