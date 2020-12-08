--TEST--
zend_bailout() from an uncaught exception will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
// @TODO Emit a message showing exception was detected
function foo() {
    throw new Exception('Foo error');
}

foo();

echo 'You should not see this.';
?>
--EXPECTF--
[BEGIN foo()]
[END foo(): null]

Fatal error: Uncaught Exception: Foo error in %s:%d
Stack trace:
#0 %s(%d): foo()
#1 {main}
  thrown in %s on line %d
