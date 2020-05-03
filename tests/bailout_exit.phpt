--TEST--
zend_bailout() from exit will instrument
--SKIPIF--
<?php
if (!extension_loaded('observer')) die('skip: observer extension required');
?>
--INI--
observer.instrument=1
--FILE--
<?php
function foo() {
    exit;
}

foo();

echo 'You should not see this.';
?>
--EXPECTF--
[BEGIN foo()]
[END foo(): null]
