--TEST--
zend_bailout() from a fatal user error will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
function foo() {
    trigger_error('Foo error', E_USER_ERROR);
}

foo();

echo 'You should not see this.';
?>
--EXPECTF--
[BEGIN foo()]

Fatal error: Foo error in %s on line %d
[END foo(): null]
